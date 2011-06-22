<div id="m_middle">
  <?php echo $this->renderPartial( '_left',array('div_id' => 'tree_left','action' => $action, 'leaf_tree' => $leaf_tree),false,true) ?>
  <div id="w_right">  
    <div id="w_location" > 
      <div class="location">
        <span class="control_tree" >栏目类别</span>
        <a href="<?php echo url('/cp/article/'.$action ) ?>" >文章列表</a>
        <?php echo API::rc();?>
        <a href="<?php echo url('/cp/article/'.$action, array('category_id' => $model->category_id )
        ) ?>" ><?php echo $model->leaf->name ?></a><?php echo API::rc();?>
      </div>
      <span class='action on'>新建内容</span>
    </div>

    <div id="w_content">
      <?php echo $this->renderPartial('_form', array('model'=>$model,'top_leaf' => $top_leaf, 'leaf' => $leaf ) ); ?>
    </div>

  </div>
</div>
