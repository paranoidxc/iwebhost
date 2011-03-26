<div class='mac_panel_wrap w600P' >
<input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp',"Create Feedback")) )
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<div class="ajax_overlay" ></div>
<?php
  $this->endWidget('application.extensions.Flatmacpanel');
?>
</div>