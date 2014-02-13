<div class="search">

    <span class="icon icon-search"></span>

    <input type="text" id="search" autocomplete="off"  placeholder="Find a Page..." />
 
</div>

<div class="articles" id="articles">
    
</div>
<div class="loading">Loading More...</div>

<?php // article list template 
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl .'/js/search.js');
$this->renderPartial('_article');
?>