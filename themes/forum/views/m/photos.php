<ul>
<?php foreach($photos as $p) { ?>
  <li href='<?php echo $p->large ?>'
      name='<?php echo $p->screen_name ?>' >
    <img src='<?php echo $p->thumb; ?>' />
    <span><?php echo $p->screen_name ?></span>
  </li>
<?php } ?>
</ul>
<div class='clB'></div>

<div class="bgTips p5P">
  <?php $this->renderPartial('_upload'); ?>
</div>
<div class='clB'></div>
