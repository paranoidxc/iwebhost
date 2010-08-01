<?php
$this->breadcrumbs=array(
	'Datablocks',
);

$this->menu=array(
	array('label'=>'Create Datablock', 'url'=>array('create')),
	array('label'=>'Manage Datablock', 'url'=>array('admin')),
);
?>

<?php	
if( !isset($ajax) ) {
echo "<div class='mac_panel_wrap' >";
$this->beginWidget('application.extensions.Smacpanel');
}
if( count($datas) > 0 ) {
	echo "<ul class='data_block_hir' href='".CController::createurl('datablock/isort')."' >";
	foreach( $datas as $db ) {
		echo "<li id='sort_$db->id' href='".CController::createurl('datablock/hnext', array( 'p_id' => $db->id ) )."' >";
		echo $db->name;
		echo "</li>";
	}
	echo "</ul>";
}
if( !isset($ajax) ) {
	$this->endWidget('application.extensions.Smacpanel');
	echo "</div>";
}
?>
<script type="text/javascript">	
	init_datablock_sort();
</script>