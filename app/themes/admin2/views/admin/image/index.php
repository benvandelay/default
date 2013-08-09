<div class="header">
    <h1><?php echo $this->title; ?></h1>
</div>

<div class="admin-header">
    <div class="search-wrap">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>Yii::app()->createUrl($this->route),
            'method'=>'post',
        )); ?>
        <?php echo CHtml::textField('search', $model->search); ?>
        <?php echo CHtml::submitButton(''); ?>
        <?php $this->endWidget(); ?>
    </div>
</div>


<?php $this->widget('AdminGridView', array(
    'id'=>'image-grid',
    'dataProvider'=>$model->search(),
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
                    'label'=>false
                ),
            ),
        ), 
    ),
)); ?>
