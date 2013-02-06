<div class="left">
    <?php $this->widget('RecentArticles'); ?>
</div>  

<div class="content">
    
    <div class="article-header">
        <h1><?php  echo $model->title; ?></h1>
        <div class="date"><?php echo $model->date; ?></div>
    </div>
    
    <?php echo $model->body; ?>
    
</div>