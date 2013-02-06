<?php

class ImageController extends AdminController
{
    public $name = 'Site Content';
    
    public function menu()
    {
        return array(
            array('label'=>'All Pages', 'url'=>array('admin/page/index', 'scope'=>'all')),  
            array('label'=>'Articles', 'url'=>array('admin/page/index', 'scope'=>'article')),  
            array('label'=>'Galleries', 'url'=>array('admin/page/index', 'scope'=>'gallery')),  
            array('label'=>'Contact Info', 'url'=>array('#')),
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
                'actions'=>array('create','update','delete','index'),
                'expression'=>'Yii::app()->user->isAdmin()',
            ),
            array('allow', 
                'actions'=>array('uploadify'),
                'users'=>array('*'),
            ), 
            array('deny'),    
        );
    }

    /**
     * Creates a new model.
     */
    public function actionCreate($page_id)
    {
        //if there is an id in the post array, update
        if($_POST['Image']['id'] != ''){
            //print_r($_POST['Image']); exit;
            return $this->updateImage($_POST['Image']['id']);
        } 
        
        $page = Page::model()->findByPk($page_id);

        if(!$page) throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        
        $this->title = 'Create Image';
        
        $model=new Image;

        $this->performAjaxValidation($model);
        
        $model->page = $page_id;
        
        if(isset($_POST['Image']))
        {
            $model->attributes=$_POST['Image'];
            
            if($model->save()){
                Yii::app()->user->setFlash('success', "Image Created!");
                $this->redirect(array('/admin/page/'.$page_id.'#images'));
            }
        }
        
       
        
        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
  
    
    public function updateImage($id)
    {
        
        $model=$this->loadModel($id);
        
        if($model->filename != $_POST['Image']['filename']) $model->doCrop = true;
        
        $model->attributes=$_POST['Image'];

        if($model->save()){
            Yii::app()->user->setFlash('success', "Image Updated!");
            $this->redirect(array('/admin/page/'.$model->page.'#images'));
        }else{
            echo 'did not save'; exit;
        }
        

    }
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->title = 'Delete Image';
        
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
        
        $this->title = 'View Images';
        
        $model=new Image;
        $model->unsetAttributes();  // clear any default values
        if(isset($_POST['search']))
            $model->search=$_POST['search'];

        $this->render('index',array(
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
        $model=Image::model()->findByPk($id);
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
        
        if(isset($_POST['ajax']) && $_POST['ajax']==='image-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionUploadify(){
        // Define a destination TODO make an app param out of this
        $targetFolder = Yii::app()->params['image']['uploadPath']; // Relative to the root
        $minWidth     = Yii::app()->params['image']['size']['large']['width'];
        $minHeight    = Yii::app()->params['image']['size']['large']['height'];
        $maxSize      = 4; //in mb
        $error        = array();
        
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];

            $size   = getimagesize($tempFile);
            $width  = $size[0];
            $height = $size[1];

            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            
            $fileParts = explode('.', $_FILES['Filedata']['name']);
            
            $newName = date("YmdHis") . preg_replace('/[^a-z0-9]+/i', '_', $fileParts[0]) . '.' . $fileParts[1];
            $targetFile = rtrim($targetPath,'/') . '/' . $newName;
            
            // Validate the file type
            $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            
            if (!in_array($fileParts['extension'],$fileTypes)) {
               $error[] = 'Invalid file type.';
            }elseif($width < $minWidth) {
                $error[] = 'File must be at least ' . $minWidth . 'px wide';
            }elseif($height < $minHeight) {
                $error[] = 'File must be at least ' . $minHeight . 'px in height';
            }elseif($_FILES['Filedata']['size'] > $maxSize * 1048576){
                array_push($this->error,  'File must be '.$this->max_size.'Mb or less!');
            }else{
               move_uploaded_file($tempFile,$targetFile);
            }
            
            if(empty($error)){//no upload error
                $json = array(
                    'error'=>0,
                    'filename'=>$newName,
                    'filepath'=>$targetFolder . '/' . $newName,
                );
            }else{
                $json = array(
                    'error'=>$error,
                );
            }
            
            //send message
            echo json_encode($json);
        }

    }

}
