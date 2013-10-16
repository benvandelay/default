var editContent = (function(){

    var self;

    return {

        init: function(){

            self = this;
            self.toggleView();
            
        },

        toggleView: function(){
            
            $('.editor-nav').on('click', 'span', function(){
                //TODO scroll to top
                
                $('.editor-nav span').removeClass('active');
                $(this).addClass('active');
                var pane = $('.' + $(this).data('show'));
                $('.editor').hide();
                pane.show();
            });
               
        },
        
        uploadify: function(){
            if($('#uploadify').length > 0){
                $('#uploadify').uploadify({
                    'swf'       : '/js/admin/uploadify/uploadify.swf',
                    'uploader'  : '/admin/image/uploadify',
                    'multi'    : false,
                    'width'     : 320,
                    'height'    : 1000,
                    'buttonText': 'Upload Image',
                    'onUploadSuccess' : function(file, data, response) {
                        console.log(data);
                       var o = jQuery.parseJSON(data);
                       if(o.error == 0){
                           $('.image-upload-wrap img').attr('src', o.filepath);
                           $('#Image_filename').val(o.filename);
                           
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