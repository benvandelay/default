
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_gallery_image',
        'summaryText'=>false
    ));
    ?>

