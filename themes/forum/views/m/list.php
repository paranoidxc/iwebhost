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
    <div class="flL" style="zoom: 1; overflow: hidden; height: 186px; width: 210px;margin:10px 10px 0 0;border: 1px
    solid #efefef;padding: 2px; ">
      <p style="text-align: right;padding: 0;">
        <span class='flL' style='padding-top: 20px; line-height: 20px;'>100 喜欢</span>
        <a style="margin: 0;padding:0;height:40px;" href="<?php echo CController::createUrl('m/index',array('id' => $user->username ) )?>"
         class="" title="<?echo $user->username; ?>"><img src="<?php echo $user->gravatar ?>" alt=""
         width="40" /></a>
      </p>
      <ul>
      <?php
        $color = 	colorfulV();
      foreach( $user->latest5 as $article ){
      ?>
        <li style="font-weight: normal; overflow: hidden; margin-bottom: 2px; height: 26px; background: <?php echo $color; ?>; color:#FFF; " >
          <a  style="margin: 0; padding: 0;text-indent: 5px; color: #FFF; height: 26px; line-height: 26px; "
          href="<?php echo url('t/index', array('id'=>$article->id ) ) ?>" 
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
  </div>
</div>

