<div class="header">
  
    <h1>Contacts</h1>

</div>

<div class="inner-content">
    <div class="admin-header">
        <div class="nav-wrap">
            <?php $this->widget('zii.widgets.CMenu', array('items'=>$this->menu(), 'activeCssClass'=>'active', 'encodeLabel'=>false )); ?>
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
    </div>



<?php //if($model->search($scope)->itemCount != 0): ?>
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
<?php //else: ?>
    

<?php //endif; ?>

</div>