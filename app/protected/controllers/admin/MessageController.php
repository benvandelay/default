<?php

class MessageController extends AdminController
{

    public $name = 'Messages';
    
    public function menu()
    {
        return array(
            array('type'=>'raw', 'label'=>'<b>'.$this->getCount('new').'</b>New', 'url'=>array('admin/message/index', 'scope'=>'new')), 
            array('label'=>'<b>'.$this->getCount(false).'</b>All', 'url'=>array('admin/message/index', 'scope'=>'all')),   
            array('label'=>'<b>'.$this->getCount('read').'</b>Read', 'url'=>array('admin/message/index', 'scope'=>'read')),  
            array('label'=>'<b>'.$this->getCount('deleted').'</b>Deleted', 'url'=>array('admin/message/index', 'scope'=>'deleted')),
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
        $this->title = 'Delete message';
        
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
        
        $this->title = 'View messages';
        
        if($scope == '') $this->redirect(array('/admin/message/index', 'scope'=>'all'));
        if($scope == 'all') $scope = false;
        
        $model=new Message;
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
        $this->title = 'View message';
        
        $model=$this->loadModel($id);
        
        if($model->status == 0){
            $message = $this->loadModal($id);
            $message->status = 1;
            unset($message->date);
            $message->save();
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
        $model=Message::model()->findByPk($id);
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
    
    public function getCount($scope){
        if($scope)
            return Message::model()->$scope()->count();
        else
            return Message::model()->count();
    }

}
