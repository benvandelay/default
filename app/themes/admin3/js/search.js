var search = (function(){

    var self,
        input,
        cont,
        page,
        endScroll,
        template,
        loadingText,
        doneText,
        mod;

    return {

        init: function(){
            
            self      = this;
            input     = $('input#search');
            cont      = $('#articles');
            page      = 0;
            limit     = 10;
            endScroll = false;
            
            loadingText = 'Loading More...';
            doneText    = 'There Are No More Results';
            
            template  = {
                article : _.template($( "script#article" ).html())
            };
            
            mod       = {cmd : false, alt : false};
            
            self.updateArticles('');
            self.setupSearch();
            self.updateArticlesOnScroll();
        },
        
        
        setupSearch: function(){
            
            var searchKeyPressed = 0;
            
            $(document).on({ 
                
                keydown: function(e){
                    
                    clearTimeout(searchKeyPressed);
                    self.setMod(e);
                    self.setAutoFocus(e);
                    
                },
                keyup: function(){
                    
                    self.setMod(false);
                    
                    searchKeyPressed = setTimeout(function(){
                        self.onKeyUp();
                    }, 200)
                    
                }
                
                 
            });
            
        },
        
        onKeyUp: function(){
           
            self.updateArticlesOnSearch(input.val());
        },
        
        updateArticlesOnSearch: function(term){
            
            page = 0; //reset to first page of results
            self.updateArticles(term);
            
        },
        
        updateArticlesOnScroll: function(){
            
            $(window).on('scroll', _.throttle(function(){
                if(self.isScrolledIntoView($('.article').last()) && !endScroll){
                    page++;
                    self.updateArticles(input.val());
                }
            }, 1000));
            
        },
        
        //grabs articles based on page number and term 
        //and appends them to the index page
        updateArticles: function(term){

            $.getJSON('/admin/page/getArticlesJson', 
                {
                    page: page,
                    term: term
                }
            ).done(function(r) {
                
                endScroll = (r.length < limit);
                //endScroll = _.isEmpty(r);
                
                if(page == 0){
                    window.scrollTo(0,0);
                    cont.html('');
                }
                    
                
                _.each(r, function(article){
                    cont.append(template.article(article));
                });
                
                $('.article.new').hide().fadeIn('slow').removeClass('new');
                        
                if(endScroll)
                    $('.loading').text(doneText);
                else
                    $('.loading').text(loadingText);

                });
        },
        
        
        
        setMod: function(e){
            if(!e){
                mod.cmd = false;
                mod.alt = false;
            }else{
                if(e.keyCode == 91)
                    mod.cmd = true;
                
                if(e.keyCode == 18)
                    mod.alt = true;
            }
        },
        
        
        setAutoFocus: function(e){
            if((!$('input').is(':focus') && !$('textarea').is(':focus') && !mod.cmd && !mod.alt) || input.is(':focus')){
                if((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode > 64 && e.keyCode < 90)) {
                    input.focus();
                }
            }
            
        },
        
        isScrolledIntoView: function(elem)
        {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();
        
            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(elem).height();
        
            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }
        

    };

})();
$(document).ready(function(){
    search.init();
});