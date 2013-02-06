<?php

class GalleryImageList extends CWidget{
    
    public $dataProvider;
    public $model;
    
    public function init(){
        parent::init();  
    }

    public function run(){
        $this->render('GalleryImageList', array(
            'dataProvider'=>$this->dataProvider,
            'model'=>$this->model,
        ));

    }
}
