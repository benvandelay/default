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
            self.checkForUpdates();
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
            if($('.status').length){
                
                var value = $('#Page_status').val();
                
                if(value == 1){
                    $('.status').addClass('published');
                }
                $('.status').on('click', function(){
                    value = value == 1 ? 0 : 1;
                    $('#Page_status').val(value);
                    $(this).toggleClass('published');
                    
                    $(this).removeClass('ready').on('mouseleave', function(){
                        $(this).addClass('ready')
                    });
                });
            }
        },
        
        checkForUpdates: function(){
            $('#meta-form').formChange({
                pollInterval   : 2000,
                pollCallback   : function(form, change){
                    if(change){
                        $('.save-status.page-info').addClass('unsaved');
                        form.find('.btn.save').removeClass('disabled');
                    }else{
                        $('.save-status.page-info').removeClass('unsaved');
                        form.find('.btn.save').addClass('disabled');
                    }
                },
                submitCallback : function(form, change, event){
                    if(!change)
                        event.preventDefault();
                }
            });
        },

    };

})();
$(document).ready(function(){
    editInfo.init();
});