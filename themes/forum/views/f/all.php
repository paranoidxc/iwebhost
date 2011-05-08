<div class='radius5 mb20P boxshadow newest-node '>  
  <div class="radius5 panel-title ">
	  <h1 class="radius5 ">
	    <a href="/" ><?php echo Yii::app()->name ?></a>
	    &raquo;&nbsp;
      全部节点
	  </h1>	  
	</div>
  <div class="node-memo">
    <form action="<?php echo url('f/love'); ?>" method="post">
    <ul>
    <?php
      $temp_depth = 0;			
      foreach($nodes as $node) {
			  $depth = $node->depth;
        $margin_left = 20*($depth-1).'px';
        $margin_left = $margin_left == '0px' ? '5px': $margin_left;
        echo '<li class="clB">';
        if( !User()->isGuest ){
        ?>
          <input type="checkbox" class='love-sep' value="<?php echo $node->id; ?>" name='nodes[]' <?php echo $node->islove ? 'checked' :'' ?> />
        <?php
        }

        echo '<span style="float: right;" >';
        echo $node->forumarticlesCount;
        echo '</span>';

        echo "<span class='radius2 ";
        echo $node->islove ? 'nodelove':'nodeunlove';
        echo "' >&nbsp;&nbsp;&nbsp;</span>";
        echo '<span style="margin-left:'.$margin_left.'">';
        echo $node->name;
        echo '</span>';
        echo '</li>';
      }
    ?>
    </ul> 
    <?php 
    if( !User()->isGuest ){
    ?> 
    <p class='iline'></p>
    <input type="checkbox" id="love-all"/><label for="love-all" class='csP'>全选/全不选</label>&nbsp;
    <input type="submit" value="收藏选中节点" />
    <?php 
    }
    ?> 
    </form>
  </div>
</div>
