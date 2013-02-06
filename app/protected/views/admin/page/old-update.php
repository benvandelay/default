<div class="header">
    <h1><?php echo $this->title; ?></h1>
</div>

<?php if($imageDataProvider): ?>
    <div class="toggle-box">
        <span>Edit:</span> 
        <a class="btn edit-content active" id="show-content" href="#">Page Content</a> 
        <a class="btn edit-gallery" id="show-gallery" href="#">Gallery Images</a>  
    </div>
<?php endif; ?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'page-form',
        'enableAjaxValidation'=>true,
    )); ?>
    
    <div class="right-options">
        <?php if($model->page_type_id == 2): ?>
            <div class="widget">
                <?php echo $this->renderPartial('_category_select', array('model'=>$model, 'form'=>$form)); ?>
            </div>
        <?php endif; ?>
        
        <?php if($model->page_type_id == 1): ?>
            <div class="widget">
                <?php echo $this->renderPartial('_parent_page_select', array('model'=>$model, 'form'=>$form)); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="content-form">
        <?php echo $this->renderPartial('_form', array('model'=>$model, 'form'=>$form)); ?>
    </div>
    
    <div class="row buttons">
        <div class="status warning">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->radioButtonList($model,'status', array('0'=>'not published', '1'=>'published'), array('separator'=>false)); ?>
        </div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn')); ?>
        <?php echo CHtml::link('Cancel', array('all'), array('class'=>'btn')); ?>
    </div>  
    
<?php $this->endWidget(); ?>
</div><!-- form -->


<?php if($imageDataProvider): ?>
    <div class="gallery-images">
        <?php echo $this->renderPartial('_gallery_form', array('model'=>$model, 'imageDataProvider'=>$imageDataProvider)); ?>
    </div>
<?php endif; ?>
