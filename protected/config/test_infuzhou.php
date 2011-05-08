<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return $env_config = array(  

  'homeUrl' =>array('site/index'),
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'infuzhou beta',
	'theme'=>'forum',
	'defaultController' => 'f',
	'timeZone'=>"Asia/Shanghai",
	// preloading 'log' component
	'preload'=>array('log'),

	'components'=>array(
  	'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'    => array('s/signin'),
		), 
    'urlManager'=>array(
			'urlFormat'     =>'path',
			'showScriptName'=>false,
			'urlSuffix'     =>'.html',
			'rules'=>array(
			  'ilogin'      => 'site/login',
			  'blog'        => 'blog/index',
			  'api'         => 'blog/api',
        'signin'      => 's/signin',
        'signup'      => 's/signup',
        'signout'     => 's/signout',
        'forgot'      => 's/forgot',
        'settings'    => 'm/setting',

        'notifications'=> 'n/index',
        'notifications/<action:\w+>'=> 'n/<action>',

        'node/<id:\d+>'        => 'f/index',
        'node'                 => 'f/index',

        'topic/<id:\d+>'        =>'t/index',
				'topic/create/<id:\d+>' =>'t/create',
				'topic/create'          =>'t/create',

        'you'                   => 'm/you',
        'member'                => 'm/list',
        'member/<id:\d+>'       =>'m/index',
        'member/<id:\w+>'       =>'m/index',

				'<controller:\w+>/<id:\d+>'=>'<controller>/index',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'errorHandler'=>array(
            'errorAction'=>'s/error',
     ),


  ),


);
