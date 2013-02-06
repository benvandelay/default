    <!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <?php
    Yii::app()->clientScript->registerCssFile('/css/admin/admin.css');
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile('/js/admin/admin.js', CClientScript::POS_HEAD);
    ?>

</head>
    <body class="login">
    <?php echo $content; ?>
    </body>
</html>
