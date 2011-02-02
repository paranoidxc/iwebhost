<div class='mac_panel_wrap w600P' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Create Node") )
?>

<?php echo $return_panel_ident?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'model_type' => $model_type,'return_panel_ident' => $return_panel_ident )); ?>
<div class="ajax_overlay" ></div>
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>