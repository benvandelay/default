<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Default Site',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
		'application.widgets.admin.*',
		'application.widgets.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'default',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'AdminUser',
			'loginUrl'=>array('login'),
		),
		

        'assetManager' => array(
            'linkAssets' => true,
        ),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
		    'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'/admin/<controller:\w+>/<id:\d+>'=>'admin/<controller>/update',
				'/admin/page/create'=>'admin/page/create',
				'/admin/image/uploadify'=>'admin/image/uploadify',
				'/admin/<controller:\w+>/create'=>'admin/<controller>/create',
				'/admin/<controller:\w+>/<scope:\w+>'=>'admin/<controller>/index',
				'/admin/image/create/<page_id:\d+>'=>'admin/image/create',
				'/admin'=>'admin/site/index',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'/login'=>'admin/user/login',
				'/logout'=>'admin/user/logout',
				'/<slug>'=>'site/page',
				
			),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=default',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'adminEmail'=>'admin@admin.com',
		'image'=>array(
            'uploadPath'=>'/images/uploads',
            //keep these landscape!!!
            'size'=>array(
                'large'=>array('width'=>800, 'height'=>600),
                'thumb' =>array('width'=>200, 'height'=>160),
            ),
        ),
        'GAVerify'=>'',
	),
);