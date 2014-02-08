<?php
class CropImage
{
    
    public function process($file, $width, $height, $newFilename){
        $this->load($file);
        if($width/$height > $this->getWidth()/$this->getHeight()){
            $this->resizeToWidth($width);
            $new_height = $this->getHeight();
            $y = ($new_height - $height)/2;
            $this->crop($width,$height,0, $y);
        }else{
            $this->resizeToHeight($height);
            $new_width = $this->getWidth();
            $x = ($new_width - $width)/2;
            $this->crop($width,$height,$x, 0);
        }
        
        $this->save($newFilename);
    }
     // public function process($file, $width, $height, $newFilename){
        // $img = new Imagick($file);
        // $img->cropThumbnailImage($width, $height);
        // file_put_contents($newFilename, $img);
    // }
    
    
   protected function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   protected function save($filename, $image_type=IMAGETYPE_JPEG, $compression=100, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   protected function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }   
   }
   protected function getWidth() {
      return imagesx($this->image);
   }
   protected function getHeight() {
      return imagesy($this->image);
   }
   
   protected function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   protected function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
      return round($height);
   }
   protected function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   protected function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;   
   }   
   protected function crop($width,$height,$x, $y) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, $x, $y, $width, $height, $width, $height);
      $this->image = $new_image;   
   }    
}
?>