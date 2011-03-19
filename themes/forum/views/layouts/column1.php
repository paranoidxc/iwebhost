<?php $this->beginContent('//layouts/main'); ?>
<div class="">	
  <div class="container clearfix  main_wrap">
    
    <div class="grid9 first">
	    <?php echo $content; ?>
	  </div>
	  
	  
	  <div class="grid3">
	    <div class="radius5 boxshadow newest-node">
	      <div class='raidus5top panel-title'>
	        <h1 class="raidus5top">最新节点</h1>
	      </div>
	      <div class='iline'></div>
	      <div class="p10P">
  	    <?php
  	      $nodes = Category::model()->findall( array('limit' => 10 , 'order' => 'create_time desc ') );
  	      foreach( $nodes as $node ){
  	    ?>
    	    <a href="#" class='radius2' title="<?php echo $node->name ?>" ><?php echo $node->name ?></a>
  	    <?php 
  	      }
  	    ?>
  	    </div>
	    </div>	    
	    
	    <div class="radius5 boxshadow p10P mt20P newest-node ">
	      AD:<a href="http://shop62908070.taobao.com/" title="磬厘妆品淘宝店." target="_blank">磬厘妆品淘宝店</a>
	    </div>
	  </div>
	  
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>