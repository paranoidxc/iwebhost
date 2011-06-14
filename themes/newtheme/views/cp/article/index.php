<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div id="w_left">
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>

  <div id="w_right">
    <div></div>
    
    <div id="w_location"> 
      <?php 
      if( $category->id == $top_leaf ) {
      ?>
      <a href="<?php echo url('cp/article/'.action()) ?>" >Top Leaf</a>
      <?php
      }else{
      ?>
      <a href="<?php echo url('cp/article/'.action()) ?>" >Article</a>
      <?php echo API::rchart();?><a href="<?php echo url('cp/article/'.action(), array('category_id'
      => $category->id) ) ?>" ><?php echo $category->name;?></a>
      <?php 
      }
      ?>
      <?php echo API::rchart();?>Index
    </div>

<?php if(Yii::app()->user->hasFlash('success')) {?>
    <div class="flash_suc">
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php } ?>
<?php if(Yii::app()->user->hasFlash('error')) {?>
    <div class="error">
      <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
 <?php } ?>


    <form action="<?php echo url('/cp/user/batch') ?>" method="post" >
      
      <div id="w_action">
        <div class='pl20P pt3P' >
          <a class='action' href="<?echo url('/cp/article/create', array('action' => action(), 'leaf_id' => $category->id) ) ?>" >new article</a>
          <input type="submit" value="删除" name="delete" />
        </div>
        <div class='flR pr20P' style="margin-top: -28px;">
          <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
        </div>
      </div><!--end w_action -->

      <div id="w_content">
            <?php echo $this->renderPartial('_index',
                array('list'=>$list, 'pagination' => $pagination,
                  'select_pagination' => $select_pagination)); ?>
      </div><!-- end w_content -->
    </form>

  </div>
</div>

