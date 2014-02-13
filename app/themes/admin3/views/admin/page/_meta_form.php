<?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'meta-form',
        'enableAjaxValidation'=>true,
        'action'=>$model->isNewRecord ? '/admin/page/create/' : '/admin/page/' . $model->id,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnChange' => true,
        ),
        'htmlOptions' => array(
            'class' => 'user-form',
        ),
    ));
?>

<div class="left-col">
    
    <?php echo $form->errorSummary($model); ?>

    <div class="input text">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>
    
    
    
    <div class="input">
        <?php echo $form->labelEx($model,'slug'); ?>
        <?php //echo Yii::app()->request->getServerName(); ?>
        <?php echo $form->textField($model,'slug'); ?>
        <?php echo $form->error($model,'slug'); ?>
    </div>
    
    
    <div class="input">
        <?php echo $form->labelEx($model,'excerpt'); ?>
        <?php echo $form->textArea($model,'excerpt',array('rows'=>6)); ?>
        <?php echo $form->error($model,'slug'); ?>
    </div>
    
</div> 
    
<div class="right-col">
    
    <div class="ready status<?php echo $model->status != 0 ? ' published' : ''; ?>">
        
        <div class="off">
            <div class="label true">Published <span class="icon icon-checkmark"></span></div>
            <div class="label false">Not Published <span class="icon icon-close"></span></div>
        </div>
        
        <div class="on">
            <div class="label true">Publish Now? <span class="icon icon-checkmark"></span></div>
            <div class="label false">Unublish This? <span class="icon icon-close"></span></div>
        </div>
        
        <?php echo $form->hiddenField($model,'status'); ?>
    </div>
    
    <div class="categories">     
        <h2>Categorize</h2>
        
        <div class="inner">
            <div class="category-list">
                <?php
                    echo CHtml::activeCheckBoxList(
                    $model,
                    'categoryIds',
                    Chtml::listData(Category::model()->findAll(),'id','name'),
                    array('template'=>'<div class="check-list-item">{input} {label}<b class="icon icon-checkmark"></b></div>', 'separator'=>false)
                    );
                ?>
            </div>
            
            <div id="new-category-wrap">
                <input type="text" name="Page[new_category][0]" placeholder="New Category">
            </div>
        </div>

    </div>
    
</div>
    
    <div class="clb"></div>

	<div class="row buttons">
    
    	<div class="save-wrap">
	        <?php echo CHtml::link('Cancel', array('admin/page'), array('class'=>'btn cancel')); ?>
	        <?php echo CHtml::submitButton('Save', array('class'=>'btn save disabled')); ?>
	    </div>
	    <div class="clear"></div>
	    
	</div>
    
<?php $this->endWidget(); ?>