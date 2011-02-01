<?php
if( !$is_update ) {
  ?>
  <div class='mac_panel_wrap w800P'>
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>'Edit '.$model->id.' : '.cnSubstr($model->title,0,20)) )
?>
  <?php
}
?>

<input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />
<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs, 'leaf'  => $model->leaf,'panel_ident' => $panel_ident)); ?>

<?php
if( !$is_update ) {
  ?>  
  <div class="ajax_overlay" ></div>
  <?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>
  <?php
}
?>

