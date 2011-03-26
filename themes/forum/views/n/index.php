<div class='radius5 mb20P boxshadow newest-node '>  
  <div class="radius5 panel-title ">
	  <h1 class="radius5 ">
	    <a href="/" ><?php echo Yii::app()->name ?></a>
	    &raquo;&nbsp;
      你的提醒
	  </h1>	  
	</div>
  <div class="node-memo">如果你的发表的主题有其他会员回复的话，这里的提供系统应该会有记录的哦：)</div>
</div>

<?php
  foreach( $notices as $inst ) {
?>
<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp">
        <a href="<?php echo CController::createUrl('m/index' , array('id' => $inst->post->auther->id )) ?>" 
            class="radius2" title="<?php echo $inst->post->auther->username ?>" >
          <img src="<?php echo $inst->post->auther->gravatar ?>" alt="<?php echo $inst->post->auther->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow">&nbsp;</td>
      <td class="boxshadow p10P ar_content_wrap">
		    <span class="fs16P lh130S" >
          <span class="ar_extra">
		      在
          <span title="<?php echo $inst->c_time ?>" class="timeago" ><?php echo $inst->c_time ?></span>
          回复了
          </span>
          <a href="<?php echo CController::createUrl('t/index',array('id' => $inst->article_id)) ?>" 
          class="radius2"><?php echo CHtml::encode($inst->article->title) ?></a>
		    </span>
        <div class="clB h2P"></div>
          <a href="<?php echo CController::createUrl('t/index',array('id' => $inst->article_id) ) ?>" 
          class="fs16P <?php echo $inst->is_read ? 'read' : 'unread' ?>"><?php echo cnSub( strip_tags($inst->post->content), 26 ) ?></a>
	    </td>
    </tr>
  </table>
</div>
<?php
  }
