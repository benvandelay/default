<div class="header">
    <h1>Edit Page <b><?php echo $model->title; ?></b></h1>
    <?php $this->widget('CreateNewPageButton'); ?>

</div>

<div class="inner-content">
    
    <div class="dates">Created: <?php echo $model->date; ?></div>
    
    <ul class="update-nav">
        <li class="launch-modal" data-modal="image">Images</li>
        <li class="launch-modal" data-modal="page-info">Page Info</li>
    </ul>
  
    <div class="form">
       
        <div class="content">
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
        
        <div class="modal-wrapper image">
            <?php echo $this->renderPartial('_image_form', array('imageDataProvider'=>$imageDataProvider, 'model'=>$model, 'image'=>$image)); ?>
        </div>
        
        <div class="modal-wrapper page-info" >
            <?php echo $this->renderPartial('_meta_form', array('model'=>$model)); ?>
        </div>
    
    </div><!-- form -->
</div>