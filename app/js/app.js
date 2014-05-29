var app = (function(){

    var self;

    return {

        init: function(){

            self = this;
            valid = [];// for validators
            
            //self.checkCaptchaBeforeSubmit();
            self.wrapCode();
            
            self.fadeOutFlash();
            //self.navFlair();
            
            $(document).pjax('.site-header a, .article-list a, .article-wrap A', '#response');
            
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
              self.wrapCode();
              
              if($('#blank').length){
                  $('body').removeClass('open-article');
              }else{
                  $('body').addClass('open-article');
              }
            });
        },

        wrapCode: function(){
            if($('pre').length){
                $('pre').wrapInner('<code></code>');
                Prism.highlightAll();
            }
        },
        
        afterValidateAttribute: function(form, attribute, data, hasError) {

            var label = attribute['name'];

            if (!hasError) {
                valid[label] = true
            } else {
                valid[label] = false;
            }

            if(valid['name'] && valid['email'] && valid['body']) {
                //$('.captcha').slideDown('fast');
                $('form#contact-form input[type=submit]').on('click', function(){
                    $('input[name="pen15"]').val('pass');
                });
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
        },
        
        navFlair: function(){
            $('.ben').on({
                'mouseenter' : function(){
                    $('.categories li').stop().hide();
                    $('.categories li').each(function(i){
                        $(this).delay(i * 30).fadeIn(200);
                    });
                }, 
                'mouseleave': function(){
                    $('.categories li').stop();
                     $($('.categories li').get().reverse()).each(function(i){
                        $(this).delay(i * 30).fadeOut(200);
                    });
                }});
        }


    };

})();
$(document).ready(function(){
    app.init();
});