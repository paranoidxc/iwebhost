<?php
if( !$is_update ) {
  ?>
  <div class='mac_panel_wrap w600P' >
  <input type="hidden" class="return_panel" value="<?php echo $panel_ident;?>" />
<?php  
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp','Update Node').' <span class="filter radius4"> '.$model->id.'</span> '. $model->name) )
?>
  <?php
}
?>


<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs, 'model_type' => $model_type)); ?>

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