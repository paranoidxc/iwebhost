<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div id="w_left"> 
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>
  
  <div id="w_right">
    <div></div><!-- clear ele for fuck ie -->
    <div id="w_location" >
    Console<?php echo API::rchart();?><a href="<?php echo url('/cp/Article/index') ?>"
    >Article</a><?php echo API::rchart();?><a href="<?php echo url('/cp/article/index',
    array('category_id' => $model->category_id ) ) ?>" ><?php echo $model->leaf->name ?></a><?php echo API::rchart();?>Update 
# <?php echo $model->id ;?> - <?php echo cnSubstr($model->title,0,20) ?>
    </div>
    
    <div id="w_content">
      <?php echo $this->renderPartial('_form',
        array('model'=>$model, 'leafs' => $leafs, 'leaf'  => $model->leaf,'panel_ident' => $panel_ident)); ?>
    </div>

  </div>
</div>

