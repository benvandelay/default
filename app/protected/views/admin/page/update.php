<div class="header">
    <h1><?php echo $this->title; ?></h1>
</div>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'page-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnChange' => true,
        ),
    )); ?>
    
    <div class="right-options">
        <?php if($model->page_type_id == 2): ?>
            <div class="widget">
                <h3>Article Categories</h3>
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
                <div class="buttons">
                    <?php echo CHtml::link('New Category', 'javascript:void(0);', array('class'=>'new-cateogry', 'id'=>'new-category')); ?>
                    <div class="clear"></div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if($model->page_type_id == 1): ?>
            <div class="widget">
                <h3>Parent Page</h3>
                <div class="inner">
                    <?php echo CHtml::activeDropDownList($model, 'parent_id', Chtml::listData(Page::model()->findAll('parent_id=0'),'id','title')); ?>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if($imageDataProvider): ?>
            <div class="widget gallery-images">
                <h3>Gallery Images</h3>
                    <?php $this->widget('GalleryImageList', array('dataProvider'=>$imageDataProvider, 'model'=>$model));?>  
            </div>
        <?php endif; ?>
    </div>
    
    
    
    <div class="content-form">
        <?php echo $this->renderPartial('_form', array('model'=>$model, 'form'=>$form)); ?>
    </div>
    <div class="clear"></div>
    <div class="row buttons">
        <div class="status warning">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->radioButtonList($model,'status', array('0'=>'not published', '1'=>'published'), array('separator'=>false)); ?>
        </div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn')); ?>
        <?php echo CHtml::link('Cancel', array('all'), array('class'=>'btn')); ?>
    </div>  
    
<?php $this->endWidget(); ?>
</div><!-- form -->
