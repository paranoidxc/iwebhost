<?php
error_reporting(null);
// change the following paths if necessary
$website_dir = dirname(__FILE__);
$g_upfiles_dir = '/upfiles';
$atms_dave_dir = $website_dir.'/upfiles/';

//$atms_dave_dir = '/home/huangxc/upfiles/';

$yii=dirname(__FILE__).'/../yii-download/yii-1.1.3.r2247/framework/yii.php';

switch($_SERVER['HTTP_HOST']){
  case 'local.infuzhou.com':
  case 'www.infuzhou.co.cc':
  case 'infuzhou.co.cc':
    $config=dirname(__FILE__).'/protected/config/infuzhou.php';
    break;
  default:
    $config=dirname(__FILE__).'/protected/config/main.php';
    break;
}


// remove the following lines when in production mode
define('WEBSITE_DIR',$website_dir);
define('ATMS_SAVE_DIR',$atms_dave_dir);
define('UPFILES_DIR', $g_upfiles_dir);

define('THUMB_SIZE',  '160_120');
define('GAVATAR_SIZE','48_48');
define('LARGE_SIZE',  '800_600');

define('IHOST_STUDIO', 'http://www.google.com');
defined('YII_DEBUG') or define('YII_DEBUG',true);

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
include_once "markdown.php";
function _debug($s) {
	print_r($s);
	print_r("<br/>");
}

$colorful = "#093 #639 #693 #606 #669 #066 #033 #339 #999 #4588CE #9C0909 #171717 #CA0B0B #5FB509 #363636 #FF5900";
$colorful_array = explode(' ',$colorful);
$img_ext = array("jpg", "jpeg", "png", "gif");


function colorful($s='my love--!'){
	global $colorful_array;	
	$color =  $colorful_array[rand(0,count($colorful_array)-1)];	
	return "<span style='color: $color' >".$s."</span>";
}

function colorfulV($s='my love--!'){
	global $colorful_array;	
	return $colorful_array[rand(0,count($colorful_array)-1)];	
}


function cnSub($str,$len){
  return cnSubStr($str,0,$len);
}


function cnSubstr($str, $start, $len) { 
  //$str_tmp = $len - $start; 
  $tmpstr = ""; 
  $strlen = $start + $len; 
  $i = 0;  
  $n = $pos = 0;   
  while( $n < $strlen ){   
    $ascnum = ord(substr($str, $i, 1)) ;      
    if( $ascnum > 224) { 
      $step = 3;
      $pos += 3;
    }elseif ($ascnum>=192) {
      $step = 2;      
      $pos += 2;
    }elseif ($ascnum >0) {
      $step = 1;      
      $pos += 1;
    } else {
      break;
    }
    if( $n >= $start ){
      $tmpstr .= substr($str, $i, $step); 
    }
    $i += $step;    
    if( $pos%3 == 0){
      $n ++;
    }
  }
  if( $i<strlen($str) ){
    $tmpstr .= "…";   
  }   
  return $tmpstr; 
}

require_once('class.phpmailer.php');
require_once($yii);
Yii::createWebApplication($config)->run();
