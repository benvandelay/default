<?php $this->widget('AdminGridView', array(
            'id'=>'image-grid',
            'dataProvider'=>$imageDataProvider,
            'rowCssClassExpression'=>'$data->status == 0 ? "unpublished" : "published"',
            'rowDataLinkExpression'=>'"/admin/image/" . $data->id',
            'columns'=>array(
                array('name'=>'image', 'type'=>'html', 'htmlOptions'=>array('class'=>'thumb'), 'value'=>'CHtml::image("/images/uploads/thumb_".$data->filename)'),
                array('name'=>'caption', 'htmlOptions'=>array('class'=>'title')),
                array(
                    'name'=>'status', 
                    'htmlOptions'=>array('class'=>'status'), 
                    'type'=>'html', 
                    'value'=>array($this,'getStatus'),
                ),
                array(
                    'name'=>'date', 
                    'htmlOptions'=>array('class'=>'date')
                ),
                array(
                    'class'=>'CButtonColumn', 
                    'template'=>'{delete}',
                    'buttons'=>array(
                        'delete'=>array(
                            'class'=>'delete',
                            'imageUrl'=>false,
                            'label'=>false,
                        ),
                    ),
                    'deleteButtonUrl'=>'"/admin/image/delete/id/{$data->id}"'
                ), 
            ),
        ));  ?>

