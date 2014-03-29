<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$db = array(
    'host' => isset($_SERVER['DB_HOST']) ? $_SERVER['DB_HOST'] : '127.0.0.1',
    'name' => isset($_SERVER['DB_NAME']) ? $_SERVER['DB_NAME'] : 'default',
    'user' => isset($_SERVER['DB_USER']) ? $_SERVER['DB_USER'] : 'root',
    'pass' => isset($_SERVER['DB_PASS']) ? $_SERVER['DB_PASS'] : 'root',
);

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Bens Website',

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
		
        'clientScript'=>array(
        
            'packages'=>array(
                'jquery'=>array(
                    'baseUrl'=>'/themes/admin3/js/',
                    'js' => array('jquery.js', 'jquery.migrate.js'),
                ),
                // 'jquery.ui'=>array(
                    // 'baseUrl'=>'/themes/admin3/js/',
                    // 'js' => array('jquery-ui-1.10.3.custom.min.js'),
                // )
            ),
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
				'/admin/page/getArticlesJson'=>'admin/page/getArticlesJson',
				'/admin/message/getMessagesJson/<scope:\w+>'=>'admin/message/getMessagesJson',
				'/admin/page/create'=>'admin/page/create',
				'/admin/image/uploadify'=>'admin/image/uploadify',
				'/admin/image/uploadify/<src:\w+>'=>'admin/image/uploadify',
				'/admin/<controller:\w+>/create'=>'admin/<controller>/create',
				'/admin/<controller:\w+>'=>'admin/<controller>/index',
				'/admin/image/create/<page_id:\d+>'=>'admin/image/create',
				'/admin'=>'admin/page/index',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'/login'=>'admin/user/login',
				'/logout'=>'admin/user/logout',
				'/<slug>'=>'site/page',
			),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=' . $db['host'] . ';dbname=' . $db['name'],
			'emulatePrepare' => true,
			'username' => $db['user'],
			'password' => $db['pass'],
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
                'admin_large' => array('width' => 758, 'height' => 345),
                'admin_thumb' => array('width' => 40,  'height' => 40),
                'admin_user'  => array('width' => 260, 'height' => 260),
            ),
        ),
        'GAVerify'=>'',
	),
);