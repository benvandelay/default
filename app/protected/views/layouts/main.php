<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->pageTitle; ?></title>
        
        <meta property="og:url" content="http://default.com"/>
        <meta property="og:title" content="Default Site"/>
        <meta property="og:site_name" content="Default Site"/>
        <meta property="og:type" content="website"/>
        <meta property="og:image" content="http://default.com/images/ogimage.jpg"/>
        <meta property="og:description" content="This is a default description"/>
        <meta name="robots" content="NOODP">
    
        <?php
            //styles
            Yii::app()->clientScript->registerCssFile('/css/style.css');
            
            //scripts
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile('/js/app.js', CClientScript::POS_HEAD);
        ?>
    
    </head>
    
    <body>
        <div class="wrapper">
            <div class="header">
                <a href="/" class="logo">Logo</a>
                <?php //$this->widget('SiteNav'); ?>
                <div class="clr"></div>
            </div>
            
                <?php echo $content; ?> 
                
            <div class="footer">
                Copyright &copy; <?php echo date('Y');?> :: <?php echo Yii::app()->name;?>
            </div>
        </div>
    </body>
    
</html>
