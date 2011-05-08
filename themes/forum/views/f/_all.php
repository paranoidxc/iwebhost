<div class='radius5 mb20P boxshadow newest-node '>  
  <div class="radius5 panel-title ">
	  <h1 class="radius5 ">
	    <a href="/" ><?php echo Yii::app()->name ?></a>
	    &raquo;&nbsp;
      全部节点
	  </h1>	  
	</div>
  <div class="node-memo">
    <?php
    echo "<ul>";
      $temp_depth = 0;			
      foreach($nodes as $leaf) {
			  $id = $leaf->id;
			  $depth = $leaf->depth;
			  $name = $leaf->name;	
        if( $depth == 0 ) {
          echo '<li>';
	      }else if( $depth > $temp_depth ) {
          echo '<ul class="ml20P"><li>';
	      }else if( $depth < $temp_depth ) {
          for($i=0; $i < $temp_depth - $depth ; $i ++ ) {
      	    echo '</li></ul>';
    		  }
          echo '<li>';
        }else if( $depth == $temp_depth ) {	
          echo '</li><li>';
        }
        ?>  
        <span class='radius2 nodelove' title="取消收藏" >&nbsp;&nbsp;&nbsp;</span>
        <?php
        echo $name;
        echo '('.$leaf->forumarticlesCount.')';
        $temp_depth = $depth;
      }
      for($i=0; $i < $temp_depth; $i ++ ) {
	  	  echo "</li>\r\n</ul>";
		  }
		  echo "</li>\r\n</ul>";	
    ?>
  </div>
</div>


