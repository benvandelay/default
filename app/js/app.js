var app = (function(){

    var self;

    return {

        init: function(){

            self = this;
            valid = [];// for validators
            
            self.checkCaptchaBeforeSubmit();
            self.fadeOutFlash();
            
            $(document).pjax('a', '#response');
            
            $(document).on('pjax:send', function() {
              $('#loader').show();
              $('#response').hide();
            });
            
            $(document).on('pjax:end', function() {
              $('body').removeClass('searching');
              $('#search').val('');
              search.updateArticles('');
              $('#loader').hide();
              $('#response').fadeIn();
              
              $('.article').removeClass('active');
              $('.article[data-id="'+$('.article-wrap').data('id')+'"]').addClass('active');
              
              if($('#blank').length){
                  $('body').removeClass('open-article');
              }else{
                  $('body').addClass('open-article');
              }
            });
        },

        
        afterValidateAttribute: function(form, attribute, data, hasError) {

            var label = attribute['name'];

            if (!hasError) {
                valid[label] = true
            } else {
                valid[label] = false;
            }

            if(valid['name'] && valid['email'] && valid['body']) {
                $('.captcha').slideDown('fast');
            }

        },
        
        checkCaptchaBeforeSubmit: function(){
            $('form#contact-form input[type=submit]').click(function(){
                if($('.validate input').val()!='' && $('.captcha').css('display')=='none') {
                    return false;
                }
            });
        },
        
        fadeOutFlash: function(){
            if($('.flash').length > 0){
                setTimeout(function(){ $('.flash').fadeOut('slow')}, 10000);
            }
        }


    };

})();
$(document).ready(function(){
    app.init();
});