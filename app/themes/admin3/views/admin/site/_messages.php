<div class="module">
    <h2><?php echo CHtml::link('Messages', array('/admin/message')); ?></h2>
    
    <a  href="<?php echo CHtml::normalizeUrl(array('admin/message')); ?>" class="inbox-count"><span class="<?php echo $message_count['unread'] ? 'has-new' : ''; ?>"><?php echo $message_count['unread']; ?></span> New</a>
    
    <a href="<?php echo CHtml::normalizeUrl(array('admin/message')); ?>" class="inbox-count"><span><?php echo $message_count['inbox']; ?></span> Inbox</a>
    
    <div class="foot">
        <?php echo CHtml::link('See Messages &raquo;' , array('admin/message'), array('class' => 'more-link')); ?>
    </div>
    
</div>