var search = (function(){

    var self,
        term,
        input,
        cont,
        statusCount,
        statusId,
        status,
        page,
        endScroll,
        template,
        loadingText,
        doneText,
        mod;

    return {

        init: function(){
            
            self        = this;
            term        = '';
            input       = $('input#search');
            cont        = $('#messages');
            statusCount = {unread : 0, read : 0, deleted : 0, all : 0}, //id:count
            status      = 'all';
            statusId    = {unread : 0, read: 1, deleted: 2},
            item        = '.message';
            page        = 0;
            endScroll   = false;
            
            loadingText = 'Loading More...';
            doneText    = 'There Are No More Results';
            
            template  = {
                article : _.template($( "script#message" ).html())
            };
            
            mod       = {cmd : false, alt : false};
            
            self.updateArticles();
            self.setupSearch();
            self.updateArticlesOnScroll();
            self.setUpStatusFilter();
            self.setUpDelete();
            self.setupView();
            self.getCounts();
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
            term = input.val();
            self.updateArticlesOnSearch();
        },
        
        updateArticlesOnSearch: function(){
            
            page = 0; //reset to first page of results
            self.updateArticles(term);
            
        },
        
        updateArticlesOnScroll: function(){
            
            $(window).on('scroll', _.throttle(function(){
                if(self.isScrolledIntoView($(item).last()) && !endScroll){
                    page++;
                    self.updateArticles(input.val());
                }
            }, 1000));
            
        },
        
        //grabs articles based on page number and term 
        //and appends them to the index page
        updateArticles: function(){

            $.getJSON('/admin/message/getMessagesJson/' + status, 
                {
                    page: page,
                    term: term
                }
            ).done(function(r) {
                
                //endScroll = _.isEmpty(r);
                endScroll = (r.length < 10);
                
                if(page == 0){
                    window.scrollTo(0,0);
                    cont.html('');
                }
                    
                
                _.each(r, function(article){
                    cont.append(template.article(article));
                });
                
                $(item + '.new').removeClass('new');
                        
                if(endScroll)
                    $('.loading').text(doneText);
                else
                    $('.loading').text(loadingText);

                });
        },
        
        setUpStatusFilter: function(){
            
            $('.message-filter').on('click', function(){
                $('.message-filter').removeClass('active');
                status = $(this).data('status-name');
                page = 0;
                self.updateArticles();
                $(this).addClass('active');
            });
            
        },
        
        setUpDelete: function(){
            
            $(cont).on('click', item +' .icon-close', function(e){
                
                e.stopPropagation();
                elm = $(this).parent().parent();

                if(statusId[elm.data('status')] != 2) {//deleted
                    self.updateStatus(elm, 'deleted', elm.data('status'));
                }
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
        },
        
        setupView: function(){
            $(cont).on('click', item +' .header', function(){
                elm = $(this).parent();
                elm.toggleClass('open');
                if(statusId[elm.data('status')] == 0) {//unread
                    self.updateStatus(elm, 'read', 'unread');
                    elm.data('status', 'read');
                }
            });
        },
        
        updateStatus: function(elm, newStatus, oldStatus) {
            $.getJSON('/admin/message/updateStatus/', 
                {
                    mid: elm.data('mid'),
                    status: statusId[newStatus]
                }
            ).done(function(r) {
                if(r){
                    elm.removeClass(oldStatus).addClass(newStatus);
                    elm.find('.status').text(newStatus);
                    
                    statusCount[newStatus] = parseInt(statusCount[newStatus]) + 1;
                    statusCount[oldStatus] = parseInt(statusCount[oldStatus]) - 1;
                    
                    if(newStatus == 'deleted'){
                        elm.fadeOut('slow', self.updateArticles());
                        statusCount.all = parseInt(statusCount.all) - 1;
                    }
                    
                    self.updateFilterMenu();
                }
            });
        },
        
        
        getCounts: function() {
            statusCount.all     = $('.message-filter[data-status-name="all"] span').text();
            statusCount.unread  = $('.message-filter[data-status-name="unread"] span').text();
            statusCount.read    = $('.message-filter[data-status-name="read"] span').text();
            statusCount.deleted = $('.message-filter[data-status-name="deleted"] span').text();
            self.updateUnreadFlag();
        },
        
        
        updateFilterMenu: function() {
            $('.message-filter[data-status-name="all"] span').text(statusCount.all);
            $('.message-filter[data-status-name="unread"] span').text(statusCount.unread);
            $('.message-filter[data-status-name="read"] span').text(statusCount.read);
            $('.message-filter[data-status-name="deleted"] span').text(statusCount.deleted);
            self.updateUnreadFlag();
        },
        
        updateUnreadFlag: function() {
            flagelm = $('.message-filter[data-status-name="unread"]');
            statusCount.unread > 0 ? flagelm.addClass('has-new') : flagelm.removeClass('has-new');
        }

    };

})();
$(document).ready(function(){
    search.init();
});