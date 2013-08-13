<a class="gallery-image-item" data-id="<?php echo $data->id; ?>" data-title="<?php echo $data->title; ?>" data-body="<?php echo $data->body; ?>" data-filename="<?php echo $data->filename; ?>" data-filepath="<?php echo ImageHelper::filepath($data->filename); ?>" href="javascript:void(0);">
    
    <?php echo ImageHelper::resize($data->filename, 'thumb'); ?>
    
    <div class="info">
        <h2><?php echo $data->title; ?></h2>
    </div>
    
</a>
