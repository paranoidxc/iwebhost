<?php
$this->breadcrumbs=array(
	'Many Category Users',
);

$this->menu=array(
	array('label'=>'Create ManyCategoryUser', 'url'=>array('create')),
	array('label'=>'Manage ManyCategoryUser', 'url'=>array('admin')),
);
?>

<h1>Many Category Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
