<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/modal.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/uploadify.css');
Yii::app()->clientScript->registerScriptFile('/js/admin/modal.js');
Yii::app()->clientScript->registerScriptFile('/js/admin/uploadify/uploadify.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('Create New Image Button', 
'
$("a.btn.new-image").click(function(){
        $("#image-form")[0].reset(); 
        $(".image-upload-wrap img").attr("src", "/images/admin/blank.jpg")
        admin.launchImageModal();
});
',
CClientScript::POS_READY
);
?>
<div class="modal-wrapper new-image">
    
    <h1>Add Image</h1>
    <div class="inner">
        <div class="toggle-box">
            <a data-id="new-image" href="javascript:void(0);" class="toggle-btn active">New Image</a>
            <a data-id="old-image" href="javascript:void(0);" class="toggle-btn">Existing Image</a>
            <div class="clear"></div>
        </div>
        
        <?php         
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'image-form',
                'action'=>'/admin/image/create/' . $_GET['id'],
                'enableAjaxValidation'=>true,
                'enableClientValidation'=>true,
                'clientOptions' => array(
                    'validateOnChange' => true,
                ),
            )); 
        ?>
        
        <?php echo $form->hiddenField($model,'id'); ?>
        
        <div id="new-image" class="toggle-item first">
            <div class="admin-left">
                <div class="image-upload-wrap">
                    <img src="/images/admin/blank.jpg" />
                    <input type="file" name="uploadify" id="uploadify" />
                    <?php echo $form->hiddenField($model,'filename'); ?>
                </div>
                <?php echo $form->error($model,'filename'); ?>
            </div>
            <div class="admin-right">
                <div class="input text">
                    <?php echo $form->labelEx($model,'title'); ?>
                    <?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50)); ?>
                </div>
                <?php echo $form->error($model,'title'); ?>
                
                <div class="input text">
                    <?php echo $form->labelEx($model,'body'); ?>
                    <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
                </div>
                <?php echo $form->error($model,'body'); ?>
                
                <div class="row buttons">
                    <div class="status">
                        <?php echo $form->labelEx($model,'status'); ?>
                        <?php echo $form->radioButtonList($model,'status', array('0'=>'not published', '1'=>'published'), array('separator'=>false)); ?>
                    </div>
                    <?php echo CHtml::submitButton('Save', array('class'=>'btn')); ?>
                    <?php $this->endWidget(); ?>
                </div>
                
            </div>    
            <div class="clear"></div>
        </div>
        
        <div id="old-image" class="toggle-item">
            
        </div>

        <div class="clear"></div>
         
    </div>

    <div class="clear"></div>

    
    <div class="cancel">
         <a class="modal-close" href="#">Cancel</a>
         <div class="clear"></div>
    </div>
</div>

<a class="btn new-image" href="#">Add Image</a>