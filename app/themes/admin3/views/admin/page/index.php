<?php // search ?>
<div class="search">

    <span class="icon icon-search"></span>

    <input type="text" id="search" autocomplete="off"  placeholder="Find a Page..." />
 
</div>

<div class="articles" id="articles">
    
</div>

<?php // article list template 
Yii::app()->clientScript->registerScriptFile('/js/admin/underscore.js');
Yii::app()->clientScript->registerScriptFile('/js/admin/search.js');
$this->renderPartial('_article', array('model' => $model));
$this->renderPartial('_new_page_modal', array('model' => $model));

?>