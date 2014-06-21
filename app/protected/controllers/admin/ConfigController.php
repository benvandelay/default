<?php

class ConfigController extends AdminController
{
    
    public function menu()
    {
        return array(
            
        );
    } 
    
    /**
     * @return array action filters
     */
    
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(

            array('allow', 
                'actions'=>array('index'),
                'expression'=>'Yii::app()->user->isAdmin()',
            ), 
            array('deny'),    
        );
    }


    public function actionIndex()
    {
        
        if(isset($_POST['Config'])){
            
            foreach($_POST['Config'] as $id => $value){
                
                Config::model()->updateByPk($id,array('value'=>$value));
                
            }
            
        }
        
        $this->title = 'Config';
        
        $fields = Config::model()->findAll(array('order'=>"FIELD(type, 'info', 'social', 'google analytics')"));
        
        $this->render('index', array('fields'=> $fields));
    }
    

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='config-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
