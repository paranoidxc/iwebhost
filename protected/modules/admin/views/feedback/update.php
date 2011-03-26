<?php
if( !$is_update ) {
  ?>
  <div class='mac_panel_wrap w600P'>
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp','Edit Feedback').' <span class="filter radius4">'.$model->id.'</span>') );
?>
  <?php
}
?>
<input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

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