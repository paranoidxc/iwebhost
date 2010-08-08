<div  class="board" id="google_board">
  <form action="http://www.google.com/search" method="get" target="_blank">
		<input type="hidden" value="1" name="forid">
		<input type="hidden" value="UTF-8" name="ie">
		<input type="hidden" value="en-US" name="hl">
		<input autocomplete="off" type="text" id="gkw" name="q"> <input type="submit" class="ibtn igsearch" value="Google Search">
  </form>
</div>


<div class="board_wrap">
<?php
	foreach( Category::model()->vleafs('istart',1) as $_leafs ) {		
		if( $_leafs->depth != 0 ) {
?>		
<div class="board">
	<h2><?php echo colorful($_leafs->name); ?></h2>
	<ul>
	<?php				
		foreach( Category::model()->findByPk($_leafs->id)->articles as $obj) {			
			echo "<li>".CHtml::link(
				$obj->title, 
				$obj->subtitle , 
				array( 'title' => $obj->subtitle, 'target' => '_blank','style' => 'color: '.colorfulV().';'  ))."</li>";
		}
	?>
	</ul>
</div>
<?php
	}
}
?>
</div>
<div class=" ta_da_board">
	<h2><?php echo colorful("Ta-da List"); ?><span class="fs10 new_list_ele">new Ta-da list</span></h2>	
	<form class="new_list_form dN" method="POST" action="<?php echo CController::createUrl('istart/Tada');?>">
		<input type="hidden" name="Category[parent_leaf_id]" value="41"/>
		<input type="text" name="Category[name]" id="Category_name" class="ta_name" /><br/>
		<input type="submit" value=" create this list " class="ibtn" />
	</form>
	<ul>
	<?php 
	foreach( Category::model()->vleafs('Ta-da list',1) as $_leafs ) {
		if( $_leafs->depth != 0 ) {
	?>
		<li>
			<p><?php echo colorful($_leafs->name); ?></p>
			<ul>
	<?php			
	foreach( Category::model()->findByPk($_leafs->id)->articles as $obj) {						
		echo "<li>$obj->content</li>";
	}
	?>
			</ul>
		</li>
	<?php
			}
		}
	?>
	</ul>
</div>
