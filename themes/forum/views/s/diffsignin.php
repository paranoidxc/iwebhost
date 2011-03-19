<div class="iform radius5 boxshadow newest-node " >
  <h1 class='raidus5top panel-title' >
    <a href="/" class="radius2" ><?php echo Yii::app()->name ?></a>&raquo;&nbsp;    
    ...
  </h1>
  <div class='p10P note'>
    <h2>您已经使用用户名为 <?php echo Yii::app()->user->name ?> 的帐号登录系统,
    <a href="<?php echo CController::createUrl('s/signout',array('rurl' => 's/signin' ) ) ?>" class="radius2">换个帐号?</a></h2>
  </div>
</div>