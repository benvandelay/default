<?php
class SiteHelper {
    
    
    public static function getParam($key) {
        return isset(Yii::app()->params[$key]) ? Yii::app()->params[$key] : (Yii::app()->customParams->$key !="" ? Yii::app()->customParams->$key : false);
    }
    
    public static function setUpLazyload($html){
        
        $search  = '<img src';
        $replace = '<img data-original';
        
        $newHtml = str_replace($search, $replace, $html);
        
        return $newHtml;
    }
    
  
}
?>