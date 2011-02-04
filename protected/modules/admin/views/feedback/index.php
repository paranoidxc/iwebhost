<div class='mac_panel_wrap w800P' id="panel_feedback">
  <?php 
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>Yii::t('cp','Feedback').' '.Yii::t('cp','Manage') ) );
  ?>
 
  <input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('feedback/index', array('keyword' => '')) ?>" />
  <input type="hidden" name='model_type' value="feedback" class="model_type" />   
 
  <p class=''>
    <ul class="actions">     
      <li>
        <a href="<?php echo CController::createUrl('feedback/create') ?>" title="Create feedback" class="ele_create">      
          <?php echo Yii::t('cp','New') ?>
        </a>
      </li>
      <li>      
        <span class="c_m_a">
          <?php echo Yii::t('cp','More Actions');?> <span class="more"></span>
        </span>
        <ul class='dN c_m_a_d'>
          <li class="ele_delete c_m_a_d_batch" title="Delete" href="<?php echo CController::createUrl('feedback/delete') ?>">
            <?php echo Yii::t('cp','Delete Content') ?>
          </li>
          <li class="c_m_a_d_tip" title="No Selected">
            <?php echo Yii::t('cp','No Selected') ?>
          </li>
        </ul>
      </li>
    </ul>
  </p>
 
  <div class="p5P" >
    <form action="<?php echo CController::createUrl('feedback/index') ?>" method="get" class="search_form">       
      <input type="text" name="keyword" class="radius15 search_input keyword" />
    </form>
  </div>

  <div class="iform">  
    <table class='ilist'>
      <thead>
        <tr>
          <th class='w20P taC pr2P pl2P'><input type='checkbox' class="ele_list_all" /></th>
          <th class='w80P '><?php echo Yii::t('cp','Sid') ?></th>
          <th class='w80P taL'><?php echo Yii::t('cp','Itype') ?></th>
          <th class='w160P taL'><?php echo Yii::t('cp','Email') ?> </th>
          <th class='w160P taL'><span class="filter radius4"><?php echo Yii::t('cp','Question') ?></span></th>
          <th class='w100P taL'><?php echo Yii::t('cp','Q_time') ?></th>
          <th class='taL' ><span class='filter radius4'><?php echo Yii::t('cp','Answer') ?></span></th>
          <th class='w100P taL'><?php echo Yii::t('cp','A_time') ?></th>
        </tr>
      </thead>
    </table> 
    <div class='ofA search_result_wrap' style="max-height: 300px">      
      <?php echo $this->renderPartial('_index', array('list'=>$list, 'pagination' => $pagination, 'select_pagination' => $select_pagination)); ?>
      <!-- table header 和 table body 视情况而变 结束-->
    </div>
  </div>
  <div class="ajax_overlay" ></div>
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');   
  ?>
</div>
