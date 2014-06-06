<div class="article-wrap <?php echo $version->image ? 'has-image' : 'no-image'; ?>" data-id="<?php echo $model->id; ?>">

    <?php echo $version->image ? ImageHelper::resize($version->image->filename, 'large') : '<div class="blank-image"></div>' ?>

    <div class="editor-content"> 
        
        <h1><?php echo $version->header; ?></h1>
        
        <div class="date"><?php echo StringHelper::displayDate($model->date); ?> &nbsp; | &nbsp; <?php echo $model->author->first_name; ?> <?php echo $model->author->last_name; ?></div>
        
        <?php echo $version->body; ?>
        
    </div>
    
    <div class="article-footer">
        <a href="/" class="back-home"><span class="icon icon-arrow-left"></span><span class="icon icon-home"></span></span></a>    
    </div>
    
</div>