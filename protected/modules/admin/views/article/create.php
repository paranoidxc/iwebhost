<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>$panel_title) )
?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs , 'leaf' => $leaf )); ?>
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>