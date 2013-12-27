var editInfo = (function(){

    var self;

    return {

        init: function(){

            self = this;
            self.checkListItems();
        },

        checkListItems: function(){
            if($('.check-list-item').length){
                $('.check-list-item input').each(function(){
                    if($(this).is(':checked')){
                        $(this).parent().addClass('selected');
                    }
                });
                
                $('.check-list-item').on('click', function(){
                    $(this).addClass('selected').find('input').prop('checked', true);
                });
            }
        }

    };

})();
$(document).ready(function(){
    editInfo.init();
});