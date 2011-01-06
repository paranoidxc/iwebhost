<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Create User") )
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>