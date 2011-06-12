<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="m_middle">

  <div class="dN" id="w_left">
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>

    
  <div id="wx_right">  
    <div></div><!-- clear ele for fuck ie -->
    <div id="w_location" > 
    <span class="control_tree" >类别</span>
    <a href="<?php echo url('cp/article/index') ?>" >文章列表</a><?php echo API::rchart();?>Create
    </div>
    
    <div id="w_content">
      <?php echo $this->renderPartial('_form',
        array('model'=>$model, 'leafs' => $leafs , 'leaf' => $leaf ,'panel_ident' => $panel_ident) ); ?>
    </div>

  </div>
</div>
