<?php
if( !$is_update ) {
  ?>
  <div class='mac_panel_wrap w600p'>
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>'Edit '.$model->id.' : '.cnSubstr($model->title,0,20)) )
?>
  <?php
}
?>



<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs, 'leaf'  => $model->leaf)); ?>


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

