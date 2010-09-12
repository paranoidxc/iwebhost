<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
<?php  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');  
	//$cs->registerScriptFile($baseUrl.'/js/visuallightbox.js');
	//$cs->registerScriptFile($baseUrl.'/js/jquery.lightbox-0.5.min.js');					
	//$cs->registerCssFile($baseUrl.'/css/jquery.lightbox-0.5.css');		
	$cs->registerCssFile($baseUrl.'/css/vlightbox.css');
	$cs->registerCssFile($baseUrl.'/css/visuallightbox.css');
?>

<style type="text/css">
  body {
    background: #000;
  }
  #vlightbox {
    width: 80%;
    margin: auto;
    text-align: center;
    margin-top: 10%;
  }
  #vlightbox img {
    border: none;
    outline: none;
  }
  #vlightbox a#vlb{display:none}
  :focus { outline: 0; }
</style>
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>	
<script type="text/javascript">
$(document).ready(function(){		  
  /*
  $('.lightbox').lightBox({		
		imageLoading: '/images/lightbox-ico-loading.gif',
		imageBtnClose:'/images/lightbox-btn-close.gif',
		imageBtnPrev: '/images/lightbox-btn-prev.gif',
		imageBtnNext: '/images/lightbox-btn-next.gif',		
   });
   */
});
</script>
<div id="vlightbox">
  <?php
    foreach($category->images as $t){	     	        
	        echo "<a class='vlightbox' href='".Yii::app()->request->baseUrl.'/upfiles/'.$t->path."' title='33' >";
	        echo "<img src='/upfiles/s".$t->path."' title='1' /> ";
	        echo '</a>';
	  }		  
  ?>
  <a id="vlb" href=""></a>
</div>	
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/visuallightbox.js"></script>
</body>
</html>