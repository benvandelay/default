<div class="contact-wrap">
    
    <div class="inner">
        
        <h1>Contact Me</h1>
        
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
    
        <div class="inputs">
            
            <input type="hidden" name="pen15">
            
            <div class="input validate">
                <label for="name">Name:</label>
                <?php echo $form->textField($model,'name', array('placeholder' => 'Name')); ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
            
        
            <div class="input validate email">
                <label for="name">Email:</label>
                <?php echo $form->textField($model,'email', array('placeholder' => 'Email')); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
            
        
            <div class="input">
                <label for="phone">Phone:</label>
                <?php echo $form->textField($model,'phone', array('placeholder' => 'Phone')); ?>
                <?php echo $form->error($model,'phone'); ?>
            </div>
            
            
            <div class="clb"></div>
            
        </div>
    
        <h2>What do you have to say for yourself?</h2>
        <div class="textarea validate">
            <label for="body">Message:</label>
            <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
            
        </div>
        <?php echo $form->error($model,'body'); ?>
    
        <div class="row buttons">
            <?php echo CHtml::submitButton('Send!'); ?>
        </div>
    
        <?php $this->endWidget(); ?>
        
    </div>
    
</div>