<?php
//print_r($_SERVER);
error_reporting(E_ERROR|E_WARNING|E_PARSE);
//error_reporting(null);

// require user config about variables
require_once 'define.var.php';
require_once 'class.phpmailer.php';
include_once 'markdown.php';
// require the shortcut function file
require_once( dirname(__FILE__).'/protected/globals.php' );

// require front config
switch($_SERVER['HTTP_HOST']){
  case 'local.infuzhou.com':
  case 'www.infuzhou.co.cc':
  case 'infuzhou.co.cc':
    $fg_config=dirname(__FILE__).'/protected/config/fg_config.php';
    require_once $fg_config;
    break;
  default:
    $config=dirname(__FILE__).'/protected/config/main.php';
    break;
}

// require background config
$bg_url = array(
    'index.php?r=site/login',
    'index.php?r=site/logout',
    'index.php?r=admin/',
);
foreach( $bg_url as $url ) {
  if( strpos($_SERVER['REQUEST_URI'], $url ) !== false ) {
    $bg_config=dirname(__FILE__).'/protected/config/bg_config.php';
    require_once $bg_config;
    break;
  }
}

switch($_SERVER['HTTP_HOST']){
  case 'new.infuzhou.com':
    $bg_config=dirname(__FILE__).'/protected/config/newtheme_config.php';
    require_once $bg_config;
}

// require global config
$config=dirname(__FILE__).'/protected/config/global_config.php';
require_once $config;
// replace the config
$config_ar['theme'] = $sep_config_ar['theme']; 
$config_ar['components']['urlManager']  = $sep_config_ar['components']['urlManager']; 


// start yii process
$yii=dirname(__FILE__).'/../yii-download/yii-1.1.3.r2247/framework/yii.php';

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config_ar)->run();
