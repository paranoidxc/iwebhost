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


    <form action="<?php echo url('/cp/attachment/batch') ?>" method="post" >
      
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
                  'select_pagination' => $select_pagination)); ?>
      </div><!-- end w_content -->
    </form>

  </div>
</div>

