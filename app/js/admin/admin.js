var admin = (function(){

    var self,
        newCategoryCount,
        hash;

    return {

        init: function(){

            self = this;
            newCategoryCount = 0;
            hash = window.location.hash;
            self.prefill();
            self.uploadify();
            self.fadeOutFlash();
            if($("#show-gallery").length > 0) self.showGalleryImages();
            self.newCategory();
            self.toggleBox();
            self.editView();
            $('a#gallery-image-item').click(function(){
                  $('#Image_id').val($(this).data('id'));  
                  $('#Image_title').val($(this).data('title'));  
                  $('#Image_body').val($(this).data('body'));  
                  $('#Image_filename').val($(this).data('filename'));
                  $('#Image_status_'+$(this).data('status')).attr('checked','checked');
                  $('.image-upload-wrap img').attr('src', $(this).data('filepath'));
                  self.launchImageModal();
            });
        },

        showGalleryImages: function(){
            $('#show-gallery').click(function(){
                if(('.gallery-images').length < 0) { 
                    alert('Please save the page before adding images'); 
                    return false;
                }
                $('.gallery-images').show();
                $('.content-form').hide();
                $('#show-content').removeClass('active');
                $(this).addClass('active');
            });
            
            $('#show-content').click(function(){
                $('.gallery-images').hide();
                $('.content-form').show();
                $('#show-gallery').removeClass('active');
                $(this).addClass('active');
            });
        },
        
        toggleBox: function(){
            if($("a.toggle-btn").length > 0){
                
                $('a.toggle-btn').click(function(){
                    $('.errorMessage, .errorSummary').hide();
                    $('.toggle-item').hide();
                    $('#'+$(this).data('id')).show();
                    $('a.toggle-btn').removeClass('active');
                    $(this).addClass('active');
                });
                
                
                 
            }
        },
        
        editView: function(){
            if($(".update-nav").length > 0){
                
                if(hash){   
                    $('.edit').hide();
                    $('.edit'+hash).show();
                    $('.update-nav li').removeClass('active');
                    $('.update-nav li'+hash).addClass('active');
                }
                
                $('.update-nav li').click(function(){
                    $('.edit').hide();
                    $('.edit#'+$(this).data('show')).show();
                    $('.update-nav li').removeClass('active');
                    $(this).addClass('active');
                });
                 
            }
        },
        
        generateSlug: function(){
            $("#Page_title").blur(function(){
                if( ($(this).val().length) && ($('#Page_slug').val() == '') ) {
                    $("#Page_slug").val($(this).val().replace(/[ ]+/g, '-').toLowerCase().replace(/[^0-9a-z-]/g,""))  ;     
                }      
            });
        },

        newCategory: function(){
            $('#new-category').click(function(){
                $('#new-category-wrap').append(self.createCategoryInput());
                newCategoryCount++;
            });  
        },

        createCategoryInput: function(){
            var categoryInput = $('<input type="text" />');
            categoryInput.attr('name', 'Page[new_category][' + newCategoryCount + ']');
            
            return categoryInput;
        },
        
        //clear prefill values
        prefill: function() {
            if($('.input').length > 0){
                $('.input').each(function(){
                    $(this).click(function(){
                        $(this).find('input, textarea').focus();
                    });



                    $(this).find('input, textarea').focus(function(){
                        $(this).parent().addClass('focus');
                    });
                    $(this).find('input, textarea').blur(function(){
                        $(this).parent().removeClass('focus');
                    });
                });
            }
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
        },
        
  
        fadeOutFlash: function(){
            if($('.flash').length > 0){
                setTimeout(function(){ $('.flash').fadeOut('slow')}, 5000);
            }
        },
        
        launchImageModal: function(){
                //launch the modal
                $(".modal-wrapper.new-image").modal({
                    overlayClose: true,
                    position: ["100px"],
                    closeClass: "modal-close",
                });

        }


    };

})();
$(document).ready(function(){
    admin.init();
});