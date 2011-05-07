<div class='photos'>
  <ul class='pul'>
  <?php foreach($photos as $p) { ?>
    <li>
      <a href="<?php echo $p->image ?>" target="_blank" title='打开大图'><img src='<?php echo $p->thumb; ?>' /></a>
      <span href='<?php echo $p->large ?>' name='<?php echo $p->screen_name ?>' title='添加到内容'><?php echo $p->screen_name ?></span>
    </li>
<?php } ?>
  </ul>

  <div class="clB ipagination taR">
   <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
  </div>
</div>
