<div class='mac_panel_wrap w800P' id="panel_article">
  <?php  
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>Yii::t('cp','Content Manage')) );
  ?>
  <input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('article/index', array('keyword' => '')) ?>" />
  <input type="hidden" name='model_type' value="iarticle" class="model_type" />      
  <input type="hidden" class="top_leaf_id" value="1" />
  <p class=''>
    <ul class="actions"> 	      
      <li>&nbsp;</li>
      <li>	  
    	  <span class="c_m_a">
    	    <?php echo Yii::t('cp','More Actions');?> <span class="more"></span>
    	  </span>
    	  <ul class='dN c_m_a_d'>
    	    <li class="ele_delete c_m_a_d_batch" title="<?php echo Yii::t('cp','delete')?>" href="<?php echo CController::createUrl('article/delete') ?>">
    	      <?php echo Yii::t('cp','Delete Content') ?>
    	    </li>
    	    <li class="ele_content_move c_m_a_d_batch" title="<?php echo Yii::t('cp','move')?>" href="<?php echo CController::createUrl('article/move')?>" >
    	      <?php echo Yii::t('cp','Move Content')?>
    	    </li>    	    
    	    <li class="c_m_a_d_tip" title="No Selected"><?php echo Yii::t('cp','No Selected') ?></li>
        </ul>
      </li>
    </ul>
  </p>
  
  <div style="padding: 5px">
    <form action="<?php echo CController::createUrl('article/index') ?>" method="get" class="search_form">        
      <input type="text" name="keyword" class="radius15 search_input keyword" />
      <span class="advanced_search" data="advanced_search_wrap"><?php echo Yii::t('cp','Advanced Search') ?></span>
      <div class=" advanced_search_wrap">        
        <p><?php echo Yii::t('cp','Select Node'); ?><?php echo Chtml::listBox('category_id',1,$leafs,array('size' => 1, 'default' => 'all', 'class' => 'leaf_id' ) ) ?></p>
        <p><input type="checkbox" name="is_include" class="is_include" value="1"> <?php echo Yii::t('cp','Include Sub Node Content') ?></p>
      </div>
    </form>
  </div>

  <div class="iform">        
    <table class='ilist'>
      <thead>
        <tr>
          <th class='w20P taC pr2P pl2P '><input type='checkbox' class="ele_list_all" /></th>
          <th class='w80P taC'><?php echo Yii::t('cp','Sid') ?></th>
          <th class='taL'><span class="filter radius4"><?php echo Yii::t('cp','Title') ?></span></th> 
          <th class='w100P taC' ><?php echo Yii::t('cp','Create_time') ?></th>
          <th class='w100P taC' ><?php echo Yii::t('cp','Update_time') ?></th>          
        </tr>
      </thead>              
    </table>
    <div class='mb10P ofA search_result_wrap' style="max-height: 300px">        
      <?php echo $this->renderPartial('_index', array('list'=>$list, 'pagination' => $pagination, 'select_pagination' => $select_pagination)); ?>
    </div>  
  </div>
  <div class="ajax_overlay" />    
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>