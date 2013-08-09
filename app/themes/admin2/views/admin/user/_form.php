<div class="inner-content">
    <div class="form">
        <div class="two-column-wrap">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'user-form',
                'enableAjaxValidation'=>true,
            )); ?>
            
                <?php echo $form->errorSummary($model); ?>
            
                <div class="input text">
                    <?php echo $form->labelEx($model,'first_name'); ?>
                    <?php echo $form->textField($model,'first_name',array('rows'=>6, 'cols'=>50)); ?>
                </div>
                <?php echo $form->error($model,'first_name'); ?>
            
                <div class="input text">
                    <?php echo $form->labelEx($model,'last_name'); ?>
                    <?php echo $form->textField($model,'last_name',array('rows'=>6, 'cols'=>50)); ?>
                </div>
                <?php echo $form->error($model,'last_name'); ?>
            
                <div class="input text">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
                </div>
                <?php echo $form->error($model,'email'); ?>
            
                <div class="input text">
                    <?php echo $form->labelEx($model,'username'); ?>
                    <?php echo $form->textField($model,'username',array('size'=>40,'maxlength'=>40)); ?>
                </div>
                <?php echo $form->error($model,'username'); ?>
            
                <div class="input text">
                    <?php echo $form->labelEx($model,'password'); ?>
                    <?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40)); ?>   
                </div>
                <?php echo $form->error($model,'password'); ?>
                
                <div class="input text">
                    <?php echo $form->labelEx($model,'permission'); ?>
                    <?php echo $form->textField($model,'permission'); ?>
                </div>
                <?php echo $form->error($model,'permission'); ?>
            
                <div class="row buttons">
                    <?php echo CHtml::link('Cancel', array('index'), array('class'=>'btn')); ?>
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn')); ?>
                </div>
                <div class="clear"></div>
            <?php $this->endWidget(); ?>
        </div>
    </div><!-- form -->
</div>