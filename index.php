<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-download/yii-1.1.3.r2247/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

function _debug($s) {
	print_r($s);
	print_r("<br/>");
}

$colorful = "#093 #639 #693 #606 #669 #066 #033 #339 #999 #4588CE #9C0909 #171717 #CA0B0B #5FB509 #363636 #FF5900";
$colorful_array = explode(' ',$colorful);

function colorful($s='my love--!'){
	global $colorful_array;	
	$color =  $colorful_array[rand(0,count($colorful_array)-1)];	
	return "<span style='color: $color' >".$s."</span>";
}

function colorfulV($s='my love--!'){
	global $colorful_array;	
	return $colorful_array[rand(0,count($colorful_array)-1)];	
}
require_once($yii);
Yii::createWebApplication($config)->run();
