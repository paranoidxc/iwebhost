<div id="w_middle">
  <table class='w100S'>
    <tr>
      <td id='w_left'>
        <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
      </td><!-- w_left end -->

      <td id='w_right'>
        <div id="w_location">
          <div class="lhn-section-primary" style="float: left">
            Console<?php echo API::rchart() ;?><a href="<?php echo url('cp/attachment/index') ?>"
            >Attachment</a><?php echo API::rchart();?>Index&nbsp;&nbsp;&nbsp;
          </div>
          <span class='flL csP toggle' rel="#attachment_form">上载附件</span>
          <span class='flL csP item-all'>全选</span>
          <div class='settings'>
            <span class='handle'>settings...</span>
            <div>
              <ul>
                <li><a href="#" class='menu-top action-btn confirm' type='delete'>删除</a></li>
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
          </div><!-- settings end-->
        </div><!-- w_location end -->
        <?php echo $this->renderPartial( '//layouts/flash') ?>
        <?php echo $this->renderPartial('_form', array('cur_leaf'=>$cur_leaf)); ?>
        <?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
        <div class='flR pr20P ipagination' >
            <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
        </div>
        <div id="w_content">
          <?php echo $this->renderPartial( '_adv_search' ); ?>
          <form action="<?php echo url('/cp/attachment/batch') ?>" method="post" class='batch_form clB' >
          <input type="submit" value="" name="type" class='dN'/> 
          <?php echo $this->renderPartial('_index',
                array('list'=>$list, 'pagination' => $pagination,
                  'top_leaf' => $top_leaf,
                  'select_pagination' => $select_pagination)); ?>
          </form>
        </div><!-- end w_content -->

      </td><!-- w_right end -->

    </tr>
  </table>
</div>
