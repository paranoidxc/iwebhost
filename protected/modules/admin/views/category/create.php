<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Create Node") )
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'model_type' => $model_type)); ?>

<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>