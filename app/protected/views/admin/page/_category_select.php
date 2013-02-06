<div class="category-list">
    <?php
        echo CHtml::activeCheckBoxList(
        $model,
        'categoryIds',
        Chtml::listData(Category::model()->findAll(),'id','name'),
        array('template'=>'<div class="check-list-item">{input} {label}</div>', 'separator'=>false)
        );
    ?>
</div>
    
<div id="new-category-wrap"></div>

<a href="javascript:void(0);" id="new-category" class="new-cateogry">New Category...</a>