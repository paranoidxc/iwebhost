<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div id="w_left">
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>

  <div id="w_right">
    <div></div>
    <div class="lhn-section-primary">
      Console<?php echo API::rchart() ;?><a href="<?php echo url('cp/attachment/index') ?>" >Attachment</a><?php echo API::rchart();?>Index
      <a href="<?php echo url('/cp/attachment/leaf_create', array('top_leaf_id' => $top_leaf->id ,'parent_leaf_id' => $cur_leaf->id ) ) ?>" >create category</a>
      <a href="<?php echo url('/cp/attachment/leaf_update', array('top_leaf_id' => $top_leaf->id ,'cur_leaf_id' => $cur_leaf->id ) ) ?>" >edit category</a>
    </div>
 
    <?php echo $this->renderPartial( '//layouts/flash') ?>

    <form action="<?php echo url('/cp/attachment/batch') ?>" method="post" class='batch_form' >
      
      <div id="w_action">
        <div class='flR pr20P' >
          <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
        </div>
        <div class='' >
          <span class="action"><input type="checkbox"  class='item-all mt8P' /></span>
          <input type="submit" value="删除" name="type" /> 
          <input type="button" value="移动" name="type" class='pick'
              uri="<?php echo url('/cp/attachment/move',array('top_leaf_id' => $top_leaf->id ) ) ?>" />

        </div>
      </div><!--end w_action -->

      <div id="w_content">
            <?php echo $this->renderPartial('_index',
                array('list'=>$list, 'pagination' => $pagination,
                  'top_leaf' => $top_leaf,
                  'select_pagination' => $select_pagination)); ?>
      </div><!-- end w_content -->
    </form>
    <?php echo $this->renderPartial('_form', array('cur_leaf'=>$cur_leaf)); ?>
  </div>
</div>

