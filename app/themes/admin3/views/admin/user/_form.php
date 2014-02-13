<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-user.js', CClientScript::POS_HEAD); ?>
<div class="single-user">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableClientValidation'=>true,
        //'enableAjaxValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => array(
            'class' => 'user-form',
        ),
    )); ?>
    
    <div class="left-col">
    
        <?php echo $form->errorSummary($model); ?>
    
        <div class="input text">
            <?php echo $form->labelEx($model,'first_name'); ?>
            <?php echo $form->textField($model,'first_name',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'first_name'); ?>
        </div>
    
        <div class="input text">
            <?php echo $form->labelEx($model,'last_name'); ?>
            <?php echo $form->textField($model,'last_name',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'last_name'); ?>
        </div>
    
        <div class="input text">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
    
        <div class="input text">
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->textField($model,'username',array('size'=>40,'maxlength'=>40)); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
    
        <div class="input text">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40)); ?>  
            <?php echo $form->error($model,'password'); ?> 
        </div>
        
        <div class="input text">
            <?php echo $form->labelEx($model,'permission'); ?>
            <?php echo $form->textField($model,'permission'); ?>
            <?php echo $form->error($model,'permission'); ?>
        </div>
        
    
        
    </div>
    
    <div class="right-col">
        <div class="user-image-wrap<?php echo !$model->image ? ' empty-image' : ''?>">
            <input type="file" id="uploadify" />
            <?php echo $model->image ? ImageHelper::resize($model->image->filename, 'admin_user') : ''; ?>
            <?php echo $form->hiddenField($model, 'image_id'); ?>
            <?php echo $form->error($model,'image_id'); ?>
        </div>
    </div>
    
    <div class="row buttons">
        <div class="save-wrap">
            <?php echo CHtml::link('Cancel', array('index'), array('class'=>'btn cancel')); ?>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn save')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

    </div>
</div><!-- form -->