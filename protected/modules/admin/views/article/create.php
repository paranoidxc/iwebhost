<div class='mac_panel_wrap w800p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Create New") )
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs , 'leaf' => $leaf )); ?>

<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>