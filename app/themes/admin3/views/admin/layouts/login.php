<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <?php
        Yii::app()->clientScript->registerCssFile('/themes/admin3/css/stylesheets/style.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile('/js/admin/admin.js', CClientScript::POS_HEAD);
    ?>

</head>
    <body class="login">
        <?php echo $content; ?>
    </body>
</html>
