<?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'page-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnChange' => true,
        ),
    )); 
?>
    
<?php echo $form->errorSummary($model); ?>

<div class="title-info">

    <div class="input text">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    <?php echo $form->error($model,'title'); ?>
    
    <div class="input">
        <?php echo $form->labelEx($model,'slug'); ?>
        <?php echo Yii::app()->request->getServerName(); ?>/
        <?php echo $form->textField($model,'slug',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    <?php echo $form->error($model,'slug'); ?>
    
</div>
   
    <div class="cke-wrap">
    <?php
        $this->widget('ext.ckeditor.CKEditorWidget',array(
            "model"=>$model,               # Data-Model
            "attribute"=>'body',           # Attribute in the Data-Model
            "defaultValue"=>$model->body,  # Optional
            "config" => array(
                "height"=>"300px",
                "width"=>"100%",
                "toolbar"=>"Ben",
            ),
            "ckEditor"=>Yii::app()->basePath."/../ckeditor/ckeditor.php", # Optional address settings if you did not copy ckeditor on application root
            "ckBasePath"=>Yii::app()->baseUrl."/ckeditor/",                         # Path to ckeditor.php
        ));
    ?>
    </div>
    
    <?php echo $form->error($model,'body'); ?>
    
    <div class="row buttons">
        <div class="status <?php echo $model->status == 1 ? 'published' : 'unpublished'; ?>">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->radioButtonList($model,'status', array('0'=>'not published', '1'=>'published'), array('separator'=>false)); ?>
        </div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn')); ?>
        <?php echo CHtml::link('Cancel', array('all'), array('class'=>'btn')); ?>
        <div class="clear"></div>
    </div>  
        
    <?php $this->endWidget(); ?>