<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>SiteName</title>
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <?php
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/stylesheets/style.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/underscore.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/uploadify/uploadifive.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/admin.js', CClientScript::POS_HEAD);
    ?>

</head>
<body class="<?php echo Yii::app()->controller->action->id; ?>">
    <?php
          foreach(Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="flash '. $key . '">' . $message . "</div>";
          }
    ?>

    <div class="left-controls">
        <?php $this->widget('zii.widgets.CMenu', 
            array(
                'items'=>array(
                    array('label'=>'<span class="icon icon-home"></span> Dashboard', 'url'=>array('admin/site/index'), 'itemOptions' => array('class' => 'dashboard')),
                    array('label'=>'<span class="icon icon-cog"></span> Setup', 'url'=>array('admin/config/index'), 'itemOptions' => array('class' => 'setup')),
                    array('label'=>'<span class="icon icon-file"></span> Content', 'url'=>array('admin/page/index'), 'itemOptions' => array('class' => 'content'), 'active' => Yii::app()->controller->id=='admin/page'),
                    array('label'=>'<span class="icon icon-bubbles"></span> Messages', 'url'=>array('admin/contact/index'), 'itemOptions' => array('class' => 'messages')),
                    array('label'=>'<span class="icon icon-users"></span> People', 'url'=>array('admin/user/index'), 'itemOptions' => array('class' => 'people'))
                ), 
                'activeCssClass' => 'active', 
                'htmlOptions' => array('class' => 'main-nav'),
                'encodeLabel' => false
            )); 
        ?>
        
        <?php $this->widget('AdminSubMenu'); ?>
        
        <div class="login-info">
            <img src="http://www.placekitten.com/48/48" /> 
            <span><?php echo Yii::app()->user->first_name; ?> <?php echo Yii::app()->user->last_name; ?></span>
        </div>
    </div>
    
    <div id="content-body" class="content-body">
        
        <?php echo $content; ?>
        
    </div>
</body>
</html>

