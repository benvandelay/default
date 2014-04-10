<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->pageTitle; ?></title>
    
        <?php
            //styles
            Yii::app()->clientScript->registerCssFile('/css/stylesheets/style.css');
            
            //scripts
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile('/js/underscore.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile('/js/search.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile('/js/app.js', CClientScript::POS_HEAD);
        ?>
    
    </head>
    
    <body>
        <div class="wrap">
            <?php echo $content; ?> 
        </div>
    </body>
    
</html>
