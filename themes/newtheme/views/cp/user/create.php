<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>

<div id="m_middle">

  <div id="w_left">
    <?php echo $this->renderPartial( '_left' ) ?>
  </div>

    
  <div id="w_right">  
    <div></div><!-- clear ele for fuck ie -->
    <div id="w_location" >
    Console<?php echo API::rchart();?><a href="<?php echo url('cp/user/index') ?>" >User</a><?php echo API::rchart();?>Create
    </div>
    
    <div id="w_content">
      <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>

  </div>
</div>
