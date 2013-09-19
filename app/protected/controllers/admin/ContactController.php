<?php

class ContactController extends AdminController
{

    public $name = 'Contacts';
    
    public static function menu()
    {
        return array(
            array('type'=>'raw', 'label'=>'<b>'.self::getCount('new').'</b>New', 'url'=>array('admin/contact/index', 'scope'=>'new')), 
            array('label'=>'<b>'.self::getCount(false).'</b>All', 'url'=>array('admin/contact/index', 'scope'=>'all')),   
            array('label'=>'<b>'.self::getCount('read').'</b>Read', 'url'=>array('admin/contact/index', 'scope'=>'read')),  
            array('label'=>'<b>'.self::getCount('deleted').'</b>Deleted', 'url'=>array('admin/contact/index', 'scope'=>'deleted')),
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
                'actions'=>array('index', 'view', 'update', 'delete'),
                'expression'=>'Yii::app()->user->isAdmin()',
            ), 
            array('deny'),    
        );
    }

  
    public function actionDelete($id)
    {
        $this->title = 'Delete Contact';
        
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            $model->status = 2;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }


    public function actionIndex($scope = false)
    {
        
        $this->title = 'View Contacts';
        
        if($scope == '') $this->redirect(array('/admin/contact/index', 'scope'=>'all'));
        if($scope == 'all') $scope = false;
        
        $model=new Contact;
        $model->unsetAttributes();  // clear any default values
        if(isset($_POST['search']))
            $model->search=$_POST['search'];

        $this->render('index',array(
            'model'=>$model,
            'scope'=>$scope,
        ));
    }
    
    public function actionUpdate($id)
    {
            $this->redirect(array('view', 'id'=>$id));
    }
    
    public function actionView($id)
    {
        $this->title = 'View Contact';
        
        $model=$this->loadModel($id);
        
        if($model->status == 0){
            $contact = $this->loadModal($id);
            $contact->status = 1;
            unset($contact->date);
            $contact->save();
        }

        $this->render('view',array(
            'model'=>$model,
        ));
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public static function getCount($scope){
        if($scope)
            return Contact::model()->$scope()->count();
        else
            return Contact::model()->count();
    }

}
