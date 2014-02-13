var editContent = (function(){

    var self;

    return {

        init: function(){

            self = this;
            self.toggleView();
            self.uploadify();
            self.redactor();
            self.checkForUpdates();
            
        },

        toggleView: function(){
            $('.editor-nav').on('click', 'span', function(){
                //TODO scroll to top
                
                $('.editor-nav span').removeClass('active');
                $(this).addClass('active');
                var pane = $('.' + $(this).data('show'));
                $('.editor').hide();
                $('.save-status').hide();
                pane.show();
            });
               
        },
        
        redactor: function(){

            $('#Version_body').redactor(
                {
                buttons         : ['html', 'formatting', 'bold', 'italic', 'deleted','unorderedlist', 'orderedlist', 'outdent', 'indent','image', 'video', 'table', 'link', 'alignment', 'horizontalrule'],
                toolbarExternal : '.redactor-toolbar-cont',
                imageUpload     : '/admin/image/redactorFileUpload',
                imageUploadErrorCallback : function(json){
                        alert(json.error);
                    }
                });
        },
        
        checkForUpdates: function(){
            $('#update-page-form').formChange({
                pollInterval   : 2000,
                pollCallback   : function(form, change){
                    if(change){
                        $('.save-status.page-content').addClass('unsaved');
                        form.find('.btn.save').removeClass('disabled');
                    }else{
                        $('.save-status.page-content').removeClass('unsaved');
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
        }

    };

})();
$(document).ready(function(){
    editContent.init();
});