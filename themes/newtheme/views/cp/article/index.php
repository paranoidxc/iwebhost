<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div id="w_left">
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>

  <div id="w_right">
    <div></div>
    
    <div id="w_location"> 
      <?php 
      if( $cur_leaf->id == $top_leaf->id ) {
      ?>
      <a href="<?php echo url('cp/article/'.action()) ?>" ><?php echo $top_leaf->name;?></a>
      <?php
      }else{
      ?>
      <a href="<?php echo url('cp/article/'.action()) ?>" ><?php echo $top_leaf->name; ?></a>
      <?php echo API::rchart();?><a href="<?php echo url('cp/article/'.action(), array('category_id'
      => $cur_leaf->id) ) ?>" ><?php echo $cur_leaf->name;?></a>
      <?php 
      }
      ?>
      <?php echo API::rchart();?>Index
    </div>

    <?php echo $this->renderPartial( '//layouts/flash') ?>

    <form action="<?php echo url('/cp/article/batch') ?>" method="post" class='batch_form' >
      
      <div id="w_action">
        <div class='pl20P pt3P' >
          <a class='action' href="<?echo url('/cp/article/create', array('action' => action(), 'leaf_id' => $cur_leaf->id) ) ?>" >new article</a>
          <input type="submit" value="复制" name="type" />
          <input type="submit" value="重点" name="type" />
          <input type="submit" value="非重点" name="type" />
          <input type="submit" value="删除" name="type" />
          <input type="submit" value="移动" name="type" class='pick'
              uri="<?php echo url('/cp/article/move',array('top_leaf_id' => $top_leaf->id ) ) ?>" />
        </div>
        <div class='flR pr20P' style="margin-top: -28px;">
          <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
        </div>
      </div><!--end w_action -->

      <div id="w_content">
            <?php echo $this->renderPartial('_index',
                array('list'=>$list,
                  'top_leaf' => $top_leaf,
                  'pagination' => $pagination,
                  'select_pagination' => $select_pagination)); ?>
      </div><!-- end w_content -->
    </form>

  </div>
</div>

