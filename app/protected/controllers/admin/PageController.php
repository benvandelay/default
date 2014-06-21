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
                'actions'=>array('create','update','delete','index','GetArticlesJson', 'getCategories', 'setPublishedVersion'),
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
    
    public function actionGetCategories()
    {
        
        $categories = array();
        
        $exclude = explode(',', urldecode($_GET['exclude']));

        $limit = (3 + count($exclude));
        
        foreach(Category::model()->search($_GET['term'], $limit)->getData() as $i => $data) {
            $categories[] = $data->name;
        }
        
        $categories = array_splice(array_diff($categories, $exclude), 0, 3);

        echo json_encode(array_values($categories));
    }
    
    public function actionUpdate($id, $version_id = false)
    {
        $this->title = 'Update Page';
        
        //get model
        $model = $this->loadModel($id);
        
        $this->performAjaxValidation($model);

        $this->savePage($model);

        $this->saveVersion($model);

        //get new model data
        $model->refresh();
        
        //get the version requested here or the most recent version
        if(!$version_id){
            //get latest version
            $version_id = Version::model()->getLatestId($id);
        }
        
        $version = Version::model()->findByPk($version_id);
        
        //version requested doesnt exist
        if(!$version || $version->page_id != $id){
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        
        //get all versions
        $versions = Version::model()->getIds($id);

        $this->render('update',array(
            'model'      => $model,
            'version'    => $version,
            'versions'   => $versions,
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
                
                if(!$model->image_id && $version->image_id){
                    $model->image_id = $version->image_id;
                }
                
                $model->categories = -1;
                if($model->save()){
                    Yii::app()->user->setFlash('success', "Page Updated!");
                    $this->redirect(array($model->id));
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
            if(isset($_POST['Page']['categories'])) 
            {
                foreach($_POST['Page']['categories'] as $i=>$category) 
                {
                    //if it already exists
                    $existingCat = Category::model()->findByAttributes(array('name' => $category));
                    if($existingCat){
                        $_POST['Page']['categoryIds'][] = $existingCat->id;
                    }else{
                        //if it doesnt exist
                        $cmodel = new Category;
                        $cmodel->name = $category;
                        $cmodel->save();
                        $_POST['Page']['categoryIds'][] = $cmodel->id;
                    }
                }
            }

            //$originalStatus = $model->status;
            
            $model->attributes = $_POST['Page'];

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
            $results[$i]['image']  = $data->image ? ImageHelper::resize($data->image->filename, 'admin_thumb') : '<div class="blank"></div>';
            $results[$i]['url']    = $this->createUrl('update', array('id'=> $data->id));
            $results[$i]['date']   = StringHelper::displayDate($data->display_date);
            $results[$i]['author'] = $data->author->first_name . ' ' . $data->author->last_name;
            $results[$i]['status'] = $data->published_version ? ' active' : '';
        }
        
        echo CJSON::encode($results);
        
        Yii::app()->end();
    }

    public function actionSetPublishedVersion()
    {
        if(isset($_POST['model']) && isset($_POST['version'])){
            if($model = $this->loadModel($_POST['model'])){
                $model->published_version = $_POST['version'];
                $model->categories = -1;
                if($model->save()){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Page::model()->findByPk($id);
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
