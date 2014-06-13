<?php

class DashboardController extends AdminController
{

    public $name = 'Dashboard';
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
                'actions'=>array('index', 'error'),
                'expression'=>'Yii::app()->user->isLoggedIn()',
            ), 
            array('deny'),    
        );
    }

    public function actionIndex()
    {

        $this->render('index', array(
            'content'       => Page::model()->search(6)->getData(),
            'content_count' => array(
                'all'         => Page::model()->count(),
                'published'   => Page::model()->published()->count(),
                'unpublished' => Page::model()->unpublished()->count()
            ),
            'message_count' => array(
                'inbox'  => Message::model()->all()->count(),
                'unread' => Message::model()->unread()->count(),
                'read'   => Message::model()->read()->count()
            )
        ));
    }
    
    public function actionError()
    {
        if($error = Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
}
