<?php
$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'View Article', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs, 'leaf'  => $model->leaf)); ?>