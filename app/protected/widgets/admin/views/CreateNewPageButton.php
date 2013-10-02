<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/modal.css');
Yii::app()->clientScript->registerScriptFile('/js/admin/modal.js');
?>
<div class="modal-wrapper new-page">
    
    <h2>Create a New Page</h2>
    <div class="content-wrap">
        
        <div id="child-page">
            <?php $this->render('_new_page_form', array('model'=>new Page));?>
        </div>

    </div>
    
    
    <div class="controls">
         <a class="modal-close" href="#">Cancel</a>
    </div>
</div>

<a class="btn new launch-modal" data-modal="new-page" href="#"><span class="icon plus"></span>New Page</a>