<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_site_nav_link',
    'itemsTagName'=>'ul',
    'summaryText'=>false,
    'htmlOptions'=>array('class'=>'main-nav')
));?>
