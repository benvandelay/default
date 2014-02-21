<h1>Users</h1>
<div class="users-list">
    <?php foreach ($model->search()->getData() as $user): ?>

        <a href="<?php echo CHtml::normalizeUrl(array('/admin/user/update', 'id'=>$user->id)); ?>" class="user <?php echo $user->active ? 'active' : 'inactive'; ?>">
            <?php if($user->image): ?>
                <?php echo CHtml::image(ImageHelper::resize($user->image->filename, 'admin_user', true), $user->first_name . ' ' . $user->last_name, array('width'=>50, 'height'=>50)); ?>
            <?php else: ?>
                <div class="blank-user-image"></div>
            <?php endif; ?>
            <div class="title"><?php echo $user->first_name . ' ' . $user->last_name; ?></div>
            <div class="user-info"><?php echo $user->username; ?></div>
            
            <span class="icon icon-pencil"></span>
            
        </a>
    
    <?php endforeach; ?>
</div>