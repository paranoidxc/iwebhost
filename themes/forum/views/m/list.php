<div class='radius5 mb20P boxshadow newest-node '>  
  <div class="radius5 panel-title ">
	  <h1 class="radius5 ">
	    <a href="/" ><?php echo Yii::app()->name ?></a>
	    &raquo;&nbsp;
      会员列表
	  </h1>	  
	</div>
  <div class="node-memo">
  <form method="post" action="<?php echo url('m/lovem'); ?>">
  <?php
  foreach( $users as $user ) {
  ?>
    <div class="member_wall">
      <p >
        <input type="checkbox" checked name='users[]' value="<?php echo $user->id; ?>"/>
        <input type="checkbox" class="love-sep" name='love_users[]' value="<?php echo $user->id; ?>"/>
        <span class='love' title="喜欢">100</span>
        <a href="<?php echo CController::createUrl('m/index',array('id' => $user->username ) )?>"
         class="" title="<?echo $user->username; ?>"><img src="<?php echo $user->gravatar ?>" alt=""
         width="40" /></a>
      </p>
      <ul>
      <?php
        $color = 	colorfulV();
      foreach( $user->latest5 as $article ){
      ?>
        <li style="background: <?php echo $color; ?>; " >
          <a  href="<?php echo url('t/index', array('id'=>$article->id ) ) ?>" 
          title="<?php echo $article->title; ?>" ><?php echo $article->title ;?></a></li>
      <?php
      }
      ?>
      </ul>
    </div>
 <?php
  }
  ?>
      <div class='clB'></div>
      <p class='iline'></p>
      <input type="checkbox" id="love-all" value="喜欢选择用户" /><label for="love-all" class='csP'>全选/全不选</label>
      <input type="submit" value="喜欢选择用户" />
    </form>
  </div>
</div>

