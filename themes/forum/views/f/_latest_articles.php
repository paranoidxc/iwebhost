<!-- latest new articles start -->
<div class="radius5 mb20P p10P boxshadow">
  <p style="line-height: 24px; height: 24px;" class='fwB' >
    最新主题
    <span class="flR dN">• • • • •</span>
  </p>
  <div class='iline mb5P'></div>
<?php
  foreach( $latest_articles as $a ) {
?>
  <p style="line-height: 24px; height: 24px; margin-bottom: 5px;" >
    <img style="vertical-align: bottom; margin-right: 5px;" width='24' src="<?php echo $a->auther->gravatar ?>" />
    <a class='fwB' style="color: <?echo colorfulV() ?>"
    href="<?echo url('t/index', array('id' => $a->id) ) ?>">
    <?php echo (CHtml::encode($a->title)) ?>
    </a>
    <span class="ar_extra">
    &nbsp;•&nbsp;<?php echo $a->pv ?>次点击
    &nbsp;•&nbsp;<?php echo $a->reply_count ?>次回复
    </span>
    <span class='timeago flR' title="<?php echo $a->update_time?>"><?php echo $a->update_time?></span>
  </p>
<?php
  }
?>
</div>
<!-- latest new articles end -->

