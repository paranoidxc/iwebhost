<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div id="w_left">
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>

  <div id="w_right">
    <div></div>
    <div id="w_location">
      <div class="lhn-section-primary" style="float: left">
        Console<?php echo API::rchart() ;?><a href="<?php echo url('cp/attachment/index') ?>" >Attachment</a><?php echo API::rchart();?>Index
      </div>
      <span class='flL csP item-all'>全选</span>
      <div class='settings'>
        <span class='handle'>settings...</span>
        <div>
          <ul>
            <li><a href="#" class='menu-top action-btn confirm delete'>删除</a></li>
            <li><a href="#" class='pick move' uri="<?php echo url('/cp/attachment/move',array('top_leaf_id' => $top_leaf->id ) ) ?>" />移动</a></li>

            <li class='iline'></li>
            <li>
              <a href="<?php echo url('/cp/attachment/leaf_create',
                  array('top_leaf_id' => $top_leaf->id ,'parent_leaf_id' => $cur_leaf->id ) ) ?>" >添加子类别</a>
            </li>
            <li>
              <a class="menu-bottom"
                  href="<?php echo url('/cp/attachment/leaf_update',
                  array('top_leaf_id' => $top_leaf->id ,'cur_leaf_id' => $cur_leaf->id ) ) ?>" >修改当前类别</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div style="clear:both"></div>
 
    <?php echo $this->renderPartial( '//layouts/flash') ?>

    <form action="<?php echo url('/cp/attachment/batch') ?>" method="post" class='batch_form' >
      
      <div id="w_action" class='dN'>
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

