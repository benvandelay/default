var editUser = (function(){

    var self;

    return {

        init: function(){

            self = this;
            self.uploadify();
            self.activeStatus();
        },

        uploadify: function(){
            if($('#uploadify').length > 0){
                
                $('#uploadify').uploadifive({
                    'uploadScript'  : '/admin/image/uploadify/user',
                    'multi'         : false,
                    'width'         : 238,
                    'height'        : 238,
                    'buttonText'    : 'Select Image',
                    'onUploadComplete' : function(file, data, response) {
                        console.log(data);
                       var o = jQuery.parseJSON(data);
                       if(o.error == 0){
                           
                           if($('.empty-image').length){
                               var uploaded_img = $('<img>', {src : o.filepath});
                               $('.user-image-wrap').append(uploaded_img).removeClass('empty-image');
                           }else{
                               $('.user-image-wrap img').attr('src', o.filepath);
                           }
                           
                           $('#User_image_id').val(o.image_id);
                           
                       }else{
                           alert(o.error);
                       }
                       
                    }
                 });
             }
        },
        
        activeStatus: function(){
            if($('.status').length){
                
                var value = $('#User_active').val();
                
                if(value == 1){
                    $('.status').addClass('published');
                }
                $('.status').on('click', function(){
                    value = value == 1 ? 0 : 1;
                    $('#User_active').val(value);
                    $(this).toggleClass('published');
                    
                    $(this).removeClass('ready').on('mouseleave', function(){
                        $(this).addClass('ready')
                    });
                });
            }
        },

    };

})();
$(document).ready(function(){
    editUser.init();
});