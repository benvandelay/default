<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-user.js', CClientScript::POS_HEAD); ?>
<div class="single-user">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
            'clientOptions' => array(
                'validateOnChange' => true,
                'validateOnSubmit' => true,
            ),
        'htmlOptions' => array(
            'class' => 'user-form',
        ),
    )); ?>
    
    <div class="left-col">
    
        <?php echo $form->errorSummary($model); ?>
    
        <div class="input text">
            <?php echo $form->labelEx($model,'first_name'); ?>
            <?php echo $form->textField($model,'first_name'); ?>
            <?php echo $form->error($model,'first_name'); ?>
        </div>
    
        <div class="input text">
            <?php echo $form->labelEx($model,'last_name'); ?>
            <?php echo $form->textField($model,'last_name'); ?>
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
            <?php echo $form->labelEx($model,'password_confirm'); ?>
            <?php echo $form->passwordField($model,'password_confirm',array('size'=>40,'maxlength'=>40, 'autocomplete' => 'off')); ?>  
            <?php echo $form->error($model,'password_confirm'); ?> 
        </div>
    
        <?php if(Yii::app()->user->isAdmin()): ?>
        
        <div class="input dropdown">
            <div class="arrow"></div>
            <?php echo $form->labelEx($model,'permission'); ?>
            <?php echo CHtml::activeDropDownList($model, 'permission', array(0=>'Admin', 99=>'Author')); ?>
            <?php echo $form->error($model,'permission'); ?>
        </div>
        
        <?php endif; ?>
        
    </div>
    
    <div class="right-col">
        <div class="user-image-wrap<?php echo !$model->image ? ' empty-image' : ''?>">
            <input type="file" id="uploadify" />
            <?php echo $model->image ? ImageHelper::resize($model->image->filename, 'admin_user') : ''; ?>
            <?php echo $form->hiddenField($model, 'image_id'); ?>
            <?php echo $form->error($model,'image_id'); ?>
        </div>
        
        <?php if(Yii::app()->user->isAdmin()): ?>
            
        <div class="ready status<?php echo $model->active != 0 ? ' published' : ''; ?>">
            
            <div class="off">
                <div class="label true">Active <span class="icon icon-checkmark"></span></div>
                <div class="label false">Inactive <span class="icon icon-close"></span></div>
            </div>
            
            <div class="on">
                <div class="label true">Activate User? <span class="icon icon-checkmark"></span></div>
                <div class="label false">Deactivate User? <span class="icon icon-close"></span></div>
            </div>
            
            <?php echo $form->hiddenField($model,'active'); ?>
        </div>

        <?php endif; ?>
        
    </div>
    
    <div class="clb"></div>

    <div class="buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn save')); ?>
        <?php echo CHtml::link('Cancel', array('index'), array('class'=>'btn cancel')); ?>
        
        <div class="clb">
    </div>

    <?php $this->endWidget(); ?>

    </div>
</div><!-- form -->