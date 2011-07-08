<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" /> 
<?php  
  $theme_baseurl = API::get_theme_baseurl();  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();	
//  $cs->registerCoreScript('jquery');  
?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
  
<script type="text/javascript" src="<?php echo $theme_baseurl?>/swfupload/swfupload.js"></script>	
<script type="text/javascript" src="<?php echo $theme_baseurl?>/swfupload/swfupload.queue.js"></script> 
<script type="text/javascript" src="<?php echo $theme_baseurl?>/swfupload/fileprogress.js"></script> 
<script type="text/javascript" src="<?php echo $theme_baseurl?>/swfupload/handlers.js"></script> 
<link  rel="stylesheet"  type="text/css"  href="<?php echo $theme_baseurl?>/swfupload/swfupload.css" /> 

</head>
<body>
  <?php echo $this->renderPartial( '//layouts/flash') ?>

  <div id="w_top">
		<?php 
      $_isAdmin =& $this->iuser->account_type;
      $_isAdmin = $_isAdmin != 1 ? false : true;
      $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			  array('label'=>Yii::t('cp','Website'), 'url'=>'/', 'linkOptions' => array('target' => '_blank') ),

			  array('label'=>Yii::t('cp', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),

			  array('label'=>Yii::t('cp','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),

				array('label'=>Yii::t('cp','Dashboard'), 'url'=>array('/cp/Dashboard/index'),
          'visible' => $_isAdmin,
          'itemOptions' => array('class' => API::isaction('cp/Dashboard') ),
          ),

        array('label'=>'页脚页面', 'url'=>array('/cp/article/ipage/208' ),
          'visible' => $_isAdmin,
          'itemOptions' => array('class' => API::isaction( array(
                'cp/article/ipage/','/action/ipage/','/action/ipage.html' ) ) ),
          'linkOptions' => array( 'data' => 'nav_panel_Articles' )),

        array('label'=>'社区节点', 'url'=>array('/cp/article/innode/206') ,
          'visible' => $_isAdmin,
          'itemOptions' => array('class' => API::isaction( array( 
                'cp/article/innode' ,'/action/innode/', '/action/innode.html') ) ) ,
          'linkOptions' => array( 'data' => 'nav_panel_Articles' )),

				array('label'=>Yii::t('cp','Attachment'), 'url'=>array('/cp/attachment/index/category_id/30'),
          'visible' => $_isAdmin,
          'itemOptions' => array('class' => API::isaction('cp/attachment/') ),
          'linkOptions' => array( 'data' => 'panel_iattachment' )),

//				array('label'=>Yii::t('cp','Articles'), 'url'=>array('/cp/article/index'),
 //         'visible' => $_isAdmin,
  //        'itemOptions' => array('class' => API::isaction('cp/article') ),
   //       'linkOptions' => array( 'data' => 'nav_panel_Articles' )),

				array('label'=>Yii::t('cp','Users'), 'url'=>array('/cp/user/index'),
          'visible' => $_isAdmin,
          'itemOptions' => array('class' => API::isaction('cp/user') ),
          'linkOptions' => array( 'data' => 'nav_panel_admins' )),

				array('label'=>Yii::t('cp','Feedback'), 'url'=>array('/cp/feedback/index'),
          'visible' => $_isAdmin,
          'itemOptions' => array('class' => API::isaction('cp/feedback') ),
          'linkOptions' => array( 'data' => 'nav_panel_feedback' )),

				array('label'=>Yii::t('cp','Settings'), 'url'=>array('/cp/setting/index'),
          'visible' => $_isAdmin,
          'itemOptions' => array('class' => API::isaction('cp/setting') ),
          'linkOptions' => array( 'data' => 'nav_panel_settings' )),				
			),
		)); ?>
		
	</div><!-- top wrap end -->

	<?php echo $content; ?>  

<?php
//	Yii::app()->clientScript->registerCoreScript('jquery');  
	$cs->registerCssFile($theme_baseurl.'/css/all.css');	
?>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>/js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>/js/jquery.imasker.js"></script>
<script type="text/javascript" src="<?php echo $theme_baseurl; ?>/js/script.js"></script>
</body>
</html>
