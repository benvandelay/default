<?php Yii::app()->clientScript->registerScriptFile('/js/admin/edit-content.js', CClientScript::POS_HEAD); ?>
<div class="editor-nav">
    <span class="active" data-show="page-content">Page Content</span>
    <span data-show="page-info">Page Info</span>
</div>

<div class="byline">
    <div class="left"><?php echo Yii::app()->request->getServerName() . '/' . $model->slug; ?></div>
    <div class="right"><?php echo StringHelper::displayDate($model->date); ?></div>
</div>

<div class="editor page-content">
    <?php echo $this->renderPartial('_form', array('version'=>$version, 'model'=>$model)); ?>
</div>

<div class="editor page-info">
    <?php echo $this->renderPartial('_meta_form', array('model'=>$model)); ?>
</div>


<?php //echo $this->renderPartial('_form', array('version'=>$version, 'model'=>$model)); ?>