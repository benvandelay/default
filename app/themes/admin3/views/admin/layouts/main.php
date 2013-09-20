<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>SiteName</title>
    <?php
        Yii::app()->clientScript->registerCssFile('/themes/admin3/css/stylesheets/style.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        Yii::app()->clientScript->registerScriptFile('/js/admin/uploadify/uploadify.min.js', CClientScript::POS_HEAD);
    ?>

</head>
<body>
    <?php echo $content; ?>
</body>
</html>