<?php
	echo "<ul class='api_categorys_ul' id='top_tree' render_url='".CController::createurl('category/leafs', array('ajax' => 'ajax'))."'>";
		$temp_depth = 0;			
		$class="fold";
		$class="open";
		$handle_class = 'f_'.$class;
    $odd_even = array('odd', 'even');
    $odd_even_count  = 1;
		foreach( $nodes as $leaf ) {
      $odd_even_index = $odd_even_count%2;
      $odd_even_count ++;
			//$class="fold";
			$handle_class = 'f_'.$class;
			
			$id = $leaf->id;
			$depth = $leaf->depth;
			$name = $leaf->name;
			
			$style_text_indent = (10*$depth+10).'px';
			$style_chapters_indent =(10*$depth+10+32).'px';
			
			if( $leaf->lft +1 == $leaf->rgt ) {
				$handle_class = 'stand';
			}
			if( $depth == 0 ) {
			  echo '<li class="'.$class.'" data_id="'.$leaf->id.'" >';
        echo '<p 
              class="'.$odd_even[$odd_even_index].'" return_id="'.$return_id.'" rel_id="'.$leaf->id.'" rel_name="'.$leaf->name.'"
              style="text-indent: '.$style_text_indent.'" title="'.$id.'-'.$name.'"><span class="'.$handle_class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
        echo '<span class="'.$class.'"  >&nbsp;&nbsp;</span>';
        echo' <span class="leaf" data_id="'.$id.'" >';    				
			}else if( $depth > $temp_depth ) {
			  echo '<ul class="'.$class.' category_sortable">';
			  echo '<li class="'.$class.'" data_id="'.$leaf->id.'" >';
        echo '<p 
              class="'.$odd_even[$odd_even_index].'" return_id="'.$return_id.'" rel_id="'.$leaf->id.'" rel_name="'.$leaf->name.'"
              style="text-indent: '.$style_text_indent.'" title="'.$id.'-'.$name.'"><span class="'.$handle_class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
        echo '<span class="'.$class.'" >&nbsp;&nbsp;</span>';
        echo '<span class="leaf"  data_id="'.$id.'" >';    				
			}else if( $depth < $temp_depth ) {
				for($i=0; $i < $temp_depth - $depth ; $i ++ ) {
      	  echo '</li></ul>';
    		}
    		echo '<li class="'.$class.'" data_id="'.$leaf->id.'" >';
        echo '<p 
           class="'.$odd_even[$odd_even_index].'" return_id="'.$return_id.'" rel_id="'.$leaf->id.'" rel_name="'.$leaf->name.'"
           style="text-indent: '.$style_text_indent.'" title="'.$id.'-'.$name.'"><span class="'.$handle_class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
        echo '<span class="'.$class.'" >&nbsp;&nbsp;</span>';
        echo '<span class="leaf" data_id="'.$id.'" >';        		
  		}else if( $depth == $temp_depth ){
    		echo '<li class="'.$class.'" data_id="'.$leaf->id.'" >';
        echo '<p 
                class="'.$odd_even[$odd_even_index].'" return_id="'.$return_id.'" rel_id="'.$leaf->id.'" rel_name="'.$leaf->name.'"
                style="text-indent: '.$style_text_indent.'" title="'.$id.'-'.$name.'"><span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
        echo '<span class="'.$class.'" >&nbsp;&nbsp;</span>';
        echo '<span class="leaf" data_id="'.$id.'" >';
  		}  		
			echo $name;
  		echo '</span></p>';  		
  		
  		$temp_depth = $depth;
		}				
		for($i=0; $i < $temp_depth; $i ++ ) {
	  	echo "</li>\r\n</ul>";
		}
		echo "</li>\r\n</ul>";	
?>
