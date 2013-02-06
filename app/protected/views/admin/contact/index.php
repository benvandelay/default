<div class="header">
    <h1><?php echo $this->title; ?></h1>
</div>

<?php if($model->search()->itemCount != 0): ?>

<div class="search-wrap">
<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'post',
)); ?>
<?php echo CHtml::textField('search', ''); ?>
<?php echo CHtml::submitButton(''); ?>
<?php $this->endWidget(); ?>
</div>

<?php 

    $this->widget('AdminGridView', array(
        'id'=>'user-grid',
        'dataProvider'=>$model->search(),
        'rowDataLinkExpression'=>'"/admin/contact/" . $data->id',
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
<?php else: ?>
<p>You have no contacts.</p>
<?php endif; ?>