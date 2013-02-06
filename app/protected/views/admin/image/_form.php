<?php
Yii::app()->clientScript->registerCssFile('/css/admin/uploadify.css');
Yii::app()->clientScript->registerScriptFile('/js/admin/uploadify/uploadify.min.js', CClientScript::POS_HEAD);
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'image-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>false,
        'clientOptions'=>array(
                'validateOnChange'=>false,
                'validateOnSubmit'=>true,
        ),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    
<div class="admin-left">
    <div class="image-upload-wrap">
        <img src="<?php echo $model->filename ? Yii::app()->params['image']['uploadPath'] . '/' . $model->filename : '/images/admin/blank.jpg'; ?>" />
        <input type="file" name="uploadify" id="uploadify" />
        <?php echo $form->hiddenField($model,'filename',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    <?php echo $form->error($model,'filename'); ?>
</div>
<div class="admin-right">
    <div class="input text">
        <?php echo $form->labelEx($model,'caption'); ?>
        <?php echo $form->textField($model,'caption',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    <?php echo $form->error($model,'caption'); ?>
</div>    
<div class="clear"></div>
    
    
    <div class="row buttons">
        <div class="status warning">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->radioButtonList($model,'status', array('0'=>'not published', '1'=>'published'), array('separator'=>false)); ?>
        </div>
        <?php echo CHtml::link('Cancel', array('/admin/page/'.$model->page), array('class'=>'btn')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn')); ?>
        
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->