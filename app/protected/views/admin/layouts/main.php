<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>SiteName</title>
    <?php
        Yii::app()->clientScript->registerCssFile('/css/admin/admin.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile('/js/admin/admin.js', CClientScript::POS_HEAD);
    ?>
</head>
    <body>
        <div class="header-wrap">
            <h2 class="left"><?php echo Yii::app()->name; ?> <span class="light">Admin</span></h2>
            
            <?php 
            //build out main menu 
            //TODO extend CMenu for this functionality
            $menu = array(
                'Dashboard'=>'admin/site',
                'Site Content'=>'admin/page',
                'Contacts'=>'admin/contact',
                'Users'=>'admin/user',    
            );
            $nav = '';
            foreach($menu as $label=>$controller) {
                $active = $controller == Yii::app()->controller->id ? ' class="active"' : '';
                $nav.= '<li'.$active.'><a href="/'.$controller.'">'.$label.'</a></li>';
            }
            ?>
            
            <ul class="right">
                <?php echo $nav; ?>
                <li class="to-site"><a href="http://<?php echo Yii::app()->request->getServerName(); ?>">Go to Site &raquo;</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        
        <div class="user-status">
            <div class="left">
                <span class="icon home"></span> 
                <a href="/admin">Dashboard</a> 
                &nbsp;::&nbsp; 
                <a href="/<?php echo $this->id; ?>"><?php echo $this->name; ?></a> 
                &nbsp;::&nbsp; 
                <?php echo $this->title; ?>
            </div>
            <div class="right">
                Logged in as <?php echo Yii::app()->user->first_name; ?> <?php echo Yii::app()->user->last_name; ?> 
                &nbsp; | &nbsp; 
                <?php echo CHtml::link('Logout',array('admin/user/logout')); ?>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="body-wrap">
            
            <?php
                  foreach(Yii::app()->user->getFlashes() as $key => $message) {
                    echo '<div class="flash '. $key . '">' . $message . "</div>";
                  }
            ?>
            
            <div class="left">
                <?php if(Yii::app()->controller->id == 'admin/page')  $this->widget('CreateNewPageButton'); ?>
                    
                <?php $this->widget('zii.widgets.CMenu', array('items'=>$this->menu(), 'activeCssClass'=>'active' )); ?>
            </div>
            
            <div class="main-content-wrap">
                <?php echo $content; ?>
            </div>
            
            <div class="clear"></div>
        </div>
        
    </body>
</html>