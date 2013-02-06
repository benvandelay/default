<div class="header">
    <h1><?php echo $this->title; ?></h1>
</div>

<div class="admin-header">
    <div class="search-wrap">
    <?php $form=$this->beginWidget('CActiveForm', array(
        //'action'=>Yii::app()->createUrl($this->route),
        'method'=>'post',
    )); ?>
    <?php echo CHtml::textField('search', $model->search); ?>
    <?php echo CHtml::submitButton(''); ?>
    <?php $this->endWidget(); ?>
    </div>

</div>

<?php $this->widget('AdminGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$model->search($scope),
    'rowCssClassExpression'=>'$data->status == 0 ? "unpublished" : "published"',
    'rowDataLinkExpression'=>'"/admin/page/" . $data->id',
    'columns'=>array(
        array(
            'name'=>'date', 
            'htmlOptions'=>array('class'=>'date'),
        ),
        array(
            'name'=>'title',
            'htmlOptions'=>array('class'=>'title')
        ),
        array(
            'name'=>'page_type.name',
            //'value'=>'$data->page_type->name',
        ),
        array(
            'name'=>'slug',
            'htmlOptions'=>array('class'=>'gray'), 
            'type'=>'raw', 
            'value'=>'CHtml::link(Yii::app()->request->getServerName()."/".$data->slug, "http://".Yii::app()->request->getServerName()."/".$data->slug, array("target"=>"_blank"))',
        ),
        array(
            'name'=>'status',
            'htmlOptions'=>array('class'=>'status'), 
            'type'=>'html', 
            'value'=>array($this,'getStatus'),
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
