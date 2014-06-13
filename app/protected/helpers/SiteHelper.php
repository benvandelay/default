<?php
class SiteHelper {
    
    
    public static function getParam($key) {
        return isset(Yii::app()->params[$key]) ? Yii::app()->params[$key] : Yii::app()->customParams->$key;
    }
    
  
}
?>