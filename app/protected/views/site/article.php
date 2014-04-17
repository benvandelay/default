<div class="article-wrap">
    
    <?php echo $model->published_content->image ? ImageHelper::resize($model->published_content->image->filename, 'admin_large') : '<div class="blank-image"></div>' ?>

    <div class="editor-content"> 
        
        <h1><?php  echo $model->title; ?></h1>
        
        <div class="date"><?php echo StringHelper::displayDate($model->date); ?> &nbsp; | &nbsp; <?php echo $model->author->first_name; ?> <?php echo $model->author->last_name; ?></div>
        
        <?php echo $model->content->body; ?>
        
    </div>
    
</div>