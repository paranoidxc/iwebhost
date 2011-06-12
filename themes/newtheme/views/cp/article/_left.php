<ul class='channel_ul'>
  <li><a href="<?php echo url('cp/article/create') ?>"
    class='<?php echo API::isaction('cp/article/create') ?>'>创建文章</a></li>
</ul>

<?php echo $this->renderPartial( '_node',array('nodes' => $leaf_tree),false,true) ?>
