<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />  		

  
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/console.css" />  

<!--	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jScrollHorizontalPane.css" /> -->

  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.8.2.custom.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/swfupload/swfupload.css" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/swfupload/swfupload.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/swfupload/swfupload.queue.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/swfupload/fileprogress.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/swfupload/handlers.js"></script>

	

<?php  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	
	Yii::app()->clientScript->registerCoreScript('jquery');  
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.8.2.custom.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.em.js');
	$cs->registerScriptFile($baseUrl.'/js/jScrollPane.js');
	$cs->registerScriptFile($baseUrl.'/js/jScrollHorizontalPane.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.lightbox-0.5.min.js');			
	$cs->registerScriptFile($baseUrl.'/js/console.api.categorys.js');		
	$cs->registerScriptFile($baseUrl.'/js/jquery.imasker.js');
	$cs->registerScriptFile($baseUrl.'/js/fieldSelection.js');
	$cs->registerScriptFile($baseUrl.'/js/app-script.js');
	//$cs->registerScriptFile($baseUrl.'/js/tree.js');		

	$cs->registerScriptFile($baseUrl.'/js/tiny_mce/tiny_mce.js');
  
	$cs->registerCssFile($baseUrl.'/css/jquery.lightbox-0.5.css');	
	$cs->registerCssFile($baseUrl.'/css/main.css');	
	$cs->registerCssFile($baseUrl.'/css/all.css');	
	$cs->registerCssFile($baseUrl.'/css/console.api.categorys.css');
	
	
?>	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="mainmenu" style="position: relative">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			  array('label'=>Yii::t('cp','Website'),'url'=>array('/site/index')),							
			  array('label'=>Yii::t('cp', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			  array('label'=>Yii::t('cp','Login').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('cp','Dashboard'), 'url'=>array('/admin/Dashboard/index')),
				array('label'=>Yii::t('cp','ROOT'), 'url'=>array('/admin/category/iroot')),
				array('label'=>Yii::t('cp','Navigation'), 'url'=>array('/admin/category/inavigation')),
				array('label'=>Yii::t('cp','Category'), 'url'=>array('/admin/category/icategory')),
				array('label'=>Yii::t('cp','Attachment'), 'url'=>array('/admin/category/iattachment')),
				array('label'=>Yii::t('cp','Articles'), 'url'=>array('/admin/article/index')),
				array('label'=>Yii::t('cp','Admins'), 'url'=>array('/admin/user/index')),
				array('label'=>Yii::t('cp','Feedback'), 'url'=>array('/admin/feedback/index')),
				array('label'=>Yii::t('cp','Settings'), 'url'=>array('/admin/setting/index')),		
				//array('label'=>'Settings', 'url'=>array('/admin/setting/index')),		
			),
		)); ?>
		
	</div><!-- mainmenu -->

<div class="choose_lang_wrap radius4">
  <div class="radius4">
  	<h1 class=""><?php echo Yii::t('cp',Yii::app()->language); ?>&nbsp;&raquo;</h1>
  	<ul class='dN'>
      <li><a href='<?php echo CController::createUrl('/site/cplang', array('lang'=> 'zh_cn') ); ?>'><?php echo Yii::t('cp','zh_cn'); ?></a></li>
      <li><a href='<?php echo CController::createUrl('/site/cplang', array('lang'=> 'en_us') ); ?>' ><?php echo Yii::t('cp','en_us'); ?></a></li>
    </ul>
  </div>
</div>
		
	<?php echo $content; ?>
	

  <div style="position: fixed; bottom: 10px; right: 10px; z-index: 2;">
    <img src="<?php echo Yii::app()->request->baseUrl;?>/images/ihost-gray.png" alt="ihost" title="ihost"/>
  </div>
</div><!-- page -->

</body>
</html>
