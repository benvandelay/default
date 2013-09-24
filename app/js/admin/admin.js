var admin = (function(){

    var self,
        newCategoryCount,
        hash;

    return {

        init: function(){

            self = this;
            newCategoryCount = 0;
            hash = window.location.hash;
            self.setUpNav();
            self.prefill();
            self.uploadify();
            self.fadeOutFlash();
            self.newCategory();
            self.toggleBox();
            self.modalView();
            self.imagesView();
            
        },
        
        search: function(){
            var ajaxUpdateTimeout;
            var ajaxRequest;
            
            $('input#search').keyup(function(){
                
                ajaxRequest = $(this).serialize();
                clearTimeout(ajaxUpdateTimeout);
                
                if($(this).val()!=''){
                    $('#article-list').addClass('waiting');
                }
                ajaxUpdateTimeout = setTimeout(function () {
                
                    $.fn.yiiListView.update(
                        'article-list',
                        {data: ajaxRequest}
                    )
                },300);
            });
        },
        
        beforeArticlesUpdate: function(){
            $('#article-list').removeClass('waiting');
        },
        
        setUpNav: function(){
            $('.main-nav .active').on('click', function(e){
                e.preventDefault();
                $('.main-nav').toggleClass('open');
            });
            
            $('.left-controls').hover(false, function(){
                $('.main-nav').removeClass('open');
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
        
        modalView: function(){
            if($(".launch-modal").length > 0){
                
                $(".launch-modal").on('click', function(e){
                    e.preventDefault();
                    self.launchModal($(this).data('modal'));
                });
                
                if(hash){
                    self.launchModal(hash.replace('#',""));
                }
            }
        },
        
        launchModal: function(modal){
            $(".modal-wrapper." + modal).modal({
                overlayClose: true,
                position: ["100px"],
                closeClass: "modal-close",
            });
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
        
        resetImageForm: function(){
            $('.image-upload-wrap img').attr('src', '/images/admin/blank.jpg');
            $('#Image_filename').val('');
            $('#image-form')[0].reset();
        },
        
        imagesView: function(){
            
            $('.gallery-image-item').on('click',function(){
                  $('#Image_id').val($(this).data('id'));  
                  $('#Image_title').val($(this).data('title'));  
                  $('#Image_body').val($(this).data('body'));  
                  $('#Image_filename').val($(this).data('filename'));
                  $('.image-upload-wrap img').attr('src', $(this).data('filepath'));
                  
                  $('.image-list-wrap').hide();
                  $('.add-image-wrap').fadeIn();
            });
            
            $('.add-new-image').on('click', function(){
                self.resetImageForm();
                $('.image-list-wrap').hide();
                $('.add-image-wrap').fadeIn();
            });
            
            $('.cancel-add-image').on('click', function(){
                $('.add-image-wrap').hide();
                $('.image-list-wrap').fadeIn();
            });
            

        }


    };

})();
$(document).ready(function(){
    admin.init();
});