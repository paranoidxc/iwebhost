<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/console.css" />
	
<?php  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');  
	$cs->registerScriptFile($baseUrl.'/js/istart.js');
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.8.2.custom.min.js');	
	$cs->registerCssFile($baseUrl.'/css/books.css');	
	
?>	
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="header">
		<ul id="location">
			<?php echo $this->location ?>
		</ul>
	</div><!-- header -->


<div class="books-wrap">
<div class="chapters">	
	<ul>
		<?php
			if( $category->articles ){	
				foreach( $category->articles as $article ){
					echo '<li><a href="'.CController::createurl('istart/chapter', array('id' => $article->id, 'ajax' => 'ajax' )). '">'.$article->title.'</a></li>';
				}			
		}?>		
	</ul>
</div>
<?php
	if( $article ){		
		$this->renderPartial('chapter', array('chapter' => $article ));
	}
?>		
</div>
</div><!-- page -->

</body>
</html>