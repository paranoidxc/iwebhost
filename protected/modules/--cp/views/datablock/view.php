<?php
$this->breadcrumbs=array(
	'Datablocks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Datablock', 'url'=>array('index')),
	array('label'=>'Create Datablock', 'url'=>array('create')),
	array('label'=>'Update Datablock', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Datablock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Datablock', 'url'=>array('admin')),
);
?>

<h1>View Datablock #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'p_id',
		'type',
		'rel_value',
		'template',
		'sort_id',
	),
)); ?>
