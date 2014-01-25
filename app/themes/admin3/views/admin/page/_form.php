<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/redactor9.1.4.min.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/expand.js', CClientScript::POS_HEAD); ?>
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
       
    <div class="header-image-wrap<?php echo !$version->image ? ' empty-image' : ''?>">
        <input type="file" id="uploadify" />
        <?php echo $version->image ? ImageHelper::resize($version->image->filename, 'admin_large') : ''; ?>
        <?php echo $form->hiddenField($version, 'image_id'); ?>
    </div>
       
    <?php echo $form->textArea($version, 'header', array('class' => 'expanding')); ?>
    <?php echo $form->error($version, 'header'); ?>
       
    <?php echo $form->textArea($version, 'body'); ?>
    <?php echo $form->error($version, 'body'); ?>
    
    <div class="row buttons">
        
        <div class="save-wrap">
            <?php echo CHtml::link('Cancel', array('admin/page'), array('class'=>'btn cancel')); ?>
            <?php echo CHtml::submitButton($version->isNewRecord ? 'Create' : 'Save', array('class'=>'btn save')); ?>
        </div>
        
        <div class="clear"></div>
    </div>  
    
<?php $this->endWidget(); ?>