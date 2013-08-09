<div class="header">
    <h1><?php echo $this->title; ?></h1>
    <a class="btn new" href="/admin/user/create"><span class="icon plus"></span>New User</a>
</div>

<div class="inner-content">
<div class="admin-header">
    <div class="search-wrap">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'post',
    )); ?>
    <?php echo CHtml::textField('search', ''); ?>
    <?php echo CHtml::submitButton(''); ?>
    <?php $this->endWidget(); ?>
    </div>
</div>

<?php $this->widget('AdminGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$model->search(),
    'rowDataLinkExpression'=>'"/admin/user/" . $data->id',
    'columns'=>array(
        array('name'=>'User', 'value'=>'$data->first_name . " " . $data->last_name'),
        array('name'=>'username', 'htmlOptions'=>array('class'=>'gray')),
        array('name'=>'email', 'htmlOptions'=>array('class'=>'gray')),
        'permission',
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
</div>