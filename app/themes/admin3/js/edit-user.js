var editUser = (function(){

    var self;

    return {

        init: function(){

            self = this;
            self.uploadify();
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
        }

    };

})();
$(document).ready(function(){
    editUser.init();
});