var editInfo = (function(){

    var self,
        existingTags;

    return {

        init: function(){

            self             = this;
            existingTags     = '';
            self.tagit();
            self.displayDate();
        },
        
        displayDate: function(){
            
            $('#display_date').datepicker({
                altField   : '#Page_display_date',
                altFormat  : 'yy-mm-dd 12:00:00',
                dateFormat : 'M dd yy',
                maxDate    : 0,
                onSelect: function(date, inst){
                    $('.date').removeClass('active');
                    $('.date.other').addClass('active');
                }
            });
            
            $('.dates .date').not('.other').on('click', function(){
                $('.date').removeClass('active');
                $(this).addClass('active');
                $('#Page_display_date').val($(this).data('value'));
            });
        },
        
        tagit: function(){
            
            $(document).ready(function() {
                $("#category-list").tagit({
                    allowSpaces             : true,
                    placeholderText         : 'Add Category',
                    showAutocompleteOnFocus : true,
                    fieldName               : 'Page[categories][]',
                    autocomplete            : {
                        source    : function(request, response){
                            results = $.get('/admin/page/getCategories?term=' + request.term + '&exclude=' + encodeURIComponent(existingTags)).done(function(data){

                                response($.map($.parseJSON(data), function(item) {
                                    return { label: item };
                                }));
                            });

                        },
                        appendTo  : '.tagit-new',
                        delay     : 0, 
                        minLength : 2
                    },
                    
                    beforeTagAdded : function(event, ui) {
                        ui.tag.prepend($('<div class="icon icon-checkmark" />'));
                    },
                    onTagExists : function(e, obj) {
                        //TODO something here
                        return false;
                    },
                    afterTagAdded : function(event, ui) {
                        existingTags += ui.tag.find('.tagit-label').text() + ',';
                    },
                    afterTagRemoved : function(event, ui) {
                        existingTags = existingTags.replace((ui.tag.find('.tagit-label').text() + ','), '');
                        console.log(existingTags);
                    }
                });
            });
        },

    };

})();
$(document).ready(function(){
    editInfo.init();
});