<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div class="dN" id="w_left"> 
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree,'action' => $action ),false,true) ?>
  </div>
  
  <div id="wx_right">
    <div></div><!-- clear ele for fuck ie -->
    <div id="w_location" >
    <span class="control_tree" >类别</span>
    <a href="<?php echo url('/cp/article/'.$action ) ?>" >文章列表</a>
    <?php echo API::rchart();?>
    <a href="<?php echo url('/cp/article/'.$action, array('category_id' => $model->category_id ) ) ?>" ><?php echo $model->leaf->name ?></a><?php echo API::rchart();?>Update 
# <?php echo $model->id ;?> - <?php echo cnSubstr($model->title,0,20) ?>
    </div>
    
    <div id="w_content">
      <?php echo $this->renderPartial('_form',
        array('model'=>$model, 'leafs' => $leafs, 'leaf'  => $model->leaf)); ?>
    </div>

  </div>
</div>

