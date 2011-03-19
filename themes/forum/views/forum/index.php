<?php
  $list = Article::model()->findAll( array('limit' => 20, 'order' => 'create_time desc' ) );
  foreach($list as $inst){
?>
<div class="index_articles_wrap">
  <table style="width: 100%">
    <tr>
      <td class="author_warp">
        <a href="#" class="radius2" title="<?php echo $inst->author->username ?>" >
          <img src="/default_image/<?php echo $inst->author->gravatar ?>" alt="<?php echo $inst->author->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow">&nbsp;</td>
      <td class="boxshadow ar_content_wrap">
        <div class="flR reply_count">
	        <a href="#" class=""><?php echo $inst->reply_count ?></a>
	      </div>	    	      
		    <span class="fs16P lh130S ar_title" >
		      <a href="#" class="radius2"><?php echo $inst->title ?></a>
		    </span>
        <div class="clB h2P"></div>
        <span class="ar_extra">
          <strong><a href="#" class="node"></a></strong>
          <?php echo $inst->leaf->name ?>&nbsp;•&nbsp;          
          <strong><a href="#" class="dark"><?php echo $inst->author->username ?></a></strong>
          &nbsp;•&nbsp;
          <?php echo $inst->pv ?>次点击 &nbsp;•&nbsp; 
          <span title="<?php echo $inst->create_time ?>" class="timeago" ><?php echo $inst->create_time ?></span>
	    </td>
    </tr>
  </table>
</div>
<?php
  }
?>