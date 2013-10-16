<?php Yii::app()->clientScript->registerScriptFile('/js/admin/edit-info.js', CClientScript::POS_HEAD); ?>
<div class="content info">
    <?php echo $this->renderPartial('_meta_form', array('model'=>$model)); ?>
</div>