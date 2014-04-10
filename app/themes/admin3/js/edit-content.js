var editContent = (function(){

    var self,
        unsaved;

    return {

        init: function(){

            self    = this,
            unsaved = false;
            
            self.toggleView();
            self.uploadify();
            self.redactor();
            self.checkForUpdates();
            self.viewVersions();
            self.publishedStatus();
            
        },
        
        toggleView: function(){
            $('.show-page-info').on('click', function(){
                if(!unsaved){
                    self.showEditor('page-info');
                    self.hideVersions();
                    $(window).scrollTop(0,0);
                }else{
                    alert('please save first');
                }
            });
            
            $('.show-page-content').on('click', function(){
                self.showEditor('page-content');
            });
        },
        
        showEditor: function(editor){
            
            if(editor == 'page-info'){
                $('.save-status').hide();
                $('.published-status').hide();
            }else{
                $('.save-status').show();
                $('.published-status').show();
            }
            
            $('.editor').hide();
            $('.' + editor).fadeIn();
            
            $('.editor-header .icon').removeClass('active');
            $('.editor-header .icon.show-' + editor).addClass('active');
              
        },
        
        redactor: function(){

            $('#Version_body').redactor(
                {
                buttons         : ['html', 'formatting', 'bold', 'italic', 'deleted','unorderedlist', 'orderedlist', 'outdent', 'indent','image', 'video', 'table', 'link', 'alignment', 'horizontalrule'],
                toolbarExternal : '.redactor-toolbar-cont',
                minHeight       : 200,
                imageUpload     : '/admin/image/redactorFileUpload',
                imageUploadErrorCallback : function(json){
                        alert(json.error);
                    }
                });
        },
        
        checkForUpdates: function(){
            $('#update-page-form').formChange({
                pollInterval   : 2000,
                updateCallback   : function(form, change){
                    if(change){
                        unsaved = true;
                        $('.save-status').addClass('unsaved');
                        form.find('.btn.save').removeClass('disabled');
                        $('#content-body').removeClass('open-info');
                        self.hideVersions();
                    }else{
                        unsaved = false;
                        $('.save-status').removeClass('unsaved');
                        form.find('.btn.save').addClass('disabled');
                    }
                },
                submitCallback : function(form, change, event){
                    if(!change)
                        event.preventDefault();
                }
            });
        },
        
        uploadify: function(){
            if($('#uploadify').length > 0){
                
                $('#uploadify').uploadifive({
                    'uploadScript'  : '/admin/image/uploadify',
                    'multi'         : false,
                    'width'         : 736,
                    'height'        : 323,
                    'buttonText'    : 'Select Image',
                    'onUploadComplete' : function(file, data, response) {
                        console.log(data);
                       var o = jQuery.parseJSON(data);
                       if(o.error == 0){
                           
                           if($('.empty-image').length){
                               var uploaded_img = $('<img>', {src : o.filepath});
                               $('.header-image-wrap').append(uploaded_img).removeClass('empty-image');
                           }else{
                               $('.header-image-wrap img').attr('src', o.filepath);
                           }
                           
                           $('#Version_image_id').val(o.image_id);
                           
                       }else{
                           alert(o.error);
                       }
                       
                    }
                 });
             }
        },
        
        viewVersions: function() {
            $('.save-status').on('click', function(){
                if(!unsaved){
                    self.showVersions();
                }else{
                    alert('please save first');
                }
                
            });
            
            $('.version-list .icon-close').on('click', function(){
                self.hideVersions();
            });
        },
        
        showVersions: function() {
            $('.version-list').fadeToggle('fast');
        },
        
        hideVersions: function() {
            $('.version-list').fadeOut('fast');
        },
        
        publishedStatus: function(){
            $('.published-status').on('click', function(){
                var model   = $(this).data('model-id'),
                    version = $(this).data('version-id');
                    
                if($(this).hasClass('published')){
                    version = 'NULL';
                }
                
                $.post('/admin/page/setPublishedVersion', {
                    version : version,
                    model   : model 
                }).done(function(data){
                    if(data == 1){
                        self.resetPublishedVersion(version);
                    }
                });
            });
        },
        
        resetPublishedVersion: function(id){
            $('.version-list .version').removeClass('published');
            
            if(id == 'NULL'){
                $('.published-status').removeClass('published');
                $('.published-status').addClass('unpublished');
            }else {
                $('.published-status').addClass('published');
                $('.published-status').removeClass('unpublished');
                $('.version-list .version[data-id="'+id+'"]').addClass('published');
            }
            
        }

    };

})();
$(document).ready(function(){
    editContent.init();
});