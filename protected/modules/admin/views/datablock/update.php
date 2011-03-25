<?php
$this->breadcrumbs=array(
	'Datablocks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Datablock', 'url'=>array('index')),
	array('label'=>'Create Datablock', 'url'=>array('create')),
	array('label'=>'View Datablock', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Datablock', 'url'=>array('admin')),
);
?>

<h1>Update Datablock <?php echo $model->id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,'data_block_tree' => $data_block_tree,'leafs' => $leafs)); ?>