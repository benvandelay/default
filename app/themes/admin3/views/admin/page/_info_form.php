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

    <div class="input text">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>
    
    
    
    <div class="input">
        <?php echo $form->labelEx($model,'slug'); ?>
        <?php //echo Yii::app()->request->getServerName(); ?>
        <?php echo $form->textField($model,'slug'); ?>
        <?php echo $form->error($model,'slug'); ?>
    </div>
    
    
    <div class="input">
        <?php echo $form->labelEx($model,'excerpt'); ?>
        <?php echo $form->textArea($model,'excerpt',array('rows'=>6)); ?>
        <?php echo $form->error($model,'excerpt'); ?>
    </div>
    
    <?php 

        $dateClass = 'other';
        
        if(StringHelper::displayDate($model->display_date) == StringHelper::displayDate($model->modified)){
            $dateClass = 'modified';
        } 
        
        if(StringHelper::displayDate($model->display_date) == StringHelper::displayDate($model->date)){
            $dateClass = 'created';
        } 
    ?>
    
    <div class="dates">
        
        <h3>Display Date</h3>
        
        <div class="date<?php echo $dateClass == 'created' ? ' active' : ''; ?>" data-date-type="created" data-value="<?php echo $model->date; ?>">
            <div class="label">Created Date</div>
            <span><?php echo StringHelper::displayDate($model->date); ?></span>
        </div>
        
        <div class="date<?php echo $dateClass == 'modified' ? ' active' : ''; ?>" data-date-type="modified" data-value="<?php echo $model->modified; ?>">
            <div class="label">Modified Date</div>
            <span><?php echo StringHelper::displayDate($model->modified); ?></span>
        </div>
        
        <div class="date other<?php echo $dateClass == 'other' ? ' active' : ''; ?>" data-date-type="other">
            
            <label for="display_date">Other</label>
            <input type="text" name="display_date" id="display_date" value="<?php echo $dateClass == 'other' ? StringHelper::displayDate($model->display_date) : 'Select A Date'; ?>" />
            
            <?php echo $form->hiddenField($model,'display_date'); ?>
        </div>
        <div class="clb"></div>
    </div>
    
</div> 
    
<div class="right-col">

    <div class="list-image-wrap<?php echo !$model->image ? ' empty-image' : ''?>">
        <input type="file" id="uploadify_list" />
        <?php echo $model->image ? ImageHelper::resize($model->image->filename, 'admin_user') : ''; ?>
        <?php echo $form->hiddenField($model,'image_id'); ?>
    </div>
    
    <div class="categories">     
        <h2>Categorize</h2>
        
        <div class="inner">
            <ul class="category-list" id="category-list">
                <?php foreach(Chtml::listData($model->categories,'id','name') as $id => $name): ?>
                    <li><?php echo $name; ?></li>    
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="options">
            
        </div>
    </div>
    
</div>

<div class="clb"></div>



<div class="info-buttons">
    <?php echo CHtml::submitButton('Save', array('class'=>'btn save')); ?>
    <?php echo CHtml::link('Cancel', array('admin/page'), array('class'=>'btn cancel')); ?>
</div>

<?php $this->endWidget(); ?>