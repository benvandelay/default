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
    
    <div class="categories">     
        <h2>Categorize</h2>
        
        <div class="inner">
            <ul class="category-list" id="category-list">
                <?php foreach(Chtml::listData($model->categories,'id','name') as $id => $name): ?>
                    <li><?php echo $name; ?></li>    
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="options">
            
        </div>
    </div>
    
</div>

<div class="clb"></div>

<div class="info-buttons">
    <?php echo CHtml::submitButton('Save', array('class'=>'btn save')); ?>
    <?php echo CHtml::link('Cancel', array('admin/page'), array('class'=>'btn cancel')); ?>
</div>

<?php $this->endWidget(); ?>