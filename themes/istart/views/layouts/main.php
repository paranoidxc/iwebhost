<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!--
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.8.2.custom.css" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/console.css" />

	<!--
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">	
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">
	-->
<?php  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');  
	$cs->registerScriptFile($baseUrl.'/js/istart.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.8.2.custom.min.js');	
	$cs->registerCssFile($baseUrl.'/css/istart.css');	
	
?>	
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="header">
		<div id="logo"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/istartpage.png" title="<?php echo CHtml::encode(Yii::app()->name);?>"/></div>
		<?php 
		if( !Yii::app()->user->isGuest ) {
			echo CHtml::link( 'Go to Conosle Page', CController::createurl('admin/category/leafs') , array('target' => '_blank', 'class' => 'console_link') );
		}
		?>
		<div id="navigation">
			<ul>
				<li><a href="/">Home</a></li>								
				<?php 
					if( $this->page_navigation ){					
					foreach( $this->page_navigation as $nav ){					
					echo '<li><a href="'.CController::createurl('istart/inav', array('db_id' => $nav['id'], 'category_id' => $nav['category_id'] ) ).'">';
					echo $nav['name'];
					echo '</a></li>';
					echo "\n";
					}
				}?>				
			</ul>
		</div>
	</div><!-- header -->

	<?php echo $content; ?>	
</div><!-- page -->

</body>
</html>
