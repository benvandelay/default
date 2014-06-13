<h1>Configuration</h1>

<div class="config-wrap">

    <form class="user-form" method="post">
        
        <?php foreach($fields as $field): ?>
            <div class="input">
            <?php echo CHtml::label($field->label, $field->name);  ?>  
            <?php echo CHtml::textField('Config[' . $field->id . ']', $field->value, array('id'=>$field->name));  ?>  
            </div>
        <?php endforeach; ?>
        
        <div class="buttons">
            <?php echo CHtml::submitButton('Save', array('class'=>'btn save')); ?>
            <div class="clb">
        </div>
    </form>

</div>