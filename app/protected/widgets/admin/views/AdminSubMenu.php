<?php $this->widget('zii.widgets.CMenu', array(
    'items'=>$this->controller->menu(), 
    'activeCssClass'=>'active', 
    'encodeLabel' => false,
    'htmlOptions' => array('class'=>'submenu')
)); ?>