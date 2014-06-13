<h1><?php echo Yii::app()->name; ?> Dashboard</h1>

<div class="dashboard-wrap">
    
    <?php $this->renderPartial('_content', array('content' => $content, 'content_count' => $content_count)); ?>
    
    <?php $this->renderPartial('_messages', array('message_count' => $message_count)); ?>

    <div class="clb"></div>

</div>
