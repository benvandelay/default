<?php

class SiteNav extends CWidget{
    
    public $dataProvider;
    
    public function init(){
        parent::init(); 
        
        $criteria = new CDbCriteria;
        $criteria->order = 'id ASC';
        $criteria->addCondition('page_type_id = 0');
        $criteria->addCondition('status = 1');
        $this->dataProvider = new CActiveDataProvider('Page', array(
            
            'criteria'=>$criteria,
            'pagination'=>false,

        ));
        
    }

    
    public function run(){
        $this->render('siteNav', array('dataProvider'=>$this->dataProvider));

    }
}
