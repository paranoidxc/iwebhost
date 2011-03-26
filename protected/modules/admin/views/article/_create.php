<?php
$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'leafs' => $leafs , 'leaf' => $leaf )); ?>