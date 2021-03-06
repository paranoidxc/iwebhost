<?php $this->beginContent('//layouts/main'); ?>
<div class="">	
  <div class="container clearfix  main_wrap">
    
    <div class="grid9 first">
	    <?php echo $content; ?>
	  </div>
	  
	  <div class="grid3">
	    <div class="radius5 boxshadow side-box">
	      <div class='raidus5top panel-title'>
	        <h1 class="raidus5top">
          <a href="<?php echo url('f/all')?>" title="全部节点" class='flR'>全部</a>
          最新节点</h1>
	      </div>
	      <div class='iline'></div>
	      <div class="p10P">
  	    <?php
  	      $nodes = API::INODE( array( 'ident_label' =>  'forum_node' ) );
  	      foreach( $nodes as $node ){
  	    ?>
    	    <a href="<?php echo CController::createUrl('f/index', array('id' =>$node->urlarg) ) ?>" class='radius2' title="<?php echo $node->name ?>" ><?php echo $node->name ?></a>
  	    <?php 
  	      }
  	    ?>
  	    </div>
	    </div>	    
	    
      <div class="radius5 boxshadow mt20P side-box side-member-box">
	      <div class='raidus5top panel-title'>
	        <h1 class="raidus5top">
          <a href="<?php echo url('m/list')?>" tltle="全部会员" class='flR'>全部</a>
          最近注册会员
          </h1>
        </div>
	      <div class='iline'></div>
	      <div class='p5P ml3P'>
          <?php
            $latest_member = User::model()->findAll( 
                array( 'condition' => 'account_type = 0',
                       'order' => 'c_time DESC',
                       'limit' => '10'  ) );
            foreach( $latest_member as $m ) {
              ?>
              <a href="<?php echo url('m/index', array('id'=>$m->username) ); ?>" title="<?php echo $m->username; ?>" ><img src="<?php echo $m->gravatar; ?>"
                class='mb5P' width='48' alt="<?php echo $m->username;?>" /></a>
              <?php
            }
          ?>
  	    </div>
	    </div><!--最近注册会员-->
	    
	    <div class="radius5 boxshadow mt20P side-box ad-box">
        <div class="ad-tag"></div>	  
	      <div class='p10P'>
  	      <a href="http://shop62908070.taobao.com/" title="磬厘妆品淘宝店" target="_blank">
  	      <img src="/qlzp.jpg" alt="" width="200"/>
  	      </a>
  	    </div>
	    </div>
	  </div>
	  
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>
