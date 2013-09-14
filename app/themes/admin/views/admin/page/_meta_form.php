<div class="title-info">
    Page Info
</div>

<?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'meta-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnChange' => true,
        ),
    )); 
?>

<div class="title-info">

    <div class="input text">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    <?php echo $form->error($model,'title'); ?>
    
    <div class="input">
        <?php echo $form->labelEx($model,'slug'); ?>
        <?php echo Yii::app()->request->getServerName(); ?>/
        <?php echo $form->textField($model,'slug',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    <?php echo $form->error($model,'slug'); ?>
    
</div>

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