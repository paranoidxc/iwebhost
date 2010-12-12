<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>'Edit Content ID:'.$model->id.' - Name: '.cnSubstr($model->title,0,20)) )
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs, 'leaf'  => $model->leaf)); ?>
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>