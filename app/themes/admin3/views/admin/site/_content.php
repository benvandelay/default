<div class="module content">
    
    <h2><?php echo CHtml::link('Content', array('/admin/page')); ?></h2>

    <div class="content-count">
        <div class="block total"><b><?php echo $content_count['all']; ?></b><span>Articles</span></div>
        <div class="block published"><b><?php echo $content_count['published']; ?></b> <span>Published</span></div>
        <div class="block unpublished"><b><?php echo $content_count['unpublished']; ?></b> <span>Unpublished</span></div>
        <div class="clb"></div>
    </div>

    <?php foreach($content as $data): ?>

    <div class="list-item <?php echo $data->published_version ? 'active' : 'inactive'; ?>">
        <a href="<?php echo CHtml::normalizeUrl(array('admin/page/', 'id' => $data->id)); ?>"><?php echo $data->content->image ? ImageHelper::resize($data->content->image->filename, 'admin_thumb') : '<div class="blank"></div>'; ?></a>
        <a href="<?php echo CHtml::normalizeUrl(array('admin/page/', 'id' => $data->id)); ?>" class="title"><?php echo $data->title; ?></a>
        <div class="date"><?php echo StringHelper::displayDate($data->date); ?></div>
    </div>

    <?php endforeach; ?>
    
    <div class="foot">
        <?php echo CHtml::link('More Content &raquo;' , array('admin/page'), array('class' => 'more-link')); ?>
    </div>
    
</div>