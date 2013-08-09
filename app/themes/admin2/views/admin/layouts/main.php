<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>SiteName</title>
    <?php
        Yii::app()->clientScript->registerCssFile('/themes/admin2/css/style.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        Yii::app()->clientScript->registerScriptFile('/js/admin2/app.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile('/js/admin2/nicEdit2.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile('/js/admin2/expand.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile('/js/admin2/underscore.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile('/js/admin2/uploadify/uploadify.min.js', CClientScript::POS_HEAD);
    ?>

</head>
<body>
   <div class="header-wrap">
       <span class="icon search">Search</span>
       Logged in as <strong><?php echo Yii::app()->user->first_name; ?> <?php echo Yii::app()->user->last_name; ?></strong>
       &nbsp; | &nbsp; 
       <?php echo CHtml::link('Logout',array('/logout')); ?>
   </div>
    
   <div class="main-nav-wrap">
       
       <ul>
           <li><a href="#" class="home"><span class="icon nav-item"></span>Home<span class="icon active-icon"></span></a></li>
           <li class="active"><a href="#" class="content"><span class="icon nav-item"></span>Content<span class="icon active-icon"></span></a></li>
           <li><a href="#" class="messages"><span class="icon nav-item"></span>Messages<span class="icon active-icon"></span></a></li>
           <li><a href="#" class="users"><span class="icon nav-item"></span>Users<span class="icon active-icon"></span></a></li>
           <li><a href="#" class="config"><span class="icon nav-item"></span>Configuration<span class="icon active-icon"></span></a></li>
       </ul>
       
   </div><!-- .main-nav-wrap -->
   
   <div class="sub-nav-wrap">
       
       <h2>Site Content</h2>
       
       <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. 
          Cras mattis consectetur purus sit amet fermentum. Etiam porta sem malesuada magna mollis euismod. 
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          
       <ul>
           <li class="active"><a href="#"><b>44</b>Main Pages</a></li>
           <li><a href="#"><b>10</b>Sub Pages</a></li>
           <li><a href="#"><b>34</b>Blog Pages</a></li>
       </ul>
       
   </div>
   
    <?php echo $content; ?>
</body>
</html>