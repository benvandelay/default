<div class="image-list-wrap">
    <h1>Images</h1>
        
    <div class="gallery-admin-wrap">
        <?php $this->widget('GalleryImageList', array(
            'dataProvider'=>$imageDataProvider,
            'model'=>$model
         ));  ?> 
         <div class="clear"></div>
    </div>
    
    <div class="inner">    
        <div class="row buttons">
           <a class="btn add-new-image">New Image</a>
           <div class="clear"></div>
        </div>
    </div>  
    
    <div class="cancel">
         <a class="modal-close">Cancel</a>
         <div class="clear"></div>
    </div>
    
</div>

<?php 
    Yii::app()->clientScript->registerScriptFile('/js/admin/modal.js');
    Yii::app()->clientScript->registerScriptFile('/js/admin/uploadify/uploadify.min.js', CClientScript::POS_HEAD);
?>

<div class="add-image-wrap">
    <h1>Add Image</h1>
    <div class="inner">
        <div class="toggle-box">
            <a data-id="new-image" class="toggle-btn active">New Image</a>
            <a data-id="old-image" class="toggle-btn">Existing Image</a>
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
        
        <?php echo $form->hiddenField($image,'id'); ?>
        
        <div id="new-image" class="toggle-item first">
            <div class="admin-left">
                <div class="image-upload-wrap">
                    <img src="/images/admin/blank.jpg" />
                    <input type="file" name="uploadify" id="uploadify" />
                    <?php echo $form->hiddenField($image,'filename'); ?>
                </div>
                <?php echo $form->error($image,'filename'); ?>
            </div>
            <div class="admin-right">
                <div class="input text">
                    <?php echo $form->labelEx($image,'title'); ?>
                    <?php echo $form->textField($image,'title',array('rows'=>6, 'cols'=>50)); ?>
                </div>
                <?php echo $form->error($image,'title'); ?>
                
                <div class="input text">
                    <?php echo $form->labelEx($image,'body'); ?>
                    <?php echo $form->textArea($image,'body',array('rows'=>6, 'cols'=>50)); ?>
                </div>
                <?php echo $form->error($image,'body'); ?>
                
                <div class="row buttons">
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
        <a class="modal-close">Cancel</a>
         <a class="cancel-add-image">&laquo; Back to Images</a>
         <div class="clear"></div>
    </div>
</div>