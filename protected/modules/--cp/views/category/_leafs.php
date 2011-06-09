<?php
//echo '<div id="tree_splitter" style="width: 300px; border: 2px solid red;">';
//echo '<div id="tree_root">';
		echo "<ul class='tree' id='top_tree' render_url='".CController::createurl('category/leafs', array('ajax' => 'ajax'))."'>";
		$temp_depth = 0;			
		$class="open";
		$handle_class = 'f_'.$class;
		foreach( $leafs as $leaf ) {
			$class="fold";
			$handle_class = 'f_'.$class;
			$id = $leaf->id;
			$name = $leaf->name;
			$depth = $leaf->depth;
			if( $leaf->lft +1 == $leaf->rgt ) {
				$handle_class = '';
			}
			if( $depth == 0 ) {
				echo '<li class="'.$class.' handle" data_id="'.$id.'">';
  		  	//	echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
  		  		echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
   				//echo '<span class="'.$class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
   				echo' <span class="leaf" data_id="'.$id.'" sort_url="'.CController::createUrl('category/sort').'">';
			}else if( $depth > $temp_depth ) {
				echo '<ul><li class="'.$class.' handle" data_id="'.$id.'">';
    			echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
    			//echo '<span class="'.$class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';    			
    			echo' <span class="leaf" data_id="'.$id.'" sort_url="'.CController::createUrl('category/sort').'">';
			}else if( $depth < $temp_depth ) {
				for($i=0; $i < $temp_depth - $depth ; $i ++ ) {
      				echo '</li></ul>';
    			}
    			echo '<li class="'.$class.' handle" data_id="'.$id.'">';
    			echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
    			//echo '<span class="'.$class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';    			
    			echo' <span class="leaf" data_id="'.$id.'" sort_url="'.CController::createUrl('category/sort').'">';
  			}else if( $depth == $temp_depth ){
    			echo '</li><li class="'.$class.' handle" data_id="'.$id.'">';
    			echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
    			//echo '<span class="'.$class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';    			
    			echo' <span class="leaf" data_id="'.$id.'" sort_url="'.CController::createUrl('category/sort').'">';
  			}
			echo $name;
  			echo '</span>';
  			//echo ' <a href="?r=admin/category/create&leaf_id='.$id.'" target="_self">A</a>';
  			//echo ' <a class="view_ele" data="'.$id.'" href="?r=admin/category/view&id='.$id.'" target="_self">V</a>';
 			//echo ' <a href="?r=admin/category/delete&id='.$id.'" target="_self">D</a> ';
  		$temp_depth = $depth;
		}
		
		
		for($i=0; $i < $temp_depth; $i ++ ) {
	  	echo "</li>\r\n</ul>";
		}
		echo "</li>\r\n</ul>";					

//echo '</div>';
//echo '</div>';
?>