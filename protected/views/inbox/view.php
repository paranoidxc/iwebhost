<?php
$this->breadcrumbs=array(
	'Inboxes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Inbox', 'url'=>array('index')),
	array('label'=>'Create Inbox', 'url'=>array('create')),
	array('label'=>'Update Inbox', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Inbox', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Inbox', 'url'=>array('admin')),
);
?>

<h1>View Inbox #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'source_id',
		'dest_id',
		'memo',
		'c_time',
		'parent_id',
	),
)); ?>
