<div id="w_middle">
  <div id="tree_left" class='dN'>
  <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree,'action' => $action ),false,true) ?>
  </div>
  <div id="w_right">
    <div id="w_location" >
      <div class="lhn-section-primary" style="float: left">
        <span class="control_tree" >类别</span>
        <a href="<?php echo url('/cp/article/'.$action ) ?>" >文章列表</a>
        <?php echo API::rchart();?>
        <a href="<?php echo url('/cp/article/'.$action, array('category_id' => $model->category_id ) ) ?>" ><?php echo $model->leaf->name ?></a><?php echo API::rchart();?>Update 
# <?php echo $model->id ;?> - <?php echo cnSubstr($model->title,0,20) ?>
      </div>
    </div><!-- w_location end -->
    
    <?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>

    <div id="w_content">
      <?php echo $this->renderPartial( '_adv_search',array('keyword' => $keyword),false,true) ?>
      <?php echo $this->renderPartial('_form', array('model'=>$model,'top_leaf' => $top_leaf, 'leafs' => $leafs, 'leaf'  => $model->leaf)); ?>
    </div><!-- w_content end -->

  </div><!-- w_right end -->
</div>
