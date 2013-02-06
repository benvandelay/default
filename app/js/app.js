var app = (function(){

    var self;

    return {

        init: function(){

            self = this;
            valid = [];// for validators
            
            self.checkCaptchaBeforeSubmit();
            self.fadeOutFlash();

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