<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'PHONE REPAIR',
	'sourceLanguage'=>'en',
    'language'=>'vi',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin'=>array(
            'defaultController' => 'site',
        ),
	),

	// application components
	'components'=>array(
        'assetManager' => array(
            'linkAssets' => true,
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'db'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=st24h_phonerpair',
			'emulatePrepare'=>true,
			'username'=>'st24h_phonerpair',
			'password'=>'brgMTAaK5g',
			'charset'=>'utf8',
            'tablePrefix'=>'',
		),
        'mail' => array(
            'class' => 'ext.yiimail.YiiMail',
             'transportType'=>'smtp',
             'transportOptions'=>array(
               'host'=>'smtp.gmail.com',
               'username'=>'kaka.mail.app@gmail.com',
               'password'=>'ccfqhrhgieqmkvvd',
               'port'=>'465',
               'encryption'=> 'ssl'
             ),
            'logging' => true,
            'dryRun' => false,
        ),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'authitem',
            'itemChildTable'=>'authitemchild',
            'assignmentTable'=>'authassignment',
        ),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                ''=>array('site/index','urlSuffix'=>'html'),
                array('api/checkDevices', 'pattern'=>'api/checkDevices', 'verb'=>'POST'),
                array('api/deviceDetail', 'pattern'=>'api/deviceDetail', 'verb'=>'POST'),
                array('api/pushMessageForAccount','pattern'=>'api/pushMessageForAccount', 'verb'=>'POST'),
                'pushMessageServer' => 'site/pushMessageServer',
                'guest/login' => 'site/loginGuest',
                'guest/logout' => 'site/logoutGuest',
                'about.html' => 'site/about',
                'devices.html' => 'site/listDevices',
                'device/<id:[a-zA-Z0-9\_\-.]+>' => 'site/listDevices',
                'prices-list.html' => 'site/listPrices',
                'contact.html' => 'site/contact',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<alias:[a-zA-Z0-9\_\-.]+>'=>'<controller>/index',
				'<module:\w+>'=>'<module>',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
			),
		),
        
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
        
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
        /*
        'cache'  => array(
            'class'=>'system.caching.CFileCache',
        ),
        */
	),
	'params'=>array(
        'adminEmail'=>'hson91@gmail.com',
        'gender'=>array(
            '1'=>'Nam',
            '2'=>'Nữ',
        ),
        'defaultPageSize'=>10,
        'users.roles'=>array(
            'admin'=>'Administrator',
            'manager'=>'Manager',
            'user'=>'Normal User',
        ),
        'status'=>array(
            '0'=>'Disabled',
            '1'=>'Enabled',
        ),
        'statusdevice' => array(
            '0'=>'Received',
            '1'=>'Repair in progress',
            '2'=>'Ready for collection',
        ),
        'colorStatusDevice' => array(
            '0'=> '#66706f',
            '1'=> '#ff0101',
            '2'=> '#59ac40',
        ),
        'recordsPerPage'=>array(
            '10'=>'20',
            '100'=>'100',
            '500'=>'500'
        ),
        'request'=>array(
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true,
        ),
        'target'=>array(
            '_self' => 'Mở tại trang hiện hành',
            '_blank' => 'Mở một trang mới'
        ),
		'adv_locations' => array(
			'1' => 'Bên trái trang web',
			'2' => 'Bên phải trang web',
		),
	),
);