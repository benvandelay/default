<?php

class RecentArticles extends CWidget{
    
    public $dataProvider;
    
    public function init(){
        parent::init(); 
        
        $criteria = new CDbCriteria;
        $criteria->limit = 6;
        $criteria->order = 'date DESC';
        $criteria->addCondition('status = 1');
        $criteria->addCondition('page_type_id = 2');
        
        $this->dataProvider = new CActiveDataProvider('Page', array(
            
            'criteria'=>$criteria,
            'pagination'=>false,

        ));
        
    }

    
    public function run(){
        $this->render('recentArticles', array('dataProvider'=>$this->dataProvider));

    }
}
