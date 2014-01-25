var editInfo = (function(){

    var self,
        newCategoryCount;

    return {

        init: function(){

            self = this;
            newCategoryCount = 0;
            self.checkListItems();
            self.newCategory();
            self.publishedStatus();
        },

        checkListItems: function(){
            if($('.check-list-item').length){
                $('.check-list-item input').each(function(){
                    if($(this).is(':checked')){
                        $(this).parent().addClass('selected');
                    }
                });
                
                $('.check-list-item input').on('change', function(){
                    
                    $(this).parent().toggleClass('selected');
                    
                });
            }
        },
        
        newCategory: function(){
            $('#new-category').click(function(){
                $('#new-category-wrap').append(self.createCategoryInput());
                $('#new-category-wrap input').last().focus();
                newCategoryCount++;
            });  
        },

        createCategoryInput: function(){
            var categoryInput = $('<input type="text" />');
            categoryInput.attr('name', 'Page[new_category][' + newCategoryCount + ']');
            categoryInput.attr('placeholder', 'New Category');
            
            return categoryInput;
        },
        
        publishedStatus: function(){
            if($('.buttons .status').length){
                
                var value = $('#Page_status').val();
                
                if(value == 1){
                    $('.buttons .status').addClass('published');
                }
                $('.buttons .status').on('click', function(){
                    value = value == 1 ? 0 : 1;
                    $('#Page_status').val(value);
                    $(this).toggleClass('published');
                });
            }
            
        }

    };

})();
$(document).ready(function(){
    editInfo.init();
});