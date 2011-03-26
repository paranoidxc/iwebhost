<?php 
  if( $node ){
?>
<div class='radius5 mb20P boxshadow newest-node '>  
  <div class="radius5 panel-title ">
	  <h1 class="radius5 ">
	    <a href="/" ><?php echo Yii::app()->name ?></a>
	    &raquo;&nbsp;
	    <?php echo $node->name ?>
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
  }
?>


<?php  
  foreach($articles as $inst){
?>
<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp">
        <a href="<?php echo CController::createUrl('m/index' , array('id' => $inst->auther->id )) ?>" 
            class="radius2" title="<?php echo $inst->auther->username ?>" >
          <img src="<?php echo $inst->auther->gravatar ?>" alt="<?php echo $inst->auther->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow">&nbsp;</td>
      <td class="boxshadow p10P ar_content_wrap">
        <div class="flR reply_count">
	        <a href="#" class=""><?php echo $inst->reply_count ?></a>
	      </div>	    	      
		    <span class="fs16P lh130S ar_title" >
		      <a href="<?php echo CController::createUrl('t/index',array('id' => $inst->id)) ?>" class="radius2"><?php echo CHtml::encode($inst->title) ?></a>
		    </span>
        <div class="clB h2P"></div>
        <span class="ar_extra">
          <strong><a href="<?php echo CController::createUrl('f/index', array( 'id' => $inst->leaf->id) ) ?>" class="raidus"><?php echo $inst->leaf->name ?></a></strong>
          &nbsp;•&nbsp;
          <strong><a href="<?php echo CController::createUrl('m/index' , array('id' => $inst->auther->id )) ?>" class="dark"><?php echo $inst->auther->username ?></a></strong>
          &nbsp;•&nbsp;
          <?php echo $inst->pv ?>次点击 
          &nbsp;•&nbsp; 
          <span title="<?php echo $inst->create_time ?>" class="timeago" ><?php echo $inst->create_time ?></span>
	    </td>
    </tr>
  </table>
</div>
<?php
  }
?>
