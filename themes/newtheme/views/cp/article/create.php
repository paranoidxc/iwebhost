<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="m_middle">

  <div class="dN" id="w_left">
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>

    
  <div id="wx_right">  
    <div></div><!-- clear ele for fuck ie -->
    <div id="w_location" > 
    <span class="control_tree" >类别</span>
    <a href="<?php echo url('cp/article/'.$action) ?>" >文章列表</a>
    <?php echo API::rchart();?>
    <a href="<?php echo url('/cp/article/'.$action, array('category_id' => $model->category_id ) ) ?>" ><?php echo $model->leaf->name ?></a><?php echo API::rchart();?>
    Create
    </div>
    
    <div id="w_content">
      <?php echo $this->renderPartial('_form', array('model'=>$model,'top_leaf' => $top_leaf, 'leaf' => $leaf ) ); ?>
    </div>

  </div>
</div>
