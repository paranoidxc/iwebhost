<?php
if( !$is_update ) {
  ?>
  <div class='mac_panel_wrap w600P' >
<?php  
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Update Node") )
?>
  <?php
}
?>


<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs, 'model_type' => $model_type)); ?>


<?php
if( !$is_update ) {
  ?>
  <?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>
  <?php
}
?>