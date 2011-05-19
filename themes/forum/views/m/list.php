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
    <div class="member_wall <?php echo $user->isJiQing() ? 'member_jiqing' :'' ?>">
      <p >
        <?php 
          if( !User()->isGuest ){
        ?>
        <input type="hidden" name='users[]' value="<?php echo $user->id; ?>"/>
        <input  type="checkbox" class="love-sep" name='love_users[]' 
                <?php echo $user->isAccept() ? "checked" :''?>
                value="<?php echo $user->id; ?>"/>
        <?php 
          }
        ?>
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
      <?php 
        if( !User()->isGuest ){
      ?>
      <input type="checkbox" id="love-all" value="喜欢选择用户" />
      <label for="love-all" class='csP'>全选/全不选</label>
      <input type="submit" value="喜欢选择用户" />
      <?php
        }
      ?>
    </form>
  </div>
</div>
