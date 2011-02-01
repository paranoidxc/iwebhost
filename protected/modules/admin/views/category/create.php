<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Create Node") )
?>

111111111
<?php echo $return_panel_ident?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'model_type' => $model_type,'return_panel_ident' => $return_panel_ident )); ?>

<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>