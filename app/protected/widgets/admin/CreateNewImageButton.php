<?php

class CreateNewImageButton extends CWidget{
    
    public $model;
    
    public function init(){
        parent::init();  
        $this->model = new Image;
    }

    public function run(){
        $this->render('CreateNewImageButton', array('model'=>$this->model));

    }
}
