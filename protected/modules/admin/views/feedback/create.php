<div class='mac_panel_wrap w600P' >
<input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Create Feedback") )
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php
  $this->endWidget('application.extensions.Flatmacpanel');
?>
</div>