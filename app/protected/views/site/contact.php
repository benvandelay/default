<div class="contact-wrap">
    
    <div class="inner">
        
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="flash ' . $key . '">' . $message . '</div>';
            }
        ?>
                      
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'contact-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                    'afterValidateAttribute' => 'js:app.afterValidateAttribute',
                    
                ),
                
        )); ?>
    
        <?php echo $form->errorSummary($model, '<h3>Woah.. Hold On</h3>', 'let\'s see if you can get it right this time'); ?>
    
        <div class="input validate">
            <label for="name">Name:</label>
            <?php echo $form->textField($model,'name'); ?>
            
        </div>
        <?php echo $form->error($model,'name'); ?>
    
        <div class="input validate">
            <label for="name">Email:</label>
            <?php echo $form->textField($model,'email'); ?>
            
        </div>
        <?php echo $form->error($model,'email'); ?>
    
        <div class="input">
            <label for="phone">Phone:</label>
            <?php echo $form->textField($model,'phone'); ?>
            
        </div>
        <?php echo $form->error($model,'phone'); ?>
    
        <div class="input validate">
            <label for="body">Message:</label>
            <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
            
        </div>
        <?php echo $form->error($model,'body'); ?>
    
        <?php if(CCaptcha::checkRequirements()): ?>
        <div class="captcha">
            <h3>Are you a Robot?</h3>
            <div>
            
            <?php $this->widget('CCaptcha'); ?>
            <p>If not, please type those letters here</p>
            <?php echo $form->textField($model,'verifyCode'); ?>
            </div>
            
            <?php echo $form->error($model,'verifyCode'); ?>
        </div>
        <?php endif; ?>
    
        <div class="row buttons">
            <?php echo CHtml::button('Send!'); ?>
            <?php echo CHtml::submitButton('Send!'); ?>
        </div>
    
        <?php $this->endWidget(); ?>
        
    </div>
    
</div>