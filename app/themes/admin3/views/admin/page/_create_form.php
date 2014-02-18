<?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'page-form',
        'enableAjaxValidation'=>true,
        'action'=>$model->isNewRecord ? '/admin/page/create/' : '/admin/page/' . $model->id,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnChange' => true,
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'class' => 'user-form',
        ),
    ));
?>

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
    

    <div class="row buttons">
        <div class="save-wrap">
            <?php echo CHtml::link('Cancel', array('admin/page'), array('class'=>'btn cancel')); ?>
            <?php echo CHtml::submitButton('Start Editing!', array('class'=>'btn save')); ?>  
        </div>
    </div>  

    
<?php $this->endWidget(); ?>