<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>SiteName</title>
    <?php
        Yii::app()->clientScript->registerCssFile('/themes/admin/css/admin.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile('/js/admin/admin.js', CClientScript::POS_HEAD);
    ?>
</head>
    <body>
        <div class="header-wrap">
            <h2 class="left"><a href="/admin"><?php echo Yii::app()->name; ?> <span class="light">Admin</span></a></h2>
            
            <div class="right login-status">
                Logged in as <strong><?php echo Yii::app()->user->first_name; ?> <?php echo Yii::app()->user->last_name; ?></strong>
                &nbsp; | &nbsp; 
                <?php echo CHtml::link('Logout',array('/logout')); ?>
                
                <span class="to-site"><a href="http://<?php echo Yii::app()->request->getServerName(); ?>">Go to Site &raquo;</a></span>
            </div>
            
            <ul class="right">

                <!-- <li class="to-site"><a href="http://<?php echo Yii::app()->request->getServerName(); ?>">Go to Site &raquo;</a></li> -->
            </ul>
            <div class="clear"></div>
        </div>
        <div class="breadcrumbs">
            <span class="icon home"></span> 
            <a href="/admin">Dashboard</a> 
            &nbsp;::&nbsp; 
            <a href="/<?php echo $this->id; ?>"><?php echo $this->name; ?></a> 
            &nbsp;::&nbsp; 
            <?php echo $this->title; ?>
        </div>
        
        <div class="body-wrap">
            
            <?php
                  foreach(Yii::app()->user->getFlashes() as $key => $message) {
                    echo '<div class="flash '. $key . '">' . $message . "</div>";
                  }
            ?>
            
            <div class="left"> 
                <?php $this->widget('AdminMenu'); ?>
            </div>
            
            <div class="main-content-wrap">
                    <?php echo $content; ?>
            </div>
            
            <div class="clear"></div>
        </div>
        
    </body>
</html>