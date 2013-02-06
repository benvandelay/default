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

    <?php echo $form->errorSummary($contactModel, '<h3>Woah.. Hold On</h3>', 'let\'s see if you can get it right this time'); ?>

    <div class="input validate">
        <label for="name">Name:</label>
        <?php echo $form->textField($contactModel,'name'); ?>
        
    </div>
    <?php echo $form->error($contactModel,'name'); ?>

    <div class="input validate">
        <label for="name">Email:</label>
        <?php echo $form->textField($contactModel,'email'); ?>
        
    </div>
    <?php echo $form->error($contactModel,'email'); ?>

    <div class="input">
        <label for="phone">Phone:</label>
        <?php echo $form->textField($contactModel,'phone',array('size'=>60,'maxlength'=>128)); ?>
        
    </div>
    <?php echo $form->error($contactModel,'phone'); ?>

    <div class="input validate">
        <label for="body">Message:</label>
        <?php echo $form->textArea($contactModel,'body',array('rows'=>6, 'cols'=>50)); ?>
        
    </div>
    <?php echo $form->error($contactModel,'body'); ?>

    <?php if(CCaptcha::checkRequirements()): ?>
    <div class="captcha">
        <h3>Are you a Robot?</h3>
        <div>
        
        <?php $this->widget('CCaptcha'); ?>
        <p>If not, please type those letters here</p>
        <?php echo $form->textField($contactModel,'verifyCode'); ?>
        </div>
        
        <?php echo $form->error($contactModel,'verifyCode'); ?>
    </div>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::button('Send!'); ?>
        <?php echo CHtml::submitButton('Send!'); ?>
    </div>

<?php $this->endWidget(); ?>
                
                <div class="right sub">
                     <h3>Default Company Name</h3>
                     
                     <dl class="first">
                        <dt>Address</dt>
                        <dd>1234 Company Dr.<br />
                            Raleigh, NC 27612</dd>
                             
                        <dt></dt>
                        <dd><i>Open by appointment only</i></dd>
                        <dt></dt>
                        <dd><a target="_blank" href="#">Directions &raquo;</a></dd>
                    </dl>
                    
         
                    
                    <dl>
                        <dt>Phone</dt>
                        <dd>919.782.4184</dd>
                        
                        <dt>Email</dt>
                        <dd><a href="mailto:info@default.com">info@default.com</a></dd>
                    </dl>
                </div>