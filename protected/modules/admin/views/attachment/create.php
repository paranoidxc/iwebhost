<?php
$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Attachment', 'url'=>array('index')),
	array('label'=>'Manage Attachment', 'url'=>array('admin')),
);
?>
<?php
  echo "<div class='mac_panel_wrap' >";
  $this->beginWidget('application.extensions.Smacpanel');
  
  echo "<div class='icategory_tree'>";
  $this->renderPartial('_test_node',array( 'nodes' => $leafs,'return_id' => 'xxx' ) );
  echo "</div>";
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
  $this->endWidget('application.extensions.Smacpanel');
  echo "</div>"
?>