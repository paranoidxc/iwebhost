<div id="w_middle">
  <?php echo $this->renderPartial( '_left',array('div_id' => 'tree_left', 'leaf_tree' => $leaf_tree,'action' => $action ),false,true) ?>
  <div id="w_right">
    <div id="w_location" >
    
      <span class="control_tree" >栏目类别</span>
      <?php echo $this->renderPartial( '//layouts/_location',array('action' => $action) ) ?>

      <div class="location dN">
        <span class="control_tree" >栏目类别</span>
        <a href="<?php echo url('/cp/article/'.$action ) ?>" >文章列表</a>
        <?php echo API::rc();?>
        <a href="<?php echo url('/cp/article/'.$action, array('category_id' => $model->category_id )
        ) ?>" ><?php echo $model->leaf->name ?></a><?php echo API::rc();?>
      </div>

      <span class='action on'>编辑内容 # <?php echo $model->id ;?> - <?php echo cnSubstr($model->title,0,20) ?></span>
    </div><!-- w_location end -->
    
    <?php //echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>

    <div id="w_content">
      <?php echo $this->renderPartial( '_adv_search',array('keyword' => $keyword),false,true) ?>
      <?php echo $this->renderPartial('_form', array('model'=>$model,'top_leaf' => $top_leaf, 'leafs' => $leafs, 'leaf'  => $model->leaf)); ?>
    </div><!-- w_content end -->

  </div><!-- w_right end -->
</div>
