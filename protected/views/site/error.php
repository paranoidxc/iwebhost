<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<div class='mac_panel_wrap w800p'>
  <?php  
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>Yii::app()->name . ' - Error') );
  ?>
  
  <h2>Error <?php echo $code; ?>: oh noes, there's nothing in here</h2>
  
  <div class="error">
  <?php echo CHtml::encode($message); ?>
  </div>

  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>