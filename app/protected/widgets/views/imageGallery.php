<h2>Recent Prints</h2>               
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_gallery_image',
    ));
    ?>
