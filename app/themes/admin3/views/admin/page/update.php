<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-content.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-info.js', CClientScript::POS_HEAD); ?>

<div class="editor-nav">
    <span class="active" data-show="page-content">Content</span>
    <span data-show="page-info">Info</span>
    <span data-show="preview">preview</span>
    
    <div class="save-status page-content">
        <b class="saved">Version <?php echo $version->getCount(); ?> | <em><?php echo StringHelper::toTime($version->date); ?></em></b> 
        <b class="unsaved">Version <?php echo $version->getCount() + 1; ?> | Unsaved</b>
    </div>
    
    <div class="save-status page-info">
        <b class="saved"><em><?php echo StringHelper::toTime($model->modified); ?></em></b> 
        <b class="unsaved">Unsaved Changes</b> 
    </div>
    
</div>

<div class="editor page-content">
    <div class="white-bg"></div>
    <?php echo $this->renderPartial('_form', array('version'=>$version, 'model'=>$model)); ?>
</div>

<div class="editor page-info">
    <?php echo $this->renderPartial('_meta_form', array('model'=>$model)); ?>
</div>