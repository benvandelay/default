<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$db = array(
    'host' => getenv('DB_HOST') ? : '127.0.0.1',
    'name' => getenv('DB_NAME') ? : 'init',
    'user' => getenv('DB_USER') ? : 'root',
    'pass' => getenv('DB_PASS') ? : '',
);

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Website',

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
		
		// 'gii'=>array(
			// 'class'=>'system.gii.GiiModule',
			// 'password'=>'default',
		 	// // If removed, Gii defaults to localhost only. Edit carefully to taste.
			// 'ipFilters'=>array('127.0.0.1','::1'),
		// ),
		
	),

	// application components
	'components'=>array(
	    'customParams'=>array(
            'class' => 'application.extensions.dbparam.XDbParam',
            'connectionID' => 'db',//id of the connection component, just the same as with CDbCache
        //  'preload' => 'test,test2', //comma-separated string or array of params to be loaded anyway. Other params are loaded only when requested.
        //  'autoLoad' => true,//loads all attributes when initializing
        //  'caseSensitive' => true, //setting to true makes all parameters case sensitive
        ),
    
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
			    '/preview/<id:\d+>/<version_id:\d+>'=>'site/preview',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'/admin/page/<id:\d+>/<version_id:\d+>'=>'admin/page/update',
				'/admin/page/delete/<id:\d+>'=>'admin/page/delete',
				'/admin/<controller:\w+>/<id:\d+>'=>'admin/<controller>/update',
				'/admin/page/getArticlesJson'=>'admin/page/getArticlesJson',
				'/admin/page/setPublishedVersion'=>'admin/page/setPublishedVersion',
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
		'image'=>array(
            'uploadPath'=>'/images/uploads',
            //keep these landscape!!!
            'size'=>array(
                //admin sizes
                'admin_large' => array('width' => 758, 'height' => 345),
                'redactor_upload' => array('width' => 800, 'height' => false),
                'large' => array('width' => 800, 'height' => 400),
                'admin_thumb' => array('width' => 40,  'height' => 40),
                'admin_user'  => array('width' => 260, 'height' => 260),
            ),
        ),
        'GAVerify'=>'',
	),
);