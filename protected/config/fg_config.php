<?php
  return $sep_config_ar = array(  
 	  'theme'=>'forum',	
    
    'components'=>array(
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
        '/'                 => 'f/index',

        'topic/<id:\d+>'        =>'t/index',
				'topic/create'          =>'t/create',
        'topic/<id:\w+>'         =>'t/index',
				//'topic/create/<id:\d+>' =>'t/create',

        'you'                   => 'm/you',
        'member'                => 'm/list',
        'member/<id:\d+>'       =>'m/index',
        'member/<id:\w+>'       =>'m/index',

				'<controller:\w+>/<id:\d+>'=>'<controller>/index',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			  ),
		  ),
    )

  );
?>
