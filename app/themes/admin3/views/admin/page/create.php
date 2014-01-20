<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-info.js', CClientScript::POS_HEAD); ?>

<div class="editor page-info show">
    <?php echo $this->renderPartial('_meta_form', array('model'=>$model)); ?>
</div>