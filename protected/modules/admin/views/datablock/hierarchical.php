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
echo "<ul class='data_block_hir' id='data_block_$p_id' rel_id='$p_id' move_href='".CController::createurl('datablock/imove')."' href='".CController::createurl('datablock/isort')."' >";
if( count($datas) > 0 ) {
	foreach( $datas as $db ) {
		echo "<li id='sort_$db->id' rel_id='$db->id' href='".CController::createurl('datablock/hnext', array( 'p_id' => $db->id ) )."' >";
		echo $db->name;
		echo "</li>";
	}
}else{
	echo "<li>没有子元素</li>";
}

echo "</ul>";

if( !isset($ajax) ) {
	echo "</div>";
	$this->endWidget('application.extensions.Smacpanel');	
}
?>
<script type="text/javascript">	
	init_datablock_sort();
	init_datablock_droppable();
</script>