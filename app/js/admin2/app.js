var cms = (function(){

    var self,
        tpl,
        textAreaCount,
        niceditor;

    return {

        init: function(){

            self = this;
            
            textAreaCount = $('.placeholder.text').length;
            niceditor = new Array();

            //set up all current textareas with class nicedit
            $('textarea.nicedit').each(function(i){
                niceditor['nicedit-' + (i+1)] = new nicEditor().panelInstance($(this).attr('id'));  
            });

            
            self.setupFocus();

            $('.content-inner').on('click', '.insert', function(){
                $(this).addClass('active');
            });
            
            $('.content-inner').on('click', '.add-placeholder', function(e){
                e.stopPropagation();
                self.addPlaceholder($(this).data('type'), $(this).parent().parent().parent());
                $(this).parent().parent().removeClass('active');
            });
            
            
            $('.content-inner').sortable({
                axis: 'y',
                handle: '.handle',
                // items: '.sortable-item',
                cursor: 'move'
            });
            
            $('.content-inner').on('click', '.delete', function(){
                $(this).parent().parent().parent().remove();
            });

        },

        setupFocus: function() {

            $('.content-inner').on('click', '.placeholder', function(){
                if($(this).find('.input').length > 0)
                    $(this).find('.input').focus();
                    
                if($(this).find('.input').hasClass('nicedit')){
                    $(this).find('.nicEdit-main').focus();
                }
                if($(this).hasClass('image')){
                    $(this).addClass('focus');
                    self.setOverlay(true);
                }
            }); 
            
            $('.content-inner').on('focus', '.input', function(){
                    $(this).parent('.placeholder').addClass('focus');
                    $(this).parent().parent('.placeholder').addClass('focus');
                    self.setOverlay(true);
            });
            
            $('.content-inner').on('blur', '.input', function(){
                    $(this).parent('.placeholder').removeClass('focus');
                    $(this).parent().parent('.placeholder').removeClass('focus');
                    self.setOverlay(false);
                    $('.insert').removeClass('force-focus');
            });
            
            $('.content-inner').on('blur', '.nicEdit-main', function(){
                    $(this).parent('.placeholder').removeClass('focus');
                    $(this).parent().parent('.placeholder').removeClass('focus');
                    self.setOverlay(false);
            });
            
        },
        
        addPlaceholder: function(type, placement) {
            tpl = $('#'+type+'-template').html();

            if(type == 'h1')
            {
                $(placement).after(_.template(tpl));
                $($.expandingTextarea.initialSelector).expandingTextarea();
                $('.force-focus').focus();
            }
            
            if(type == 'text')
            {
                textAreaCount++;
                $(placement).after(_.template(tpl, {id : 'nicedit-' + textAreaCount}));
                new nicEditor().panelInstance('nicedit-' + textAreaCount); 
                $('.force-focus').focus();
                $('.force-focus').parent().find('.nicEdit-main').focus();
                $('.force-focus').removeClass('force-focus');
            }
            
            if(type == 'image')
            {
                $(placement).after(_.template(tpl));
                $('.force-focus').focus();
            }
            
            
            
            
        },
        
        setOverlay: function(mode) {
            if(mode)
                $('body').addClass('overlay');
            else
                $('body').removeClass('overlay');
        },
        
        
        
        
        

    };

})();
$(document).ready(function(){
    cms.init();
});