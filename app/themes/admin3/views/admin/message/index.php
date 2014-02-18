<div class="search">

    <span class="icon icon-search"></span>

    <input type="text" id="search" autocomplete="off"  placeholder="Find a Message..." />
 
</div>

<div class="messages" id="messages">
    
</div>
<div class="loading">Loading More...</div>

<?php // article list template 
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl .'/js/searchMessages.js');
$this->renderPartial('_message');
?>
