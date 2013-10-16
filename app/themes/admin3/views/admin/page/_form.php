<?php Yii::app()->clientScript->registerScriptFile('/js/admin/redactor.min.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile('/js/admin/expand.js', CClientScript::POS_HEAD); ?>

<?php 

    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'update-page-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnChange' => true,
        ),
        'htmlOptions' => array(
            'class' => 'editor-form'
        ),
        
    )); 
?>

    <?php echo $form->errorSummary($version); ?>
       
    <div class="header-image-wrap">
        <div class="empty-image"></div>
    </div>
       
    <?php echo $form->textArea($version,'header', array('class' => 'expanding')); ?>
    <?php echo $form->error($version,'header'); ?>
       
    <?php echo $form->textArea($version,'body'); ?>
    <?php echo $form->error($version,'body'); ?>
        
    <div class="row buttons">
        
        <div class="status<?php echo $model->status != 0 ? ' published' : ''; ?>">
            <?php echo $form->radioButtonList($model,'status', array('0'=>'unpublished', '1'=>'published'), array('separator'=>false)); ?>
        </div>
        
        <div class="save-wrap">
            <?php echo CHtml::link('Cancel', array('admin/page'), array('class'=>'btn cancel')); ?>
            <?php echo CHtml::submitButton($version->isNewRecord ? 'Create' : 'Save', array('class'=>'btn save')); ?>
        </div>
        
        <div class="clear"></div>
    </div>  
    
<?php $this->endWidget(); ?>