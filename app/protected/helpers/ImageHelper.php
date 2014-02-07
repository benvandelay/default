<?php
class ImageHelper {
    
    public static function resize($filename, $size, $path = false) {
        if($path){
            return Yii::app()->params['image']['uploadPath']."/".$size."_".$filename;
        }
        return CHtml::image(Yii::app()->params['image']['uploadPath']."/".$size."_".$filename);
    }
    
    public static function original($filename) {
        return CHtml::image(Yii::app()->params['image']['uploadPath']."/".$filename);
    }
    
    public static function filepath($filename) {
        return Yii::app()->params['image']['uploadPath']."/".$filename;
    }
}
?>