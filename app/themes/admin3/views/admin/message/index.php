<?php 

    $this->widget('AdminGridView', array(
        'id'=>'contact-grid',
        'dataProvider'=>$model->search($scope),
        'rowDataLinkExpression'=>'"/admin/contact/" . $data->id',
        'rowCssClassExpression'=>'$data->status == 0 ? "new" : "read"',
        'columns'=>array(
            array('name'=>'date', 'htmlOptions'=>array('class'=>'date')),
            array('name'=>'name'),
            array('name'=>'email'),
            array('name'=>'body', 'htmlOptions'=>array('class'=>'gray')),
            array(
                'class'=>'CButtonColumn', 
                'template'=>'{delete}',
                'buttons'=>array(
                    'delete'=>array(
                        'class'=>'delete',
                        'imageUrl'=>false,
                        'label'=>false
                    ),
                ),
            ),
        ),
    )); 
?>
