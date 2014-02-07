<div class="users-list">
    <?php foreach ($model->search()->getData() as $user): ?>

        <div class="user">
            <?php if($user->image): ?>
                <?php echo CHtml::image(ImageHelper::resize($user->image->filename, 'admin_user', true), $user->first_name . ' ' . $user->last_name, array('width'=>50, 'height'=>50)); ?>
            <?php else: ?>
                <div class="blank-user-image"></div>
            <?php endif; ?>
            <div class="title"><?php echo $user->first_name . ' ' . $user->last_name; ?></div>
            <div class="user-info"><?php echo $user->username; ?> | <?php echo $user->email; ?></div>
            
            <?php if($user->id != Yii::app()->user->id): ?>
                <a class="delete icon icon-close"></a>
            <?php endif; ?>
            
        </div>
    
    <?php endforeach; ?>
</div>