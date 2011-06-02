<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" /> 
<?php  
  $theme_baseurl = API::get_theme_baseurl();  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
?>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/form.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jquery-ui-1.8.2.custom.css" />  
  <link rel="stylesheet" type="text/css" href="<?php echo $theme_baseurl; ?>/css/widgEditor.css" /> 
<!--
  <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/console.css" />  
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jScrollHorizontalPane.css" />
-->


<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/swfupload.js"></script>	
<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/swfupload/handlers.js"></script>
<link  rel="stylesheet"  type="text/css"  href="<?php echo $theme_baseurl; ?>/swfupload/swfupload.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<textarea class="dN" id="FlatPanelHeader"><?php echo FlatmacpanelString::header() ?></textarea>
<textarea class="dN" id="FlatPanelFooter"><?php echo FlatmacpanelString::footer() ?></textarea>
</div>

<!--<div class="container" id="page">-->

	<div id="mainmenu" style="position: relative">
		<?php 
      $_isAdmin = User::model()->findByPk(User()->id)->account_type;
      $_isAdmin = $_isAdmin != 1 ? false : true;
      $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			  array('label'=>Yii::t('cp','Website'),
              'url'=>array('/') ,
              'linkOptions' => array('target' => '_blank') ),
			  array('label'=>Yii::t('cp', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			  array('label'=>Yii::t('cp','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('cp','Dashboard'), 'url'=>array('/admin/Dashboard/index'),
          'visible' => $_isAdmin,
          ),
				array('label'=>Yii::t('cp','ROOT'), 'url'=>array('/admin/category/iroot') ,
          'visible' => $_isAdmin,
          'linkOptions' => array( 'data' => 'panel_root' )),
				array('label'=>Yii::t('cp','Navigation'), 'url'=>array('/admin/category/inavigation'),
          'visible' => $_isAdmin,
          'linkOptions' => array( 'data' => 'panel_inavigation' ) ),
				array('label'=>Yii::t('cp','Category'), 'url'=>array('/admin/category/icategory'),
          'visible' => $_isAdmin,
          'linkOptions' => array( 'data' => 'panel_icategory' )),
				array('label'=>Yii::t('cp','Attachment'), 'url'=>array('/admin/category/iattachment'),
          'visible' => $_isAdmin,
          'linkOptions' => array( 'data' => 'panel_iattachment' )),
				array('label'=>Yii::t('cp','Articles'), 'url'=>array('/admin/article/index'),
          'visible' => $_isAdmin,
          'linkOptions' => array( 'data' => 'nav_panel_Articles' )),
				array('label'=>Yii::t('cp','Admins'), 'url'=>array('/admin/user/index'),
          'visible' => $_isAdmin,
          'linkOptions' => array( 'data' => 'nav_panel_admins' )),
				array('label'=>Yii::t('cp','Feedback'), 'url'=>array('/admin/feedback/index'),
          'visible' => $_isAdmin,
          'linkOptions' => array( 'data' => 'nav_panel_feedback' )),
				array('label'=>Yii::t('cp','Settings'), 'url'=>array('/admin/setting/index'),
          'visible' => $_isAdmin,
          'linkOptions' => array( 'data' => 'nav_panel_settings' )),				
			),
		)); ?>
		
	</div><!-- mainmenu -->

<div class="choose_lang_wrap ">
  <div class="">
  	<h1 class=""><?php echo Yii::t('cp',Yii::app()->language); ?>&nbsp;&raquo;</h1>  		  	    
  </div>
</div>
<div class='dN choose_lang_ul_wrap'>
	<ul>
	<li>
		<a href='<?php echo CController::createUrl('/site/cplang', array('lang'=> 'zh_cn') ); ?>'>
			简体中午&nbsp;&nbsp;
		</a>
	</li>
	<li>
		<a href='<?php echo CController::createUrl('/site/cplang', array('lang'=> 'en_us') ); ?>' >
			English&nbsp;&nbsp;
		</a>
		</li>
</ul>
</div>
	<?php echo $content; ?>  
  <img id="ihost_logo" src="<?php echo $theme_baseurl;?>/images/ihost-gray.png" alt="ihost" title="ihost"/>  
<!--</div>-->
<!-- page -->
<?php
	Yii::app()->clientScript->registerCoreScript('jquery');  
	/*
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.8.2.custom.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.em.js');		
	$cs->registerScriptFile($baseUrl.'/js/jquery.lightbox-0.5.min.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery.imasker.js');
	$cs->registerScriptFile($theme_baseurl.'/js/'.API::get_lang().'.js');
	$cs->registerScriptFile($theme_baseurl.'/js/console.api.categorys.js');			
	$cs->registerScriptFile($theme_baseurl.'/js/fieldSelection.js');
	$cs->registerScriptFile($theme_baseurl.'/js/app-script.js');	
	*/
  /*
  $cs->registerScriptFile($baseUrl.'/js/jScrollPane.js');
	$cs->registerScriptFile($baseUrl.'/js/jScrollHorizontalPane.js');	
  $cs->registerScriptFile($baseUrl.'/js/tree.js');		
	$cs->registerScriptFile($baseUrl.'/js/tiny_mce/tiny_mce.js');  
	$cs->registerCssFile($baseUrl.'/css/jquery.lightbox-0.5.css');	
	$cs->registerCssFile($theme_baseurl.'/css/console.api.categorys.css');
	*/
	$cs->registerCssFile($theme_baseurl.'/css/main.css');	
	$cs->registerCssFile($theme_baseurl.'/css/all.css');	
?>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.em.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.lightbox-0.5.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.imasker.js"></script>
<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/js/i18n/<?php echo API::get_lang(); ?>.js"></script>
<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/js/console.api.categorys.js"></script>
<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/js/fieldSelection.js"></script>
<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/js/tiny_mce/jquery.tinymce.js"></script>


<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/js/app-script.js"></script>
<script type="text/javascript" src="<?php echo API::get_theme_baseurl(); ?>/js/widgEditor.js"></script>
</body>
</html>
