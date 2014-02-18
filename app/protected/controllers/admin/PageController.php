<?php

class PageController extends AdminController
{
    public $name = 'Site Content';
    
    
    public function menu()
    {
        return array(
            array('label'=>'<span class="icon icon-pencil"></span>  Create New', 'url' => array('admin/page/create')),
            array('label'=>'<span class="icon icon-search"></span>  Find Content', 'url' => array('admin/page/index')),  
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
                'actions'=>array('create','update','delete','index','GetArticlesJson'),
                'expression'=>'Yii::app()->user->isLoggedIn()',
            ),
            array('deny'),    
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Page;
        
        $this->performAjaxValidation($model);

        $this->savePage($model);
        
        $this->render('create',array(
            'model'=>$model
        ));

    }
    
    public function actionUpdate($id)
    {
        $this->title = 'Update Page';
        
        //get models
        $model   = $this->loadModel($id);
        $version = Version::model()->findByPk($model->version); 
        
        $this->performAjaxValidation($model);

        $this->savePage($model);

        $this->saveVersion($model);

        //get models again after save
        $model   = $this->loadModel($id);
        $version = Version::model()->findByPk($model->version);

        $this->render('update',array(
            'model'=>$model,
            'version'=> $version
        ));
    }
    
    private function saveVersion($model)
    {
        if(isset($_POST['Version']))
        {
            $version = new Version;
            $version->attributes = $_POST['Version'];
            $version->page_id = $model->id;
            
            if($version->save()){
                $model->version = $version->id;
                $model->categories = -1;
                if($model->save()){
                    Yii::app()->user->setFlash('success', "Page Updated!");
                }
            }
 
            else
                Yii::app()->user->setFlash('error', "Page Not Saved"); 
        }
    }
    
    private function savePage($model)
    {
        //submissions
        if(isset($_POST['Page']))
        {
            if(isset($_POST['Page']['new_category'])) 
            {
                foreach($_POST['Page']['new_category'] as $i=>$newCategory) 
                {
                    $category = new Category;
                    $category->name = $newCategory;
                    $category->save();
                    $_POST['Page']['categoryIds'][] = $category->id;
                }
            }

            $originalStatus = $model->status;
            
            $model->attributes = $_POST['Page'];

            $model->status = Yii::app()->user->isAdmin() ? $model->status : $originalStatus;

            if(isset($_POST['Page']['categoryIds'])){
                $model->categories=$_POST['Page']['categoryIds'];
            }else{
                $model->categories = -1;
            }
            
            //do new record stuff
            if($model->isNewRecord){
                if($model->save()){
                    $version = new Version;
                    $version->page_id = $model->id;
                    $version->header  = $model->title;
                    
                    if($version->save()){
                        $model->version = $version->id;
                        $model->save();
                        $this->redirect(array($model->id));
                    }
                }
            }
            
            if($model->save()){
                
                Yii::app()->user->setFlash('success', "Page Updated!");
            } 
            else
                Yii::app()->user->setFlash('error', "Page Not Saved"); 
            
        }
    }
    
    private function imageDataProvider($page_id)
    {
        $criteria=new CDbCriteria;

        $criteria->condition = 'page = '.$page_id;
        
        return new CActiveDataProvider('Image', array(
            'criteria'=>$criteria,
            'pagination'=>false,
        ));
    }
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->title = 'Delete Page';
        
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }


    public function actionIndex()
    {   
        $this->title = 'View Pages';

        $this->render('index');
    }
    
    public function actionGetArticlesJson()
    {
        
          
        header('Content-type: application/json');
         
        $model = new Page;
        $model->unsetAttributes();  // clear any default values

            $model->search = $_GET['term'];
            $model->page   = $_GET['page'];
        
        $results = array();
        
        foreach($model->search()->getData() as $i => $data){
            //print_r($data->version); exit;
            $results[$i]['title']  = $data->title;
            $results[$i]['body']   = StringHelper::getExcerpt($data->content->body);
            $results[$i]['image']  = $data->content->image ? ImageHelper::resize($data->content->image->filename, 'admin_thumb') : '<div class="blank"></div>';
            $results[$i]['url']    = $this->createUrl('update', array('id'=> $data->id));
            $results[$i]['date']   = StringHelper::displayDate($data->date);
            $results[$i]['author'] = $data->author->first_name . ' ' . $data->author->last_name;
            $results[$i]['status'] = $data->status ? ' active' : '';
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
        $model=Page::model()->with('content')->findByPk($id);
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

        if(isset($_POST['ajax']) && ($_POST['ajax']==='page-form' || $_POST['ajax']==='update-page-form' || $_POST['ajax']==='meta-form'))
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getCount(){
        return Page::model()->count();
    }
    

}
