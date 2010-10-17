<?php
	  
		$temp_depth = 0;			
		$class="open";
		$handle_class = 'f_'.$class;
		$include = false;		
		foreach( $nodes as $leaf ) {		  
			//$class="fold";
			$handle_class = 'f_'.$class;			
			$id = $leaf->id;
			$depth = $leaf->depth;
			$name = $leaf->name;						
			
			if( $depth == 0 ) {
			  //处理depth 为 0 的第一级
			  echo "<ul>";
			  $include = true;
			  echo '<li class="'.$class.'" >';
        echo '<a href="'.$leaf->url.'" title="'.$name.'">';
			}else if( $depth > $temp_depth ) {
			  //处理下一级别
			  echo '<ul><li class="'.$class.'">';
        echo '<a href="'.$leaf->url.'" title="'.$name.'">';
			}else if( $depth < $temp_depth ) {
			  //下一级别处理完毕, 回到上一级别
				for($i=0; $i < $temp_depth - $depth ; $i ++ ) {
      	  echo '</li></ul>';
    		}
    		echo '<li class="'.$class.'">';
        echo '<a href="'.$leaf->url.'" title="'.$name.'">';           		
  		}else if( $depth == $temp_depth ){
  		  //处理同级
    		echo '</li><li class="'.$class.'">';
        echo '<a href="'.$leaf->url.'" title="'.$name.'">';
  		}  		
			echo $name;
  		echo '</a>';
  		
  		$temp_depth = $depth;
		}				
		for($i=0; $i < $temp_depth; $i ++ ) {
	  	echo "</li>\r\n</ul>";
		}
		echo "</li>\r\n</ul>";	
	if( $include ){
	  echo "</ul>";  
	}	
?>