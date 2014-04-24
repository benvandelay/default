<div class="article-wrap <?php echo $model->published_content->image ? 'has-image' : 'no-image'; ?>" data-id="<?php echo $model->id; ?>">

    <?php echo $model->published_content->image ? ImageHelper::resize($model->published_content->image->filename, 'admin_large') : '<div class="blank-image"></div>' ?>

    <div class="editor-content"> 
        
        <h1><?php echo $model->title; ?></h1>
        
        <div class="date"><?php echo StringHelper::displayDate($model->date); ?> &nbsp; | &nbsp; <?php echo $model->author->first_name; ?> <?php echo $model->author->last_name; ?></div>
        
        <?php echo $model->content->body; ?>
        
    </div>
    
    <div class="article-footer">
        
        <div class="text"><a href="/">Ben Walker</a> <span>&nbsp;//&nbsp;</span> <a href="/contact">Contact Me!</a></div>
        
        <div class="socials">
            <a href="http://www.facebook.com/benvandelay" target="_blank" class="icon icon-facebook"></a>
            <a href="http://www.github.com/benvandelay" target="_blank" class="icon icon-github"></a>
        </div>
        
        <div class="clb"></div>
        
    </div>
    
</div>