<div class="left">
    
    <div class="sidebar-widget">
        <h2>Other Children</h2>
        <p>These are the other child pages</p>
    </div>
    
    <?php $this->widget('RecentArticles'); ?>
    
</div>

<div class="content">
    
    <h1><?php  echo $model->title; ?></h1>
    
    <?php echo $model->body; ?>

</div>