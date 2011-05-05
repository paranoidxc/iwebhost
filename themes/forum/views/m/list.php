<div class='radius5 mb20P boxshadow newest-node '>  
  <div class="radius5 panel-title ">
	  <h1 class="radius5 ">
	    <a href="/" ><?php echo Yii::app()->name ?></a>
	    &raquo;&nbsp;
      会员列表
	  </h1>	  
	</div>
  <div class="node-memo">
  <?php
  foreach( $users as $user ) {
  ?>
    <a href="<?php echo CController::createUrl('m/index',array('id' => $user->username ) )?>"
       class="" title="<?echo $user->username; ?>">
      <img src="<?php echo $user->gravatar ?>" alt=""/>
    </a>
  <?php
  }
  ?>
  </div>
</div>

