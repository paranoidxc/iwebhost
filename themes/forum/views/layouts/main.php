<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="" /> 
  <meta name="description" content="Creative Colorful Project in China" /> 
	<meta name="author" content="Designed by xiaochuanhuang,huangxc" /> 
	<meta name="copyright" content="huangxc" /> 
	<meta name="company" content="huangxc" /> 
	<meta name="robots" content="all" /> 
<?php
	$baseUrl = Yii::app()->baseUrl; 
	$theme_baseurl = API::get_theme_baseurl();
	$cs = Yii::app()->getClientScript();
	//Yii::app()->clientScript->registerCoreScript('jquery');					
	$cs->registerCssFile($theme_baseurl.'/css/all.css');		
?>	
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<!-- I Love You -->
<body>
<div class="ibg" id="page">
  <div id="header">
    <div class="container">
      <div class='grid6 first'>
        <h1 title="infuzhou 社区"><a href="/"><img src="<?php echo $theme_baseurl?>/css/bgs/logo.png" alt='' /></a></h1>
      </div>
      <div class='grid6 nav'>      
        <ul>
          <li><a href="<?php echo Yii::app()->request->baseUrl; ?>" title="首页">首页</a></li>
          <?php        
            if( Yii::app()->user->isGuest ){
          ?>          
          <li><a href="<?php echo CController::createUrl('s/signup' ) ?>" title="注册">注册</a></li>
          <li><a href="<?php echo CController::createUrl('s/signin' ) ?>" title="登录">登录</a></li>
          <?php
            }else {
          ?>
            <li><a href="<?php echo CController::createUrl('m/index' , array('id' => Yii::app()->user->id )) ?>">Hi,<?php echo Yii::app()->user->name ?></a></li>
            <li><a href="<?php echo CController::createUrl('s/signout') ?>" >登出</a></li>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </div>

  <div>
	  <?php echo $content; ?>
	</div>
	
	<div id="footer">
	  <div class="container clearfix">  
	    <div class="grid11 first copyfight">
	      <p class="mb10P">
  	      <strong>
  	        <a href="#">About</a>
  	      </strong>
  	      &nbsp;•&nbsp;
  	      <strong>
  	        <a href="#">FAQ</a>
  	      </strong>
  	      &nbsp;•&nbsp;
  	      <strong>
  	        <a href="#">Support</a>
  	      </strong>
	      <p>
	      
	      Infuzhou(VERSION: 0.1) Maintained by 
	      <strong><a href="http://kado.im/huangxc" target="_blank">xiaochuanHuang</a></strong>
	      Prowered By <strong><a href="https://github.com/paranoidxc/iwebhost" target="_blank">iwebhost</a></strong>.
    	</div>	    
  	</div>
  </div>
  
</div><!-- page -->
<?php
  $cs->registerScriptFile($theme_baseurl.'/js/jquery-1.4.2.min.js');
	$cs->registerScriptFile($theme_baseurl.'/js/jquery.timeago.js');
	$cs->registerScriptFile($theme_baseurl.'/js/script.js');
?>
</body>
</html>