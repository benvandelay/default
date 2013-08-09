<div class="header">
    <h1>Edit Page <b><?php echo $model->title; ?></b></h1>
    <?php $this->widget('CreateNewPageButton'); ?>

</div>

<div class="inner-content">
    
    <div class="dates"><?php echo $model->page_type->name; ?>Created: <?php echo $model->date; ?></div>
    
    <ul class="update-nav">
        <li id="content" data-show="content" class="active">Page Content</li>
        <li id="images" data-show="images">Images</li>
        <li id="meta" data-show="meta">Meta Data</li>
    </ul>
  
    <div class="form">
       
        <div class="edit content" id="content">
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
        
        <div class="edit images" id="images">
            <?php echo $this->renderPartial('_gallery_form', array('imageDataProvider'=>$imageDataProvider, 'model'=>$model)); ?>
        </div>
        
        <div class="edit meta" id="meta">
            <?php echo $this->renderPartial('_meta_form', array('model'=>$model)); ?>
        </div>
    
    </div><!-- form -->
</div>