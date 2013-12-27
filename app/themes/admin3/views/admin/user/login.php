<?php
$this->pageTitle=Yii::app()->name . '| Login';
$this->layout='//admin/layouts/login';
?>

<div class="login-form">
    
    <h2><?php echo Yii::app()->name; ?> <span class="light">Admin Login</span></h2>
    
    <div class="inner-form-wrap">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>false,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        
        <div class="input">
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->textField($model,'username'); ?> 
        </div>
        <?php echo $form->error($model,'username'); ?>
    
        <div class="input">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password'); ?>
        </div>
        <?php echo $form->error($model,'password'); ?>
    
        <div class="row remember-me">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe'); ?>
        </div>
    
        <div class="row buttons">
            <?php echo CHtml::submitButton('Login',array('class'=>'btn green')); ?>
        </div>
        <div class="clear"></div>
        
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
