<div class='radius5 mb20P boxshadow newest-node '>  
  <div class="radius5 panel-title ">
	  <h1 class="radius5 ">
	    <a href="/" ><?php echo Yii::app()->name ?></a>
	    &raquo;&nbsp;
      我收藏的节点
	  </h1>	  
	</div>
  <div class="node-memo">
  <ul>
  <?php
  foreach( $user->love_nodes as $node ) {
  ?>
    <li>
    <span class='radius2 gray ar_extra '><?php echo $node->forumarticlesCount ?> topics</span>
    <a href="<?php echo url('f/index', array('id' => $node->id ) ) ?>" class='radius2'><?php echo $node->name ?></a>
    <span class='ar_extra'>
    •
    <a href="<?php echo url( 'm/unlove',array('f' => $node->id ) ) ?>" class='radius2'>取消收藏</a>
      </span>
    </li>

  <?php
  }
  ?>
  <ul>
  </div>
</div>

