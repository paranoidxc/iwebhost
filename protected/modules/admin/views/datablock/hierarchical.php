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
echo "<div class='osX' >";
echo "<div style='width: 700px; height: 400px; overflow: scroll; ' id='hir_wrap'>";
echo "<div style='width: 12000px; height: 500px; ' >";
}
echo "<ul class='data_block_hir' id='data_block_$p_id' rel_id='$p_id' move_href='".CController::createurl('datablock/imove')."' href='".CController::createurl('datablock/isort')."' >";
echo "<h2 class='ibtn' create_href ='".CController::createurl('datablock/create', array('ajax' => 'ajax' ,'p_id' => $p_id) )."' >Datablock <span>+</span></h2>";
if( count($datas) > 0 ) {
	foreach( $datas as $db ) {
		echo "<li id='sort_$db->id'  edit_href='".CController::createurl('datablock/update', array('ajax' =>'ajax',  'id' => $db->id ) )."' rel_id='$db->id' href='".CController::createurl('datablock/hnext', array( 'p_id' => $db->id ) )."' >";		
		//echo '<a href="#">';
		echo '<span class="handle">&nbsp;&nbsp;</span>';
		echo '<span class="block_ele" >'.$db->name.'</span>';
		//echo '</a>';
		echo "</li>";
	}
	echo "<li class='temp' style='display: none'>没有子元素</li>";
}else{
	echo "<li class='temp'>没有子元素</li>";
}

echo "</ul>";

if( !isset($ajax) ) {
	echo "</div>";	
	echo "</div>";	
	echo "</div>";	
	$this->endWidget('application.extensions.Smacpanel');	
	echo "</div>";
}
?>
<script type="text/javascript">	
	init_datablock_sort();
	init_datablock_droppable();
</script>
