<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-content.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-info.js', CClientScript::POS_HEAD); ?>

<div class="editor-nav">
    <span class="active" data-show="page-content">Page Content</span>
    <span data-show="page-info">Page Info</span>
    
    <div class="save-status page-content">
        <b class="saved">Version <?php echo $version->getCount(); ?> | <em><?php echo StringHelper::toTime($version->date); ?></em></b> 
        <b class="unsaved">Version <?php echo $version->getCount() + 1; ?> | Unsaved</b>
    </div>
    
    <div class="save-status page-info">
        <b class="saved">Last Saved <?php echo StringHelper::toTime($model->modified); ?></b> 
        <b class="unsaved">Unsaved Changes</b> 
    </div>
    
</div>

<div class="editor page-content">
    <?php echo $this->renderPartial('_form', array('version'=>$version, 'model'=>$model)); ?>
</div>

<div class="editor page-info">
    <?php echo $this->renderPartial('_meta_form', array('model'=>$model)); ?>
</div>