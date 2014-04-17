<?php
class StringHelper {
    
    function toAscii($str) {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    
        return $clean;
    }
    
    public static function displayDate($date) {
        return date('M d Y', strtotime($date));
    }
    
    public static function displayTime($date) {
        return date('g:i a', strtotime($date));
    }
    
    public static function toTime($date) {
        return date('M d Y, g:i a', strtotime($date));
    }
    
    public static function getExcerpt($text = "", $length = 200, $allowedTags = FALSE) {
        $endChars = array(".","!","?");
        $ellipsis = true;
        $tags     = '';
        if($allowedTags) {
            $tags = '<b><strong><i><em><a><strike><br><span><p>';
        }
        
        //limit excerpt to specified size
        $text = trim(substr($text, 0, $length)); //use multibyte func w/utf8 encodings (#2877)

        if(strlen($text) < $length) $ellipsis = false; //kill '...' if short enough

        //format text by replacing quotes and stripping tags
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        $text = str_replace('&nbsp;','', strip_tags($text, $tags));
        

        return $text;
    }
    
    public static function getMessageStatus($id){
        $status = array(0 => 'unread', 1 => 'read', 2 => 'deleted');
        return $status[$id];
    }
    
    public static function formatCategories($array){
        $string = '';
        
        if(!empty($array)){
            
            $string .= '<span class="categories">';
            
            foreach($array as $key => $value){
                $string .= CHtml::link($value->name, '#');   
            }
            
            $string .= '</span>';
            
        }
        return $string;
    }
}
?>