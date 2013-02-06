<div class="title-info">
    Images
</div>

<div class="gallery-admin-wrap">
    <?php $this->widget('GalleryImageList', array(
        'dataProvider'=>$imageDataProvider,
        'model'=>$model
     ));  ?> 
     <div class="clear"></div>
</div>

<div class="row buttons">
   <?php //echo CHtml::link('Add New', array('admin/image/create', 'page_id'=>$model->id));?>
   <?php $this->widget('CreateNewImageButton'); ?>
   <div class="clear"></div>
</div>
