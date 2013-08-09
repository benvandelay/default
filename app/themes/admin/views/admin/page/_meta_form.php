<div class="title-info">
    Page Info
</div>

<?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'category-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnChange' => true,
        ),
    )); 
?>

<div class="two-column-wrap">
    <div class="meta-right">
        <div class="edit-widget">
            
            <h2>Categorize</h2>
            
            <div class="inner">
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
            </div>
            <div class="widget-controls">
                <a href="javascript:void(0);" id="new-category" class="new-cateogry">New Category</a>
                <div class="clear"></div>
            </div>
        </div> 
    </div>
    
    <div class="clr-r"></div>
</div> 


<div class="row buttons">
    <?php echo CHtml::submitButton('Save', array('class'=>'btn')); ?>
    <?php echo CHtml::link('Cancel', array('all'), array('class'=>'btn')); ?>
    <div class="clear"></div>
</div>  
    
<?php $this->endWidget(); ?>