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
   

    <?php
        
        $this->widget('ext.redactor.ImperaviRedactorWidget', array(
            // You can either use it for model attribute
            'model' => $model,
            'attribute' => 'body',
        
            // Some options, see http://imperavi.com/redactor/docs/
            'options' => array(
                'buttons'=>array('html', '|', 'bold', 'italic', '|', 'unorderedlist', 'orderedlist', '|', 'image', 'video', 'link', '|', 'alignment')
                
            ),
        ));
    ?>
    

    
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