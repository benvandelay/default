<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

class AdminController extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//admin/layouts/main';
    public $title = 'Admin';
    
    public $name = '';
    
    public function init(){
        Yii::app()->theme = 'admin3';
        Yii::app()->errorHandler->errorAction='admin/dashboard/error';
        
        parent::init();
    }
    
    /**
     * return menu items
     */
    public function menu()
    {
        return array();
    }
    
    protected function getStatus($data, $row)
    {
       return $data->status == 1 ? "<span class=\"icon check\"></span>Published" : "Unpublished";
    }
    
    protected function getSlug($data, $row)
    {
       return CHtml::link(Yii::app()->request->getServerName()."/".$data->slug, "http://".Yii::app()->request->getServerName()."/".$data->slug, array("target"=>"_blank"));
    }
}