<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/tag-it.min.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-content.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-info.js', CClientScript::POS_HEAD); ?>


<!-- HEADER -->
<div class="editor-header">
    
    <div class="buttons">
        <a class="active show-page-content icon icon-file"></a>
        <a class="show-page-info icon icon-info"></a>
        <span class="separator"></span>
        <a class="view-preview icon icon-screen"></a>
    </div>
    
    <div class="save-status">
        <div class="saved">
            Version <?php echo $versions[$version->id]['version']; ?> | <em><?php echo StringHelper::toTime($version->date); ?></em>
        </div> 
        <div class="unsaved">Version <?php echo $version->getCount() + 1; ?> | Unsaved</div>
    </div>
    
    <div data-version-id="<?php echo $version->id; ?>" data-model-id="<?php echo $model->id; ?>" class="published-status <?php echo $model->published_version != $version->id ? 'unpublished' : 'published' ?>">
        <span class="unpublished icon icon-eye-blocked"></span>
        <span class="published icon icon-eye"></span>
    </div>
    
</div>

<!-- VERSIONS -->
<div class="version-list">
    <h2><?php echo count($versions); ?> Versions</h2>
    <span class="icon icon-close"></span>
    <?php foreach($versions as $i => $v): ?>
        <?php $class = $v['id'] == $model->published_version ? 'version published' : 'version'; ?>
        <?php $class .= $version->id == $v['id'] ? ' active' : ''; ?>
        <a data-id="<?php echo $v['id']; ?>" href="<?php echo CHtml::normalizeUrl(array('admin/page/update', 'id' => $model->id, 'version_id' => $v['id'])); ?>" class="<?php echo $class; ?>">
            <i>Version <?php echo $v['version'] ?></i> 
            <?php echo StringHelper::toTime($v['date']); ?>
            
            <span class="icon icon-eye"></span>
        </a>
    <?php endforeach; ?>
    <div class="clb"></div>
</div>

<!-- INFO -->
<div class="editor page-info">
    <?php echo $this->renderPartial('_info_form', array('model' => $model)); ?>
</div>

<!-- CONTENT -->
<div class="editor page-content">
    <div class="white-bg"></div>
    <?php echo $this->renderPartial('_form', array('version'=>$version, 'model'=>$model)); ?>  
</div>