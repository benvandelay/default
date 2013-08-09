<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'article-page-form',
    'enableAjaxValidation'=>true,
    'action'=>'/admin/page/create/',
    'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="input text">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
    </div>
    <?php echo $form->error($model,'title'); ?>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Begin Editing', array('class'=>'btn create')); ?>
    </div>

<?php $this->endWidget(); ?>