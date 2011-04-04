<?php
$this->breadcrumbs=array(
	'Many Category Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ManyCategoryUser', 'url'=>array('index')),
	array('label'=>'Create ManyCategoryUser', 'url'=>array('create')),
	array('label'=>'View ManyCategoryUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ManyCategoryUser', 'url'=>array('admin')),
);
?>

<h1>Update ManyCategoryUser <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>