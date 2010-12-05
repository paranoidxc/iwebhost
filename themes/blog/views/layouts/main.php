<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="xiaochuanhuang,huangxc,黄小川,小川黄,paranoid,paranoid.xc" /> 
  <meta name="description" content="Creative Colorful Project in China" /> 
	<meta name="author" content="Designed by xiaochuanhuang,huangxc" /> 
	<meta name="copyright" content="huangxc" /> 
	<meta name="company" content="huangxc" /> 
	<meta name="robots" content="all" /> 
<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	//Yii::app()->clientScript->registerCoreScript('jquery');			
	$cs->registerCssFile($baseUrl.'/css/jScrollPane.css');
	$cs->registerScriptFile($baseUrl.'/js/jquery-1.2.6.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.hotkeys.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.em.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.mousewheel.js');		
	$cs->registerScriptFile($baseUrl.'/js/jScrollPane.js');
	$cs->registerScriptFile($baseUrl.'/js/blog.js');
	$cs->registerCssFile($baseUrl.'/css/blog/blog.css');	
?>	
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">	
  <h1 id="site-title">程序员第</h1>
	<?php echo $content; ?>
	
	
	<footer>
	  <h1>About this Blog</h1>
  	<p>
  	  This blog is maintained by <em><a href="http://kado.im/huangxc" target="_blank">xiaochuanHuang</a></em>. 
  	  Prowered By <em><a href="https://github.com/paranoidxc/iwebhost" target="_blank">iwebhost</a></em>. You may have
  			noticed that the subjects on this blog tend to vary, which is
  			"as intended".  A lot of things and technologies interest
  			me, whether it is .  I write
  			about all of those,about any other kind of thing that pops to my mind or that I think
  			is worth sharing with the world.
  	</p>
    <p>This blog is rendered as intended in Firefox,Google Chrome,Safari, but not necessarily in Internet Explorer.</p>
  </footer>
</div><!-- page -->
</body>
</html>
