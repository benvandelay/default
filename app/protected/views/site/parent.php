<div class="left">
    <?php $this->widget('RecentArticles'); ?>
</div>  

<div class="content">
    
    <h1><?php  echo $model->title; ?></h1>
    
    <?php echo $model->body; ?>
    
</div>