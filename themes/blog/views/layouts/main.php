<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta charset="utf-8">
<?php 
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	//Yii::app()->clientScript->registerCoreScript('jquery');			
	$cs->registerCssFile($baseUrl.'/css/jScrollPane.css');	
	$cs->registerScriptFile($baseUrl.'/js/jquery-1.2.6.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.em.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.mousewheel.js');	
	//$cs->registerScriptFile($baseUrl.'/js/jquery.onImagesLoad.js');	
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
</div><!-- page -->

</body>
</html>
