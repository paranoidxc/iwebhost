<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div id="w_left"> 
    <?php echo $this->renderPartial( '_left' ) ?>
  </div>
  
  <div id="w_right">
    <div></div><!-- clear ele for fuck ie -->
    <div id="w_location" >
    Console<?php echo API::rchart();?><a href="<?php echo url('cp/user/index') ?>" >User</a><?php echo API::rchart();?>Update 
# <?php echo $model->id ;?> - <?php echo cnSubstr($model->username,0,20) ?>
    </div>
    
    <div id="w_content">
      <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>

  </div>
</div>
