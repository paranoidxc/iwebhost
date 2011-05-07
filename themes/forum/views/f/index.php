
<?php 
  if( $node ){
?>
<div class='radius5 mb20P boxshadow newest-node '>  
  <div class="radius5 panel-title ">
	  <h1 class="radius5 ">
	    <a href="/" ><?php echo Yii::app()->name ?></a>
	    &raquo;&nbsp;
	    <?php echo $node->name ?>
      <?php 
        if( !User()->isGuest &&  $node->islove ) {
      ?>
        <a class='radius2 nodelove' href="<?php echo url('m/unlove', array('f' => $node->id)  ) ?>"
        title="取消收藏" >取消收藏</a>
      <?php
        }else if( !User()->isGuest ) {
      ?>
        <a class='radius2 nodeunlove' href="<?php echo url('m/love', array('f' => $node->id)  ) ?>"
        title="收藏" >收藏</a>
      <?php
      }
      ?>
	    <?php if( !Yii::app()->user->isGuest ) {
	      ?>
	      <a class="flR radius2 new-ar" href="<?php echo CController::createUrl('t/create', array('f' => $node->id) )?>">新主题</a>
  	    <?php
	    }?>
	  </h1>	  
	</div>
  <div class="node-memo"><?php echo nl2br($node->memo) ?></div>
</div>
<?
  } else {
  ?>
  <?php
  }
?>
  
<?php  
  if(count($articles) == 0){    
?>
<div class="radius5 boxshadow newest_node p10P note">  
  <p>该节点下还没有主题哦,没有主题哦~:)</p>
</div>
<?php    
  }else{
    //<!-- include latest new articles  -->
    if( count($latest_articles) != 0 ){
      $this->renderPartial('_latest_articles', array('latest_articles' => $latest_articles ) );
    }
  }
?>

<?php  
  foreach($articles as $inst){
?>

<div class="index_articles_wrap">  
  <a href="<?php echo url('m/index' , array('id' => $inst->auther->username )) ?>" 
     class="author_wrap" title="<?php echo $inst->auther->username ?>" >
     <img src="<?php echo $inst->auther->gravatar ?>" alt="<?php echo $inst->auther->username ?>" />
  </a>
  <div class='item_box'>  
    <div class="item_top"></div>
    <div class="item_arrow"></div>
    <div class='item_content'>
      <div class="flR reply_count">
	      <a href="<?php echo url('t/index', array('id' => $inst->id,'#' => $inst->reply_count ) ) ?>" class=""><?php echo $inst->reply_count ?></a>
	    </div>	    	
      <p class="fs16P lh130S item_ar_title" >
		    <a href="<?php echo url('t/index',array('id' => $inst->id)) ?>" 
           class="radius2"><?php echo CHtml::encode($inst->title) ?></a>
		  </p>
      <p class="item_ar_extra">
        <strong>
          <a href="<?php echo url('f/index', array( 'id' => $inst->leaf->id) ) ?>" 
          class="raidus"><?php echo $inst->leaf->name ?></a>
        </strong>&nbsp;•&nbsp;
        <strong>
          <a href="<?php echo url('m/index' , array('id' => $inst->auther->username )) ?>" 
          class="dark"><?php echo $inst->auther->username ?></a>
        </strong>&nbsp;•&nbsp;
        <?php echo $inst->pv ?>次点击&nbsp;•&nbsp; 
        <span title="<?php echo $inst->create_time ?>" class="timeago" ><?php echo $inst->create_time ?></span>
      </p>
    </div><!-- item_content end-->
    <div class='item_bottom'></div>
  </div><!-- item_box end -->
</div><!-- index_articles_wrap end -->
<?php
  }
?>
