<?php
$this->breadcrumbs=array(
	'Datablocks',
);

$this->menu=array(
	array('label'=>'Create Datablock', 'url'=>array('create')),
	array('label'=>'Manage Datablock', 'url'=>array('admin')),
);
?>

<h1>Datablocks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
