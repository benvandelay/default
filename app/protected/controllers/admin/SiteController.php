<?php

class SiteController extends AdminController
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
                'actions'=>array('index'),
                'expression'=>'Yii::app()->user->isAdmin()',
            ), 
            array('deny'),    
        );
    }

    public function actionIndex()
    {
        
        $this->title = 'DashBoard';

        $this->render('index');
    }
}
