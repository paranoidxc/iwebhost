<?php  
?>
<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp pt20P">
        <a href="#">
          <img src="/default_image/<?php echo $m->gravatar ?>" alt="<?php echo $m->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow t_ar_arrow">&nbsp;</td>
      <td class="boxshadow ar_content_wrap newest-node">
        <div class="radius5top">
	        <h1 class="raidus5top panel-title">	          
	          <a href="/" class="radius2"><?php echo Yii::app()->name ?></a>
	          &raquo;&nbsp;
	          <a href="<?php echo CController::createUrl('m/list') ?>" class="radius2">会员</a>
	          &raquo;&nbsp;
	          <?php echo $m->username ;?>
	        </h1>
	      </div>
        <div class='iline'></div>        
	      <div class="p10P">
	        <p>
	          第 <?php echo $m->id ?>号会员 , 加入于 
	          <span class='timeago' title="<?php echo $m->c_time ?>" > <?php echo $m->c_time ?></span>
	        </p>
	        
	      </div>
	    </td>
    </tr>
   
  </table>
</div>