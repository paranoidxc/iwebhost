<div id="m_middle">
  <?php echo $this->renderPartial( '_left',array('div_id' => 'tree_left','action' => $action, 'leaf_tree' => $leaf_tree),false,true) ?>
  <div id="w_right">  
    <div id="w_location" >  
      <div class='location'>
        <a class='' href="<?php echo getState('back_url'); ?>">返回列表</a>
      </div>
      <span class="control_tree" >栏目类别</span>
      <?php echo $this->renderPartial( '//layouts/_location',array('action' => $action) ) ?>
      <span class='action on'>新建内容</span>
    </div>

    <div id="w_content">
      <?php echo $this->renderPartial('_form', array('model'=>$model,'top_leaf' => $top_leaf, 'leaf' => $leaf ) ); ?>
    </div>

  </div>
</div>
