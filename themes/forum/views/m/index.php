<?php  
?>
<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp pt20P">
        <a href="#">
          <img src="<?php echo $m->gravatar ?>" alt="<?php echo $m->username ?>" />
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
	      <div class="p10P fs14P">
	        <p>
	          第 <?php echo $m->id ?> 号会员 , 加入于 
	          <span class='timeago' title="<?php echo $m->c_time ?>" > <?php echo $m->c_time ?></span>
	        </p>
          <p class='ft14P mt10P lh20P cgray'>
              <?php echo CHtml::encode($m->sign ) ?>
          </p>
	      </div>
        
        <p class='p10P fs14P' ><?php echo CHtml::encode($m->username) ?>最近创建主题</p>
        <div class='iline mb5P'></div>
        <?php
        foreach( $m->articles as $inst ){
        ?>
        <div>
          <p class='pl10P lh20P'>
            <strong>
              <a class='radius2' href="<?php echo CController::createUrl('t/index', array( 'id' => $inst->id) ) ?>" >
              <?php echo CHtml::encode($inst->title) ?>
              </a>
              <span class='ar_extra timeago' title='<?php echo $inst->create_time ?>'>
                <?php echo CHtml::encode($inst->create_time) ?>
              </span>
              <span class='ar_extra'>
                &nbsp;•&nbsp;
                <?php echo CHtml::encode($inst->reply_count) ?> 次回复
              </span>
            <strong>
          </p>
        </div>
        <?php
        }
        ?>
        <div class='mt10P'></div>
	    </td>
    </tr>
  </table>
</div>
