<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/console.css" /> -->
	
<?php  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');  
	$cs->registerScriptFile($baseUrl.'/js/jquery.imasker.js');
	$cs->registerScriptFile($baseUrl.'/js/istart.js');	
	$cs->registerScriptFile($baseUrl.'/js/api.categorys.js');	
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.8.2.custom.min.js');	
	$cs->registerCssFile($baseUrl.'/css/nbooks.css');		
	$cs->registerCssFile($baseUrl.'/css/api.categorys.css');
	//$cs->registerCssFile($baseUrl.'/css/books.css');
	
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
	<div id="header_shadow">
	</div>


<div class="books-wrap">
<div class="chapters">
  <?php
    $nodes = API::categorys(array( 
		  'id'          => $category->id,
		  'depth'       => 10000,
		  'recursion'   => true
		));	
		$this->renderPartial('node',array( 'nodes' => $nodes ) );
  ?>

  <?php 
     API::articles(array(
      'type'    => 'obj',
      'obj'     => $category,      
      'dom'     => 'ul',
      'url'     => 'istart/chapter',
      'url_option' => array( 'ajax' => 'ajax' )    
    ));
  ?>
	<ul>
		<?php		
			if( $category->articles ){	
				foreach( $category->articles as $article ){
		//			echo '<li><a href="'.CController::createurl('istart/chapter', array('id' => $article->id, 'ajax' => 'ajax' )).'"
			//		title="'.$article->title.'" >'.$article->title.'</a></li>';
				}			
		}		
		?>		
	</ul>
</div>
<div class="chapter_handle">

</div>
<div class=' chapter' id="chapter">
  <h2>Bababa...................</h2>
</div>
<?php
  
  /*
  if( $category->first_article() ){
    $this->renderPartial('chapter', array('chapter' => $category->first_article() ));
  } 
  */ 
  /*
	if( $article ){		
		$this->renderPartial('chapter', array('chapter' => $article ));
	}
	*/
?>		
</div>
</div><!-- page -->

</body>
</html>