<?php
class StringHelper {
    
    function toAscii($str) {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    
        return $clean;
    }
    
    public function displayDate($date) {
        return date('M d Y', strtotime($date));
    }
    
    public function getExcerpt($text = "", $length = 200, $allowedTags = FALSE) {
        $endChars = array(".","!","?");
        $ellipsis = true;
        $tags     = '';
        if($allowedTags) {
            $tags = '<b><strong><i><em><a><strike><br><span><p>';
        }
        
        //limit excerpt to specified size
        $text = trim(mb_substr($text, 0, $length, 'UTF-8')); //use multibyte func w/utf8 encodings (#2877)

        if(mb_strlen($text) < $length) $ellipsis = false; //kill '...' if short enough

        //format text by replacing quotes and stripping tags
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        $text = str_replace('&nbsp;','', strip_tags($text, $tags));
        

        return $text;
    }
}
?>