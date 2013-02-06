<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/modal.css');
Yii::app()->clientScript->registerScriptFile('/js/admin/modal.js');
Yii::app()->clientScript->registerScript('Create New Page Button', 
'
$("a.btn.new").click(function(){
    $(".modal-wrapper.new-page").modal({
        overlayClose: true,
        position: ["100px"],
        closeClass: "modal-close",
    });
});
',
CClientScript::POS_READY
);
?>
<div class="modal-wrapper new-page">
    
    <h1>Create a New Page</h1>
    <div class="inner">
        <div class="toggle-box">
            <a data-id="child-page" href="javascript:void(0);" class="toggle-btn active">Child Page</a>
            <a data-id="article" href="javascript:void(0);" class="toggle-btn">Article</a>
            <div class="clear"></div>
        </div>
        
        <div id="child-page" class="toggle-item first">
            <div class="explain">
                <p>Create a subpage of a parent page. Parent pages appear on your sitewide navigation.</p>
            </div>
            <?php $this->render('_new_child_page_form', array('model'=>new Page));?>
        </div>
        
        <div id="article" class="toggle-item">
            <div class="explain">
                <p>Create a blog article.</p>
            </div>
            <?php $this->render('_new_article_form', array('model'=>new Page));?>
        </div>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="cancel">
         <a class="modal-close" href="#">Cancel</a>
         <div class="clear"></div>
    </div>
</div>
<a class="btn new" href="#"><span class="icon plus"></span>New Page</a>