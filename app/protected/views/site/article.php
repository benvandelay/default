<div class="article-wrap <?php echo $model->published_content->image ? 'has-image' : 'no-image'; ?>" data-id="<?php echo $model->id; ?>">

    <?php echo $model->published_content->image ? ImageHelper::resize($model->published_content->image->filename, 'large') : ''; ?>

    <div class="editor-content"> 
        
        <h1><?php echo $model->published_content->header; ?></h1>
        
        <div class="date"><?php echo StringHelper::displayDate($model->display_date); ?> &nbsp; | &nbsp; <?php echo $model->author->first_name; ?> <?php echo $model->author->last_name; ?></div>
        
        <?php echo SiteHelper::setUpLazyload($model->published_content->body); ?>
        
    </div>
    
    <div class="article-footer">
        <a href="/" class="back-home"><span class="icon icon-arrow-left"></span><span class="icon icon-home"></span></span></a>    
    </div>
    
    
</div>