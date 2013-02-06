<?php
class ImageHelper {
    
    function resize($filename, $size) {
        return CHtml::image(Yii::app()->params['image']['uploadPath']."/".$size."_".$filename);
    }
    
    function original($filename) {
        return CHtml::image(Yii::app()->params['image']['uploadPath']."/".$filename);
    }
    
    function filepath($filename) {
        return Yii::app()->params['image']['uploadPath']."/".$filename;
    }
}
?>