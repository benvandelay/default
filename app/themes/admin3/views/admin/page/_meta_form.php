<?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'meta-form',
        'enableAjaxValidation'=>true,
        'action'=>$model->isNewRecord ? '/admin/page/create/' : '/admin/page/' . $model->id,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnChange' => true,
        ),
        'htmlOptions' => array(
            'class' => 'user-form',
        ),
    ));
?>

    

    <div class="left-col">
        
        <?php echo $form->errorSummary($model); ?>

        <h2>Page Labels</h2>

        <div class="input text">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50)); ?>
        </div>
        <?php echo $form->error($model,'title'); ?>
        
        
        <div class="input">
            <?php echo $form->labelEx($model,'slug'); ?>
            <?php //echo Yii::app()->request->getServerName(); ?>
            <?php echo $form->textField($model,'slug',array('rows'=>6, 'cols'=>50)); ?>
        </div>
        <?php echo $form->error($model,'slug'); ?>
        
    </div> 
    
    <div class="right-col">
        <?php if(!$model->isNewRecord): ?>
	        <div class="status<?php echo $model->status != 0 ? ' published' : ''; ?>">
	            <?php echo $form->hiddenField($model,'status'); ?>

	            <span class="label">Published</span>
	            <div class="toggle-btn">
	                <div class="inner">
	                    <span class="on">on</span>
	                    <span class="handle"></span>
	                    <span class="off">off</span>
	                </div>
	            </div>
	        </div>
	    <?php endif; ?>
        <div class="categories">     
            <h2>Categorize</h2>
            
            <div class="inner">
                <div class="category-list">
                    <?php
                        echo CHtml::activeCheckBoxList(
                        $model,
                        'categoryIds',
                        Chtml::listData(Category::model()->findAll(),'id','name'),
                        array('template'=>'<div class="check-list-item">{input} {label}</div>', 'separator'=>false)
                        );
                    ?>
                </div>
                
                <div id="new-category-wrap"></div>
            </div>

                <a href="#" id="new-category" class="new-category icon icon-plus"></a>

        </div>
        
    </div>
    
    <div class="clb"></div>

	<div class="row buttons">
    
    	<div class="save-wrap">
	        <?php echo CHtml::link('Cancel', array('admin/page'), array('class'=>'btn cancel')); ?>
	        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn save')); ?>
	    </div>
	    <div class="clear"></div>
	</div>
    
<?php $this->endWidget(); ?>