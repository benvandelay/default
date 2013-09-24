<?php // search?>
<div class="search">
    
    <?php Yii::app()->clientScript->registerScript('search','admin.search()'); ?>   
        
    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'post',
        'htmlOptions'=>array('autocomplete' => 'off')
    )); ?>
    
    <span class="icon icon-search"></span>
    
    <?php echo CHtml::textField('search', $model->search, array('id'=>'search', 'placeholder'=>'Find an Article...')); ?>
    
    <?php $this->endWidget(); ?>
    
</div>

<?php // article list ?>

<?php $this->widget('zii.widgets.CListView', array(
    'id'=>'article-list',
    'dataProvider'=>$model->search(),
    'itemView' => '_article',
    'itemsCssClass' => 'articles',
    'beforeAjaxUpdate' => 'admin.beforeArticlesUpdate()'
)); ?>

<?php //new page modal form ?>
<div class="modal-wrapper new-page">
    
    <h1>Create a New Page</h1>
    <div class="inner">
        
        <div id="child-page">
            <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'page-form',
    'enableAjaxValidation'=>true,
    'action'=>'/admin/page/create/',
    'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="input text">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
    </div>
    <?php echo $form->error($model,'title'); ?>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Begin Editing', array('class'=>'btn create')); ?>
    </div>

<?php $this->endWidget(); ?>
        </div>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="cancel">
         <a class="modal-close" href="#">Cancel</a>
         <div class="clear"></div>
    </div>
</div>