<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<?php  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');  
	$cs->registerScriptFile($baseUrl.'/js/jquery.lightbox-0.5.min.js');					
	$cs->registerCssFile($baseUrl.'/css/jquery.lightbox-0.5.css');		
?>

<style type="text/css">
  body {
    background: #000;
  }
  #portfolio {
    width: 80%;
    margin: auto;
    text-align: center;
    margin-top: 10%;
  }
</style>
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>	
<script type="text/javascript">
$(document).ready(function(){		  
  $('.lightbox').lightBox({		
		imageLoading: '/images/lightbox-ico-loading.gif',
		imageBtnClose:'/images/lightbox-btn-close.gif',
		imageBtnPrev: '/images/lightbox-btn-prev.gif',
		imageBtnNext: '/images/lightbox-btn-next.gif',		
   });
});
</script>
<div id="portfolio">
  <?php
    foreach($category->images as $t){	     	        
	        echo "<a class='lightbox' href='".Yii::app()->request->baseUrl.'/upfiles/'.$t->path."' >";
	        echo "<img src='/upfiles/s".$t->path."' /> ";
	        echo '</a>';
	  }	
  ?>
</div>	
</body>
</html>