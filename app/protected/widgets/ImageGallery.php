<?php

class ImageGallery extends CWidget{
    
    public $dataProvider;
    
    public function init(){
        parent::init(); 
        
        $criteria = new CDbCriteria;
        $criteria->limit = 3;
        $criteria->order = 'id DESC';
        $criteria->addCondition('status = 1');
        
        $this->dataProvider = new CActiveDataProvider('Prints', array(
            
            'criteria'=>$criteria,
            'pagination'=>false,

        ));
        
    }

    
    public function run(){
        $this->render('imageGallery', array('dataProvider'=>$this->dataProvider));

    }
}
