<h1>Configuration</h1>

<div class="config-wrap">

    <form class="user-form" method="post">
        <?php $type = ''; ?>
        <?php foreach($fields as $field): ?>
            <?php 
                if($type != $field->type){
                    echo '<h3>' . ucwords($field->type) . '</h3>';
                    $type = $field->type;
                } 
            ?>
            <div class="input">
            <?php echo CHtml::label($field->label, $field->name);  ?>  
            
            <?php 
                if($field->name == 'site_description'){
                    echo CHtml::textArea('Config[' . $field->id . ']', $field->value, array('id'=>$field->name));
                }else{
                    echo CHtml::textField('Config[' . $field->id . ']', $field->value, array('id'=>$field->name));
                }
            ?> 
            </div>
        <?php endforeach; ?>
        
        <div class="buttons">
            <?php echo CHtml::submitButton('Save', array('class'=>'btn save')); ?>
            <div class="clb"></div>
        </div>
    </form>

</div>