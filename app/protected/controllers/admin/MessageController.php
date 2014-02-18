<?php

class MessageController extends AdminController
{

    public $name = 'Messages';
    
    public function menu()
    {
        return array(
            array('itemOptions' => array('class'=>'message-filter active', 'data-status-name' => 'all'), 'label'=>'<span>'.$this->getCount('all').'</span>Inbox', 'url' => ""), 
            array('itemOptions' => array('class'=>'message-filter', 'data-status-name' => 'unread'), 'type'=>'raw', 'label'=>'<span>'.$this->getCount('unread').'</span>New', 'url' => ""),   
            array('itemOptions' => array('class'=>'message-filter', 'data-status-name' => 'read'), 'label'=>'<span>'.$this->getCount('read').'</span>Read', 'url' => ""),  
            array('itemOptions' => array('class'=>'message-filter', 'data-status-name' => 'deleted'), 'label'=>'<span>'.$this->getCount('deleted').'</span>Deleted', 'url' => ""),
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
                'actions'=>array('index', 'view', 'update', 'delete', 'getMessagesJson', 'updateStatus'),
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


    public function actionIndex()
    {

        $this->render('index');
    }

    public function actionUpdateStatus() {
        header('Content-type: application/json');

            $model = $this->loadModel($_GET['mid']);
            $model->status = $_GET['status'];
            
            echo $model->save() ? CJSON::encode(1) : 0;
            
            Yii::app()->end();
    }
    
    public function actionGetMessagesJson($scope = false)
    {
 
        header('Content-type: application/json');
         
        $model = new Message;
        $model->unsetAttributes();  // clear any default values

            $model->search = $_GET['term'];
            $model->page   = $_GET['page'];
        
        $results = array();
        
        foreach($model->search($scope)->getData() as $i => $data){
            $results[$i]['id']       = $data->id;
            $results[$i]['name']     = $data->name;
            $results[$i]['email']    = $data->email;
            $results[$i]['phone']    = $data->phone;
            $results[$i]['status_id']= $data->status;
            $results[$i]['status']   = StringHelper::getMessageStatus($data->status);
            $results[$i]['date']     = StringHelper::displayDate($data->date);
            $results[$i]['time']     = StringHelper::displayTime($data->date);
            $results[$i]['excerpt']  = StringHelper::getExcerpt($data->body, 60) . '...';
            $results[$i]['body']     = $data->body;
        }
        
        echo CJSON::encode($results);
        
        Yii::app()->end();
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
