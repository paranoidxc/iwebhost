<div id="w_middle">
  <table class='w100S'>
    <tr>
      <td id='w_left'>
        <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
      </td><!-- w_left end -->
      <td id="w_right">
        <div id="w_location"> 
          <?php echo $this->renderPartial( '//layouts/_location',array('display' => '显示'),false,true) ?>
          
          <div class="location dN">
          <?php if( $cur_leaf->id == $top_leaf->id ) { ?>
          <a href="<?php echo url('cp/article/'.action()) ?>" ><?php echo $top_leaf->name;?></a>
          <?php }else{ ?>
          <a href="<?php echo url('cp/article/'.action()) ?>" ><?php echo $top_leaf->name; ?></a>
          <?php echo API::rc();?><a href="<?php echo url('cp/article/'.action(), array('category_id'
          => $cur_leaf->id) ) ?>" ><?php echo $cur_leaf->name;?></a>
          <?php } ?>
          <?php echo API::rc();?> 列表
          </div>

          <span class='flL csP item-all'>全选</span>

          <div class='settings'>
            <span class='handle'>settings...</span>
            <div>
              <ul>
                <li><a href="#" class='menu-top action-btn confirm' type='copy'>复制</a></li>
                <li><a href="#" class='action-btn confirm' type='star'>重点</a></li>
                <li><a href="#" class='action-btn confirm' type='unstar'>非重点</a></li>
                <li><a href="#" class='action-btn confirm' type='delete'>删除</a></li>
                <li><a href="#" class='pick move' uri="<?php echo url('/cp/article/move',array('top_leaf_id' => $top_leaf->id ) ) ?>" />移动</a></li>
                <li class='iline'></li>
                <li>
                  <a href="<?php echo url('/cp/article/leaf_create',
                      array('top_leaf_id' => $top_leaf->id ,'parent_leaf_id' => $cur_leaf->id ) ) ?>" >添加子类别</a>
                </li>
                <li>
                  <a class="menu-bottom"
                      href="<?php echo url('/cp/article/leaf_update',
                      array('top_leaf_id' => $top_leaf->id ,'cur_leaf_id' => $cur_leaf->id ) ) ?>" >修改当前类别</a>
                </li>
              </ul>
            </div>
          </div><!-- settings end-->
          <div class='flR'>
          <a class='action' href="<?echo url('/cp/article/create', array('action' => action(),'top_leaf_id' => $top_leaf->id, 'leaf_id' => $cur_leaf->id) ) ?>" >新建内容</a>
          </div>
        </div>

        <?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
        <div class='flR pr20P' style="margin-top: -28px;">
          <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
        </div>
        <div id="w_content">     
          <form action="<?php echo url('/cp/article/batch') ?>" method="post" class='batch_form' >
            <input type="input" value="" name="type" id='isubmit' class='dN'/> 
            <?php echo $this->renderPartial('_index',
                array('list'=>$list,
                  'top_leaf' => $top_leaf,
                  'pagination' => $pagination,
                  'select_pagination' => $select_pagination)); ?>
          </form>
        </div><!-- end w_content -->
      </td>
    </tr>
  </table>
</div>
