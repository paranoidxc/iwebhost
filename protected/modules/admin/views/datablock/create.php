<?php
$this->breadcrumbs=array(
	'Datablocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Datablock', 'url'=>array('index')),
	array('label'=>'Manage Datablock', 'url'=>array('admin')),
);
?>

<h1>Create Datablock</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'data_block_tree' => $data_block_tree,'leafs' => $leafs)); ?>