<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div id="w_left">
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>

  <div id="w_right">
    <div></div>
    
    <div id="w_location"> 
      Console<?php echo API::rchart() ;?><a href="<?php echo url('cp/attachment/index') ?>" >Attachment</a><?php echo API::rchart();?>Index
    </div>

    <?php echo $this->renderPartial( '//layouts/flash') ?>

    <form action="<?php echo url('/cp/attachment/batch') ?>" method="post" class='batch_form' >
      
      <div id="w_action">
        <div class='pl20P pt3P' >
          <span class="action"><input type="checkbox"  class='item-all mt8P' /></span>
          <input type="submit" value="删除" name="type" />
        </div>

        <div class='flR pr20P' style="margin-top: -28px;">
          <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
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

