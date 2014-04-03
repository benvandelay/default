(function($){

    $.fn.formChange = function(options){

        var self    = this,
            changes = false;
        
        var defaults = {
            
            checkEvent      : 'poll',
            pollInterval    : 1000,
            updateCallback  : function(){},
            submitCallback  : function() {}
        }
        
        var defaultValues = {};

        var settings = $.extend({}, defaults, options);
        
        var init = function(){
            
            setDefaults();
            
            if(settings.checkEvent == 'poll'){
                
                var poll = setInterval(function(){
                    check();
                    //console.log(changes);
                    settings.updateCallback(self, changes);
                }, settings.pollInterval);
                
            }else if(settings.checkEvent == 'change'){
                
                self.find(":input").change(function() {
                    check();
                    settings.updateCallback(self, changes);
                });
                
            }else if(settings.checkEvent == 'keyup') {
                
                self.find(":input").on('keyup',function() {
                    check();
                    settings.updateCallback(self, changes);
                });
                
            }
            
            self.submit(function(event){
                settings.submitCallback(self, changes, event);
            });
            
        };
        
        var setDefaults = function(){
            
            self.find('input[type="file"], input[type="text"], input[type="email"], input[type="hidden"], textarea, [contenteditable]').each(function(i){
                    defaultValues[i] = this.value;
            }); 
            
            //console.log(defaultValues);
            
        };
        
        var check = function(){
            
            changes = false;
            
            self.find('input[type="file"], input[type="text"], input[type="email"], input[type="hidden"], textarea, [contenteditable]').each(function(i){
                if(this.value != defaultValues[i]){
                    //console.log(this);
                    changes = true;
                }
            });
            
            self.find('input[type="checkbox"]').each(function(){
                if(this.checked != this.defaultChecked){
                    //console.log(this);
                    changes = true;
                }
            });
            
            self.find('select').each(function(){
                if(!this.options[this.selectedIndex].defaultSelected){
                    //console.log(this);
                    changes = true;
                }
            });
        };
        
        init();
        
    }
})(jQuery);