<?php
$this->breadcrumbs=array(
	'Many Category Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ManyCategoryUser', 'url'=>array('index')),
	array('label'=>'Create ManyCategoryUser', 'url'=>array('create')),
	array('label'=>'Update ManyCategoryUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ManyCategoryUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ManyCategoryUser', 'url'=>array('admin')),
);
?>

<h1>View ManyCategoryUser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'category_id',
		'user_id',
		'id',
	),
)); ?>
