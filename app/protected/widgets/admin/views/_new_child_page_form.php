<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'child-page-form',
    'enableAjaxValidation'=>true,
    'action'=>'/admin/page/create',
    'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
)); ?>

    <?php echo $form->hiddenField($model,'page_type_id', array('value'=>1)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="input text">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
    </div>
    <?php echo $form->error($model,'title'); ?>
    
    <div class="select">
        <label>Parent Page</label><br /><?php echo CHtml::activeDropDownList($model, 'parent_id', Chtml::listData(Page::model()->findAll('parent_id=0'),'id','title')); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Create Page', array('class'=>'btn create')); ?>
    </div>

<?php $this->endWidget(); ?>