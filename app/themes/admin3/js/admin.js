var admin = (function(){

    var self,
        newCategoryCount,
        hash;

    return {

        init: function(){
            self = this;
            hash = window.location.hash;
            self.setUpNav();
            self.fadeOutFlash();
            self.toggleBox();
            
            if($('#Version_body').length){
                $('#Version_body').redactor({});
            }
            
            if($('body.create').length) {
                self.generateSlug();
            }
            
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
        
        generateSlug: function(){
            $("#Page_title").blur(function(){
                if( ($(this).val().length) && ($('#Page_slug').val() == '') ) {
                    $("#Page_slug").val($(this).val().replace(/[ ]+/g, '-').toLowerCase().replace(/[^0-9a-z-]/g,""))  ;     
                }      
            });
        },

        fadeOutFlash: function(){
            if($('.flash').length > 0){
                setTimeout(function(){ $('.flash').fadeOut('slow')}, 5000);
            }
        }


    };

})();
$(document).ready(function(){
    admin.init();
});