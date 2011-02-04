<?php
/*
时常走访大自然是解除城市生活中罪恶的必要良方。 

如果生活的要义在于追求幸福，那么，除却旅行，很少有别的行为能呈现这一追求过程中的热情和矛盾。
不论是多么的不明晰，旅行仍能表达出紧张工作和辛苦谋生之外的另一种生活意义。

人类不快乐的唯一原因是他不知道如何安静地呆在他的房间里。  
 abcdefg hijklmn opq rst uvw xyz
 ABCDEFG HIJKLMN OPQ RST UVW XYZ
 `1234567890-=[]
 ~!@#$%^&*()_+{}
 */

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'iWebhost version 0.3 beta',
	'theme'=>'classic',
	'defaultController' => 'istart',
	'timeZone'=>"Asia/Shanghai",
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',		
		'application.components.*',
		'ext.yiiext.behaviors.model.taggable.*',
		'application.extensions.*',
		'application.modules.admin.models.*',	
		'application.helpers.*',	
	),

	'modules'=>array(
        'admin',
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'xiaochuan',
        ),
    ),
    	
	'language'	=> 'zh-cn',
	// application components
	'components'=>array(
	  'errorHandler'=>array(
      'errorAction'=>'site/error',
    ),
        
	  'image'=>array(
      'class'=>'application.extensions.image.CImageComponent',            
      'driver'=>'GD',
      ),
        
		'coreMessages'	=> array( 
			'basePath' => 'protected/messages' 
		 ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
		//	'urlFormat'=>'path',				
			'rules'=>array(
			  'ilogin' => 'site/login',
			  'blog' => 'blog/index',
			  'api' => 'blog/api',
		//		'<controller:\w+>/<id:\d+>'=>'<controller>/view',
		//		'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
		//		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
    /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
     */
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=parano2_iwebhost',
			//'connectionString' => 'mysql:host=localhost;dbname=huangxc_iwebhost',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),

    // 
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
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
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
