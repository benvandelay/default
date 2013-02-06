<div class="header">
    <h1><?php echo $this->title; ?></h1>
</div>

<div class="inner-content">
    
    <div class="dates">Created: <?php echo $model->date; ?></div>
    <ul class="update-nav"></ul>
    
    <div class="form">
        <div class="title-info">
            <h2>Message From <?php echo $model->name; ?></h2>
        </div>
        
        <div class="two-column-wrap">
            <a href="mailto:<?php echo $model->email; ?>"><?php echo $model->email; ?></a>  
            <?php echo $model->phone ? '| '.$model->phone : '' ; ?>
            <p><?php echo $model->body; ?></p>
        </div>
    </div>
    
</div>