<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->pageTitle; ?></title>
    
        <?php
            //styles
            Yii::app()->clientScript->registerCssFile('/css/style.css');
            
            //scripts
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile('/js/app.js', CClientScript::POS_HEAD);
        ?>
    
    </head>
    
    <body>
        <?php echo $content; ?> 
    </body>
    
</html>
