<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->pageTitle; ?></title>
        
        <link href='http://fonts.googleapis.com/css?family=Asap:700|Quattrocento+Sans:400,700' rel='stylesheet' type='text/css'>
        
        <?php
            //styles
            Yii::app()->clientScript->registerCssFile('/css/stylesheets/style.css');
            
            //scripts
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerCoreScript('yiiactiveform');
            Yii::app()->clientScript->registerScriptFile('/js/underscore.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile('/js/jquery.pjax.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile('/js/search.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile('/js/app.js', CClientScript::POS_HEAD);
            
        ?>
        <script src='/js/prism.js' data-manual></script>
    
    </head>
    <body class="<?php echo ($this->action->id == 'page' || $this->action->id == 'preview') ? 'open-article' : ''; ?>">
        
        <div class="wrap">
            
            <div class="site-header">
                <div class="inner">
                    
                    <div class="ben">
                        <span class="icon icon-arrow-right"></span>
                        <span class="icon icon-arrow-down"></span> 
                        <a class="home" href="/">Benjamin Walker</a>
                        
                        <ul class="categories">
                            <?php foreach(CHtml::listData(PageCategory::model()->findAll(array('group'=>'t.category_id', 'distinct'=>true)), 'category_id', 'category.name') as $id => $category): ?>
                                <li data-id="<?php echo $id; ?>" ><?php echo $category; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <input id="search" type="text" autocomplete="off" />
                    
                    <div class="socials">
                        <a href="/contact" target="_blank" class="icon icon-mail"></a>
                        <a href="http://www.facebook.com/benvandelay" target="_blank" class="icon icon-facebook"></a>
                        <a href="http://www.github.com/benvandelay" target="_blank" class="icon icon-github"></a>
                    </div>
                </div>
            </div>
            
            <div class="article-list">
                
                <div class="articles" id="articles"></div>
                
                <div class="loading">Loading More...</div>
                
                <?php // article list template 
                    $this->renderPartial('_article');
                ?>

            </div>
            
            <div class="page-wrap" id="response">
                <?php echo $content; ?> 
            </div>
            
            <div id="loader"></div>
            
        </div>
    </body>
    
</html>
