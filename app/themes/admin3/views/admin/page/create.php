<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/edit-info.js', CClientScript::POS_HEAD); ?>
<h1>New Page</h1>
<div class="editor create-page">
    <?php echo $this->renderPartial('_create_form', array('model'=>$model)); ?>
</div>