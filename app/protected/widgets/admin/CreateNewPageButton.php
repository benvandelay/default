<?php

class CreateNewPageButton extends CWidget{
    
    //public $dataProvider;
    
    public function init(){
        parent::init();  
        //$this->dataProvider = new CActiveDataProvider('PageType');
    }

    public function run(){
        $this->render('CreateNewPageButton');

    }
}
