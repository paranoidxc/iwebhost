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
  //
	$cs->registerCssFile($baseUrl.'/css/new/portfolio.css');		
	$cs->registerCssFile($baseUrl.'/css/vlightbox.css');
	$cs->registerCssFile($baseUrl.'/css/visuallightbox.css');
?>

<style type="text/css">
  :focus { outline: 0; }
</style>
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>	
<div id="wrap">
  <div id="vlightbox">
  <?php
    foreach($category->images as $t){	     	        
	        echo "<div class='img_wrap'><a class='vlightbox' href='".Yii::app()->request->baseUrl.'/upfiles/'.$t->path."' title='$t->screen_name' >";
	        echo "<img src='/upfiles/s".$t->path."' title='' alt='' /> ";
          echo '</a>';
          echo '<p>'.$t->screen_name.'</p>';
          echo '</div>';
	  }		  
  ?>
  <a id="vlb" href=""></a>
  </div>	

<div id="foot">
  <div id="w3c">
    <span class="style-grey">
      Valid 
      <a href="http://validator.w3.org/check?uri=referer" target="_blank">xhtml</a> 
      // 
      <a href="http://jigsaw.w3.org/css-validator/" target="_blank">css</a>
    </span>
  </div>
</div>

</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/visuallightbox.js"></script>
</body>
</html>
