<?php
	echo "<ul class='api_categorys_ul' id='top_tree' render_url='".CController::createurl('category/leafs', array('ajax' => 'ajax'))."'>";
		$temp_depth = 0;			
		$class="open";
		$handle_class = 'f_'.$class;
		foreach( $nodes as $leaf ) {
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
			  echo '<li class="'.$class.'" >';
        echo '<p style="text-indent: '.$style_text_indent.'" title="'.$name.'"><span class="'.$handle_class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
        echo '<span class="'.$class.'" >&nbsp;&nbsp;</span>';
        echo' <span class="leaf">';    				
			}else if( $depth > $temp_depth ) {
			  echo '<ul><li class="'.$class.'">';
        echo '<p style="text-indent: '.$style_text_indent.'" title="'.$name.'"><span class="'.$handle_class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
        echo '<span class="'.$class.'" >&nbsp;&nbsp;</span>';
        echo '<span class="leaf"  >';    				
			}else if( $depth < $temp_depth ) {
				for($i=0; $i < $temp_depth - $depth ; $i ++ ) {
      	  echo '</li></ul>';
    		}
    		echo '<li class="'.$class.'">';
        echo '<p style="text-indent: '.$style_text_indent.'" title="'.$name.'"><span class="'.$handle_class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
        echo '<span class="'.$class.'" >&nbsp;&nbsp;</span>';
        echo '<span class="leaf">';        		
  		}else if( $depth == $temp_depth ){
    		echo '</li><li class="'.$class.'">';
        echo '<p style="text-indent: '.$style_text_indent.'" title="'.$name.'"><span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
        echo '<span class="'.$class.'" >&nbsp;&nbsp;</span>';
        echo '<span class="leaf">';
  		}  		
			echo $name;
  		echo '</span></p>';  		
  		
  		echo  API::articles(array(
      'type'        => 'obj',
      'obj'         => $leaf,      
      'dom'         => 'ul',
      'text_indent'  => $style_chapters_indent,
      'url'         => 'istart/chapter',
      'url_option'  => array( 'ajax' => 'ajax' )));
  		
  		$temp_depth = $depth;
		}				
		for($i=0; $i < $temp_depth; $i ++ ) {
	  	echo "</li>\r\n</ul>";
		}
		echo "</li>\r\n</ul>";	
?>