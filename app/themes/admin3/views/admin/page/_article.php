<a href="<?php echo $this->createUrl('update', array('id'=> $data->id)); ?>" class="article">
    <img src="http://www.placekitten.com/40/40" />
    <div class="title"><?php echo $data->title; ?></div>
    <div class="byline"><?php echo $data->date; ?> | <?php echo $data->author->first_name; ?> <?php echo $data->author->last_name; ?></div>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
    
    <ul class="info">
        <li class="status<?php echo $data->status ? ' active' : ''; ?>"><span class="icon icon-checkmark"></span> Published</li>
        <li class="nav-item"><span class="icon icon-menu"></span> Nav</li>
    </ul>
    
</a>