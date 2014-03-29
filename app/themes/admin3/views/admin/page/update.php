<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/tag-it.min.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-content.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-info.js', CClientScript::POS_HEAD); ?>

<div class="editor page-info">
    <?php echo $this->renderPartial('_info_form', array('model' => $model)); ?>
</div>

<div class="editor page-content">
    
    <div class="save-status">
        <b class="saved">Version <?php echo $version->getCount(); ?> | <em><?php echo StringHelper::toTime($version->date); ?></em></b> 
        <b class="unsaved">Version <?php echo $version->getCount() + 1; ?> | Unsaved</b>
    </div>
    
    <div class="white-bg"></div>
    <?php echo $this->renderPartial('_form', array('version'=>$version, 'model'=>$model)); ?>
</div>