<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>

<div id="w_middle">
  <div id="w_left">
    <?php echo $this->renderPartial('_left') ?>
  </div>

  <div id="w_right">
    <div></div>
    
    <div id="w_location">
      Console<?php echo API::rchart() ;?><a href="<?php echo url('cp/feedback/index') ?>" >Feedback</a><?php echo API::rchart();?>Index
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
    

    <form action="<?php echo url('cp/feedback/batch') ?>" method="post" >
      <div id="w_action">
        <div class='pl20P pt3P' >
          <input type="submit" value="删除" name="type" />
        </div>
        <div class='flR pr20P' style="margin-top: -28px;">
        <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
        </div>
      </div>


      <div id="w_content">
        <table class='list'>
          <thead>
            <tr>
              <th class='w20P taC pr2P pl2P'><input type='checkbox' class="item-all" /></th>
              <th class='w80P '><?php echo Yii::t('cp','Sid') ?></th>
              <th class='w80P taL'><?php echo Yii::t('cp','Itype') ?></th>
              <th class='w160P taL'><?php echo Yii::t('cp','Email') ?> </th>
              <th class='w160P taL'><span class="filter radius4"><?php echo Yii::t('cp','Question') ?></span></th>
              <th class='w100P taL'><?php echo Yii::t('cp','Q_time') ?></th>
              <th class='taL' ><span class='filter radius4'><?php echo Yii::t('cp','Answer') ?></span></th>
              <th class='w100P taL'><?php echo Yii::t('cp','A_time') ?></th>
            </tr>
          </thead>
<?php echo $this->renderPartial('_index', array('list'=>$list, 'pagination' => $pagination, 'select_pagination' => $select_pagination)); ?>
        

        </table> 
 
      </div>

    </form>

  </div>

</div>
