<div class="header">
    <h1><?php echo $this->title; ?></h1>
</div>

<div class="contact-message">
    <div class="head">
        <h2>Message From <?php echo $model->name; ?></h2>
        <div class="date">
            <?php echo $model->date; ?>
        </div>
    </div>
    <div class="subhead">
        <a href="mailto:<?php echo $model->email; ?>"><?php echo $model->email; ?></a>  
        <?php echo $model->phone ? '| '.$model->phone : '' ; ?>
    </div>
    <p><?php echo $model->body; ?></p>
</div>