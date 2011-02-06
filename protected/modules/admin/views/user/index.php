<div class='mac_panel_wrap w800P' id="panel_users">
  <?php  
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>Yii::t('cp','Admins Manage') ) );
  ?>
  
  <input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('user/index', array('keyword' => '')) ?>" />
  <input type="hidden" name='model_type' value="users" class="model_type" />    
  
  
  <p class=''>
    <ul class="actions"> 	
      <li><a href="<?php echo CController::createUrl('user/create') ?>" title="Create Admin" class="ele_create"><?php echo Yii::t('cp','New') ?></a></li>
      <li>	  
    	  <span class="c_m_a">
    	    <?php echo Yii::t('cp','More Actions');?> <span class="more"></span>
    	  </span>
    	  <ul class='dN c_m_a_d'>
    	    <li class="ele_delete c_m_a_d_batch" title="Delete" href="<?php echo CController::createUrl('user/delete') ?>"><?php echo Yii::t('cp','Delete Content') ?></li>
    	    <li class="c_m_a_d_tip" title="No Selected">
    	      <?php echo Yii::t('cp','No Selected') ?>
    	    </li>
        </ul>
      </li>
    </ul>
  </p>
  
  <div class='p5P'>
    <form action="<?php echo CController::createUrl('user/index') ?>" method="get" class="search_form">        
      <input type="text" name="keyword" class="radius15 search_input keyword" />
    </form>
  </div>

  <div class="iform">        
    <table class='ilist'>
      <thead>
        <tr>
          <th class='w20P taC pr2P pl2P'><input type='checkbox' class="ele_list_all" /></th>
          <th class='w80P taC'><?php echo Yii::t('cp','Sid') ?></th>
          <th class='w160P taL'><span class="radius4 filter"><?php echo Yii::t('cp','Account') ?></span></th>
          <th class='w160P taL'><?php echo Yii::t('cp','Password') ?></th>
          <th class='taL' ><span class="radius4 filter"><?php echo Yii::t('cp','Email') ?></span></th>
        </tr>
      </thead>      
    </table>
    <div class='ofA search_result_wrap' style="max-height: 300px">   
      <?php echo $this->renderPartial('_index', array('list'=>$list,'pagination' => $pagination, 'select_pagination' => $select_pagination)); ?>
    </div>    
  </div>
  <div class="ajax_overlay" />    
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>