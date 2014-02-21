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
                'expression'=>'Yii::app()->user->isLoggedIn()',
            ), 
            array('deny'),    
        );
    }


    public function actionIndex()
    {
        
        $this->title = 'Config';

        $this->render('index');
    }
    

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Contact::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
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
