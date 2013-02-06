<div class="sidebar-widget">
    <h2>Recent Articles</h2>
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_recent_article',
        'itemsTagName'=>'ul',
        'summaryText'=>false,
        'htmlOptions'=>array('class'=>'recent-articles')
    ));?>
</div>