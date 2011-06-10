<ul class='channel_ul'>
  <li><a href="<?php echo url('cp/user/create') ?>" class='<?php echo API::isaction('cp/user/create') ?>'>创建用户</a></li>
  <li><a href="<?php echo url('cp/user/index?account_type=1') ?>"
    class='<?php echo API::isaction('account_type=1') ?>'>管理员列表</a></li>
  <li><a href="<?php echo url('cp/user/index?account_type=0') ?>"
    class='<?php echo API::isaction('account_type=0') ?>'>普通用户列表</a></li>
</ul>
