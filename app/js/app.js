var app = (function(){

    var self;

    return {

        init: function(){

            self = this;
            valid = [];// for validators
            
            self.spamKiller();
            self.wrapCode();
            self.lazy();
            self.fadeOutFlash();
            self.navFlair();
            
            $(document).pjax('.site-header a, .article-list a, .article-wrap a', '#response');
            
            $(document).on('pjax:send', function() {
              $('#loader').show();
              $('#response').hide();
            });
            
            $(document).on('pjax:end', function() {

              search.reset();
              
              $('#loader').fadeOut();
              $('#response').fadeIn();

              self.wrapCode();
              
              if($('#blank').length){
                  $('body').removeClass('open-article');
              }else{
                  $('body').addClass('open-article');
                  self.lazy();
              }
              
              ga('set', 'location', window.location.href);
              ga('send', 'pageview');
              
            });
        },

        wrapCode: function(){
            if($('pre').length){
                $('pre').wrapInner('<code></code>');
                Prism.highlightAll();
            }
        },
        
        spamKiller: function() {
            
            if($('form#contact-form input[type=submit]').length){
                $('form#contact-form input[type=submit]').on('click', function(){
                    $('input[name="pen15"]').val('pass');
                });
            }

        },
        
        lazy: function(){
            if($('.article-wrap img').length){
                $('.article-wrap img').lazyload({
                    effect : 'fadeIn',
                    threshold : 100
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
                    $('.ben .categories li').stop();
                    $('.ben .categories').show();
                    $('.ben .categories li').each(function(i){
                        $(this).animate({'top' : ((i + 1) * 36) + 'px'}, 200);
                    });
                }, 
                'mouseleave': function(){
                    $('.ben .categories li').stop();
                    $('.ben .categories li').each(function(i){
                    $(this).animate({'top' : '0'}, 200, function(){
                        $('.ben .categories').hide();
                    });
                });
                }});
        }


    };

})();
$(document).ready(function(){
    app.init();
});