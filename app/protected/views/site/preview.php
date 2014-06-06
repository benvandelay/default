<div class="article-wrap <?php echo $version->image ? 'has-image' : 'no-image'; ?>" data-id="<?php echo $model->id; ?>">

    <?php echo $version->image ? ImageHelper::resize($version->image->filename, 'large') : '<div class="blank-image"></div>' ?>

    <div class="editor-content"> 
        
        <h1><?php echo $version->header; ?></h1>
        
        <div class="date"><?php echo StringHelper::displayDate($model->date); ?> &nbsp; | &nbsp; <?php echo $model->author->first_name; ?> <?php echo $model->author->last_name; ?></div>
        
        <?php echo $version->body; ?>
        
    </div>
    
    <div class="article-footer">
        
        <div class="text">&copy; <?php echo date('Y'); ?>  Me &nbsp; <span>|</span> &nbsp; <a href="/contact">Contact Me!</a></div>
        
        <div class="socials">
            <a href="http://www.facebook.com/benvandelay" target="_blank" class="icon icon-facebook"></a>
            <a href="http://www.github.com/benvandelay" target="_blank" class="icon icon-github"></a>
        </div>
        
        <div class="clb"></div>
        
    </div>
    
</div>