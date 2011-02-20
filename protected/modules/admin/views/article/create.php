<div class='mac_panel_wrap w800P' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp','Create Article'))  )
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs , 'leaf' => $leaf ,'panel_ident' => $panel_ident) ); ?>
<div class="ajax_overlay" ></div>
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>