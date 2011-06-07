<?php
$this->breadcrumbs=array(
	'Inboxes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Inbox', 'url'=>array('index')),
	array('label'=>'Create Inbox', 'url'=>array('create')),
	array('label'=>'View Inbox', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Inbox', 'url'=>array('admin')),
);
?>

<h1>Update Inbox <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>