<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />		
<?php 
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');  
?>	
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<div class="container" id="page">
	<div id="header">		
		<div id="navigation">			
		  <?php		    		    
		    $this->renderPartial('navigation', array( 'nodes' => API::INODE( array('ident_label' => 'mw_major_nav','depth' => '' ) ) ) );
		  ?>
		</div>
	</div><!-- header -->

	<?php echo $content; ?>	
	
	<div id="footer">
	  <div id="foot_nav">
	  <?php		    		    
		    $this->renderPartial('navigation', array( 'nodes' => API::INODE( array('ident_label' => 'mw_foot_nav','depth' => '') ) ) );
		?>
		</div>
	</div>
</div><!-- page -->

</body>
</html>
