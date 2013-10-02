<?php //new page modal form ?>
<div class="modal-wrapper new-page">
        
    <h2>Create a New Page</h2>
    
    <div class="content-wrap">
        
        <div id="child-page">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'htmlOptions'=> array(
                    'autocomplete' => 'off',
                ),
                'id'=>'page-form',
                'enableAjaxValidation'=>true,
                'action'=>'/admin/page/create/',
                'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    
            )); ?>

            <?php echo $form->errorSummary($model, '<div class="icon icon-warning"></div>'); ?>

            <div class="input text first">
                <?php echo $form->labelEx($model,'title'); ?>
                <?php echo $form->textField($model,'title'); ?>
                <?php echo $form->error($model,'title'); ?>
            </div>
            <div class="input text">
                <?php echo $form->labelEx($model,'slug'); ?>
                <?php echo $form->textField($model,'slug'); ?>
                <?php echo $form->error($model,'slug'); ?>
            </div>

        </div>

    </div>
    
    <div class="controls">
         <a class="modal-close btn cancel" href="#">Cancel</a>
         <?php echo CHtml::submitButton('Begin Editing', array('class'=>'btn save')); ?>
         <?php $this->endWidget(); ?>
    </div>
</div>