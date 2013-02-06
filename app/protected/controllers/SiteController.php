<?php

class SiteController extends Controller
{

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
				'width'=>'100'
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
		$contactModel=new Contact;
		if(isset($_POST['Contact']))
		{
			$contactModel->attributes=$_POST['Contact'];
			if($contactModel->validate())
			{
			    $contactModel->save();
				$this->sendContactEmail($contactModel);
				$this->refresh();
			}
		}
		$this->render('contact',
		  array(
		      'contactModel'=>$contactModel,
          )
        );
	}
    
    
    
     /**
     * Displays the prints page
     */
    public function actionPage($slug)
    {
        
        //if the action exists, use it
        if ($slug == 'contact') 
            return $this->actionContact();
        
        $model = $this->loadModelBySlug($slug); 
        
        Yii::app()->clientScript->registerMetaTag('', 'description');
        Yii::app()->clientScript->registerMetaTag('', 'keywords');
        
        $this->pageTitle=Yii::app()->name . ' | ' . $model->title;
        
        $this->render($model->page_type->name, 
            array(
                'model'=>$model,
            )
        );
  
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
        $headers .= 'Bcc: benvandelay@gmail.com' . "\r\n";
        
        $emailBody = $model->name . "\r\n";
        $emailBody.= $model->phone!='' ? $model->phone . "\r\n\r\n" : "\r\n\r\n";
        $emailBody.= $model->body;
        
        mail(Yii::app()->params['adminEmail'], Yii::app()->name.' message from ' . $model->name, $emailBody, $headers);
        Yii::app()->user->setFlash('contact','<b>Thanks!</b> We will get back to you shortly.');
    }
	
}