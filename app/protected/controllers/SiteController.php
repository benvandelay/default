<?php

class SiteController extends Controller
{

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
            array('deny',
                'actions'=>array('preview'),
                'users'=>array('?'),
            ),
        );
    }


	public function actionIndex()
	{
        Yii::app()->clientScript->registerMetaTag(Yii::app()->params['GAVerify'], 'google-site-verification');
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{   
		$model = new Message;
		if(isset($_POST['Message']))
		{
		    if(isset($_POST['pen15']) && $_POST['pen15'] == 'pass'){//ghetto spam blocker
		        $model->attributes=$_POST['Message'];
                if($model->validate())
                {
                    $model->save();
                    $this->sendContactEmail($model);
                    $this->refresh();
                }
		    }
			
		}
		$this->render('contact',
		  array(
		      'model'=>$model,
          )
        );
	}
    
    
    
     /**
     * Displays any page
     */
    public function actionPage($slug)
    {
        
        //if the action exists, use it
        if ($slug == 'contact') 
            return $this->actionContact();
        
        $model = $this->loadModelBySlug($slug);
        
        if($this->layout){ //pjax request?
            Yii::app()->clientScript->registerMetaTag($model->excerpt, 'description');
            Yii::app()->clientScript->registerMetaTag('', 'keywords');
        }
        
        
        $this->pageTitle=Yii::app()->name . ' | ' . $model->title;
        
        $this->render('article', 
            array(
                'model'=>$model,
            )
        );
  
    }
    
    /**
     * Displays a preview before page is published
     */
    public function actionPreview($id, $version_id)
    {
        $model   = $this->loadModel($id);
        $version = Version::model()->findByPk($version_id);
        
        $this->pageTitle = Yii::app()->name . ' | ' . $model->title;
        
        $this->render('preview', 
            array(
                'model'=>$model,
                'version'=>$version,
            )
        );
  
    }
    
    public function actionGetArticlesJson()
    {
        
          
        header('Content-type: application/json');
         
        $model = new Page;
        $model->unsetAttributes();  // clear any default values

            $model->search      = $_GET['term'];
            $model->page        = $_GET['page'];
            $model->categoryIds = !empty($_GET['categories']) ? $_GET['categories'] : false;

        
        $results = array();
        
        foreach($model->frontEndSearch(5)->getData() as $i => $data){
            echo '<pre>';print_r($data); exit;
            $results[$i]['id']         = $data->id;
            $results[$i]['title']      = $data->title;
            $results[$i]['body']       = $data->excerpt != '' ? $data->excerpt : StringHelper::getExcerpt($data->published_content->body);
            $results[$i]['image']      = $data->published_content->image ? ImageHelper::resize($data->published_content->image->filename, 'admin_user') : '<div class="blank"></div>';
            $results[$i]['img_class']  = $data->published_content->image ? 'has-image' : 'no-image';
            $results[$i]['url']        = $this->createUrl('page', array('slug'=> $data->slug));
            $results[$i]['date']       = StringHelper::displayDate($data->date);
            $results[$i]['author']     = $data->author->first_name . ' ' . $data->author->last_name;
            $results[$i]['categories'] = StringHelper::formatCategories($data->categories);
        }
        
        echo CJSON::encode($results);
        
        Yii::app()->end();
    }
    
    public function loadModel($id)
    {
        $model=Page::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    public function loadModelBySlug($slug)
    {
        $model=Page::model()->findByAttributes(array('slug'=>$slug));
        
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    private function sendContactEmail($model)
    {
        $headers="From: {$model->email}\r\nReply-To: {$model->email}\r\n";
        //$headers .= 'Bcc: benvandelay@gmail.com' . "\r\n"; //for client work only
        
        $emailBody = $model->name . "\r\n";
        $emailBody.= $model->phone!='' ? $model->phone . "\r\n\r\n" : "\r\n\r\n";
        $emailBody.= $model->body;
        
        mail(SiteHelper::getParam('admin_email'), SiteHelper::getParam('title').' web message from ' . $model->name, $emailBody, $headers);
        Yii::app()->user->setFlash('contact','<b>Thanks!</b> I will get back to you shortly.');
    }
	
    
}