<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="福州,福州社区,福州论坛,福州分类信息" /> 
  <meta name="description" content="fuzhou,infuzhou,ifuzhou forum" /> 
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
  $cs->registerCssFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.4.css');			
	//$cs->registerCssFile($theme_baseurl.'/css/widgEditor.css');			
  /*<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/swfupload.js"></script>	
  <script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/swfupload.queue.js"></script>
  <script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/fileprogress.js"></script>
  <script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/handlers.js"></script>
  */
  ?>
  <script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/swf.all.js"></script>
  <script type="text/javascript" src="<?php echo $baseUrl?>/js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="<?php echo $baseUrl?>/js/jquery.timeago.js"></script>
  <script type="text/javascript" src="<?php echo $baseUrl?>/js/tiny_mce/jquery.tinymce.js"></script>
  <script type="text/javascript" src="<?php echo $baseUrl?>/js/jquery.Jcrop.min.js"></script>
  <script type="text/javascript" src="<?php echo $baseUrl?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
  <script type="text/javascript" src="<?php echo $baseUrl?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="<?php echo $theme_baseurl?>/js/script.js"></script>

  <link  rel="stylesheet"  type="text/css"  href="<?php echo $theme_baseurl; ?>/swfupload/swfupload.css" />
  <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/images/favicon.ico" />
<title><?php 
  if( !empty($this->_pageTitle) ) {
    echo $this->_pageTitle;
  }
  echo Yii::app()->name;
  ?></title>
</head>
<!-- It is a truth universally acknowledged, that a single man in possession of a good fortune must be in want of a wife. -->
<body>
<div class="ibg" id="page">
  <div id="header">
    <div class="container">
      <div class='grid3 first'>
        <h1 title="infuzhou 社区"><a href="/"><img src="<?php echo $theme_baseurl?>/css/bgs/logo.png" alt='' /></a></h1>
      </div>
      <div class='grid9 nav'>      
        <ul>
          <li><a href="/" title="首页">首页</a></li>
          <?php        
            if( user()->isGuest ){
          ?>          
          <li><a href="<?php echo bu('signup.html' ) ?>" title="注册">注册</a></li>
          <li><a href="<?php echo bu('signin.html' ) ?>" title="登录">登录</a></li>
          <?php
            }else {
          ?>
            <?php if( $this->iuser->account_type == 1 ) {
            ?>
            <li><a href="<?php echo ADMIN_URL; ?>" target="_blank" >后台管理</a></li>
            <?php } ?>
            <li>
              <a href="<?php echo url('ib/index') ?>" >私信</a>
              <?php 
              if( ( $_t_unread_mail_count = $this->iuser->unread_mail_count ) > 0 ) {
              ?>
              <span class='mail_not'><?php echo $_t_unread_mail_count ?></span>
              <?php 
                }
              ?>
            </li>
           <li>
            <a href="<?php echo bu('notifications.html') ?>" >提醒</a>
            <?php
            if( ( $_t_notices_count  = Notification::model()->notices_count()->count() ) > 0 ) {
            ?>
            <span class="mail_not"><?php echo $_t_notices_count ;?></span>
            <?php
            }
            ?>
           </li>
            <li id='signin_user_wrap'>
              <a id='signin_user_link' href="<?php echo url('m/you' ) ?>">Hi,<?php echo user()->name ?></a>
              <ul class='dN signin_user_menu'>
                <li><a href="<?php echo url('m/nodes' ) ?>">收藏的节点</a></li>
                <li><a href="<?php echo bu('settings.html') ?>" >资料设置</a></li>
              </ul>
            </li>
           <li><a href="<?php echo bu('signout.html') ?>" >登出</a></li>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </div>

  <div class='pt80P'>
	  <?php echo $content; ?>
	</div>
	
	<div id="footer">
	  <div class="container clearfix">  
	    <div class="grid11 first copyfight">
	      <p class="mb10P">
  	      <?php
            $ipage = API::node(array('ident_label' => 'ipage'));
  	        for( $i=0; $i< count($ipage->articles( array('order' => 'sort_id asc') ) ); $i++ ){
  	          $inst = $ipage->articles[$i];  	          
  	      ?>
    	      <strong>
    	        <a href="<?echo url('topic/index', array('id' => $inst->urlarg ) ) ?>"><?php echo $inst->title ?></a>
    	      </strong>
      	    <?php if( $i != count($ipage->articles)-1 ) { echo '&nbsp;•&nbsp;'; } ?>
    	    <?php
  	        }
  	      ?>
	      <p>
	      
	      Infuzhou(VERSION: 0.1) Maintained by 
	      <strong><a href="http://kado.im/huangxc" target="_blank">xiaochuanHuang</a></strong>
	      Prowered By <strong><a href="https://github.com/paranoidxc/iwebhost" target="_blank">iwebhost</a></strong>.
    	</div>	    
  	</div>
  </div>
  
</div><!-- page -->


<?php
/*
  $cs->registerScriptFile($baseUrl.'/js/jquery-1.4.2.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.Jcrop.min.js');	
	$cs->registerScriptFile($baseUrl.'/js/jquery.timeago.js');	
	$cs->registerScriptFile($baseUrl.'/js/tiny_mce/jquery.tinymce.js');	
	$cs->registerScriptFile($theme_baseurl.'/js/script.js');	
  <script type="text/javascript" src="<?php echo $theme_baseurl?>/js/widgEditor.js"></script>
*/
?>
</body>
</html>
