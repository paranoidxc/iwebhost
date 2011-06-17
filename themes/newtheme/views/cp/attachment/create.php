<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>

<div id="m_middle">

  <div id="w_left" class='w_left'>
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree,'action' => $action),false,true) ?>
  </div>

    
  <div id="w_right">  
    <div></div><!-- clear ele for fuck ie -->
    <div id="w_location" > 
    <span class="control_tree" >类别</span>
    <a href="<?php echo url('cp/article/'.$action) ?>" >文章列表</a>
    <?php echo API::rchart();?>
    <?php echo $cur_leaf->name ?>
    <?php echo API::rchart();?>
    Create
    </div>
    
    <div id="w_content">
      <?php
      foreach( $list as $inst ) {
      ?>
        <img src="<?php echo $inst->thumb ?>" />
      <?php
      }
      ?>
      <?php echo $this->renderPartial('_form', array('cur_leaf'=>$cur_leaf)); ?>
    </div>

  </div>
</div>

