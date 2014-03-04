<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo Yii::app()->name; ?> Admin</title>
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <?php
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/stylesheets/style.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/underscore.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/uploadify/uploadifive.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.formChange.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/admin.js', CClientScript::POS_HEAD);
    ?>

</head>
<body class="<?php echo Yii::app()->controller->action->id; ?> <?php echo substr(Yii::app()->controller->id, 6); ?>">
    <?php
          foreach(Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="flash '. $key . '">' . $message . "</div>";
          }
    ?>

    <div class="left-controls">
        <?php $this->widget('zii.widgets.CMenu', 
            array(
                'items'=>array(
                    array('label'=>'<span class="icon icon-home"></span> Dashboard', 'url'=>array('admin/site/index'), 'itemOptions' => array('class' => 'dashboard'), 'active' => Yii::app()->controller->id=='admin/site'),
                    array('label'=>'<span class="icon icon-cog"></span> Setup', 'url'=>array('admin/config/index'), 'itemOptions' => array('class' => 'setup')),
                    array('label'=>'<span class="icon icon-file"></span> Content', 'url'=>array('admin/page/index'), 'itemOptions' => array('class' => 'content'), 'active' => Yii::app()->controller->id=='admin/page'),
                    array('label'=>'<span class="icon icon-bubbles"></span> Messages', 'url'=>array('admin/message/index'), 'itemOptions' => array('class' => 'messages')),
                    array('label'=>'<span class="icon icon-users"></span> People', 'url'=>array('admin/user/index'), 'itemOptions' => array('class' => 'people'), 'active' => Yii::app()->controller->id=='admin/user')
                ), 
                'activeCssClass' => 'active', 
                'htmlOptions' => array('class' => 'main-nav'),
                'encodeLabel' => false
            )); 
        ?>
        
        <?php $this->widget('AdminSubMenu'); ?>
        
        <div class="login-info">
            <?php echo CHtml::link(CHtml::image(ImageHelper::resize(Yii::app()->user->avatar, 'admin_user', true), Yii::app()->user->first_name . ' ' . Yii::app()->user->last_name, array('width'=>50, 'height'=>50)), array('admin/user/update', 'id'=>Yii::app()->user->id)); ?>
            <?php echo CHtml::link(Yii::app()->user->first_name . ' ' . Yii::app()->user->last_name, array('admin/user/update', 'id'=>Yii::app()->user->id), array('class'=>'name')); ?>
            <?php echo CHtml::link('logout', array('admin/user/logout'), array('class'=>'logout')); ?>
        </div>
    </div>
    
    <div id="content-body" class="content-body">
        
        <?php echo $content; ?>
        
    </div>
</body>
</html>

