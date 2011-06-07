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
	          <a href="<?php echo url('ib/index') ?>" class="radius2">私信</a>
	        </h1>
	      </div>
        <div class='iline'></div>        
        
        <p class='p10P fs14P mail_wrap' >
          <span class='mail_tab'>
            <a href="<?php echo url('ib/index') ?>">收信箱</a>
            <?php 
              if( ($_t_unread_inbox_count = $m->unread_inbox_count) > 0 ) {
            ?>
            <span class='mail_not inbox_not'><?php echo $_t_unread_inbox_count ?></span>
            <?php 
              }
            ?>
          </span>
          <span class='mail_tab'>
            发信箱 
            <?php
              if( ($_t_unread_outbox_count = $m->unread_outbox_count) > 0 ) {
            ?>
            <span class='mail_not outbox_not'><?php echo $_t_unread_outbox_count?></span>
            <?php
              }
            ?>
          </span>
        </p>
        <div class='iline mb5P'></div>
        <table>
        <?php
        foreach( $mails as $mail ){
        ?>
        <tr style="">
            <th class='vaT w50P pl10P' style="border-right: 5px solid #093;">
              <a href="<?php echo url('m/index', array('id' => $mail->dest->username) ) ?>"
                  style="width: 40px"><img width="40" src="<?php echo $mail->dest->gravatar ?>"
              alt="" title="<?php echo $mail->dest->username; ?>" /></a>
            </th>
            <td class='pl10P vaT mail_tab'>
              <p class='timeago' title='<?php echo $mail->c_time ?>'>
                <?php echo CHtml::encode($mail->c_time) ?>
              </p>
              <?php 
              if( ($_t_mail_unread_outbox_count = $mail->unread_outbox_count) > 0 ) {
              ?>
              <span class='outbox_not l_inbox_not'><?php echo $_t_mail_unread_outbox_count ?></span>
              <?php 
              }
              ?>
              <a class='fs14P' href="<?php echo url('ib/v', array( 'id' => $mail->id) ) ?>" ><?php echo
              cnSub($mail->memo,28) ?></a>
           </td>
         </tr>
         <tr style="height: 1px">
         </tr>
        <?php
        }
        ?>
        </table>
        <div class='mt10P'></div>
	    </td>
    </tr>
  </table>
</div>
