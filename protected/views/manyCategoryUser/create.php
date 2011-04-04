<?php
$this->breadcrumbs=array(
	'Many Category Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ManyCategoryUser', 'url'=>array('index')),
	array('label'=>'Manage ManyCategoryUser', 'url'=>array('admin')),
);
?>

<h1>Create ManyCategoryUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>