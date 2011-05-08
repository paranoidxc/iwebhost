<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return $env_config = array(  

  'homeUrl' =>array('f/index'),
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'iWebhost version 0.3 beta',
	'theme'=>'classic',
	'defaultController' => 'f',
	'timeZone'=>"Asia/Shanghai",
	// preloading 'log' component
	'preload'=>array('log'),
	
  'components'=>array(
    'urlManager'=>array(
			//'urlFormat'     =>'path',
			//'showScriptName'=>false,
			//'urlSuffix'     =>'.html',
			'rules'=>array(
			  'ilogin' => 'site/login',
			  'blog' => 'blog/index',
			  'api' => 'blog/api',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

	  'errorHandler'=>array(
      'errorAction'=>'s/error',
    ),
  ),
);
