<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <?php
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/stylesheets/style.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/admin.js', CClientScript::POS_HEAD);
    ?>

</head>
    <body class="login">
        <?php echo $content; ?>
    </body>
</html>
