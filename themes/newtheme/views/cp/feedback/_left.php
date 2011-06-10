<ul class='channel_ul'>
  <li><a href="<?php echo url('cp/feedback/create') ?>" class='<?php echo API::isaction('cp/feedback/create') ?>'>新增反馈</a></li>

  <li><a href="<?php echo url('cp/feedback/index?is_answer=0') ?>"
    class='<?php echo API::isaction('cp/feedback/index?is_answer=0') ?>'>未回复反馈列表</a></li>

  <li><a href="<?php echo url('cp/feedback/index?is_answer=1') ?>"
    class='<?php echo API::isaction('cp/feedback/index?is_answer=1') ?>'>已回复反馈列表</a></li>
</ul>
