<?php Yii::import('application.controllers.admin.ContactController'); ?>
<?php Yii::import('application.controllers.admin.PageController'); ?>

<h3><?php echo CHtml::link('Site Content', array('/admin/page/all')); ?></h3>
<?php $this->widget('zii.widgets.CMenu', array('items'=>PageController::menu(), 'activeCssClass'=>'active', 'encodeLabel'=>false)); ?>

<h3><?php echo CHtml::link('Contacts', array('/admin/contact')); ?></h3>
<?php $this->widget('zii.widgets.CMenu', array('items'=>ContactController::menu(), 'activeCssClass'=>'active', 'encodeLabel'=>false)); ?>

<h3><?php echo CHtml::link('Manage', array('/admin/user')); ?></h3>