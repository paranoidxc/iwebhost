<div class='mac_panel_wrap w800P' id="panel_article">
  <?php  
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>'Articles Manage') );
  ?>
  <input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('article/index', array('keyword' => '')) ?>" />
  <input type="hidden" name='model_type' value="iarticle" class="model_type" />      
  
  <p class=''>
    <ul class="actions"> 	      
      <li>&nbsp;</li>
      <li>	  
    	  <span class="c_m_a">
    	    More Actions<span class="more"></span>
    	  </span>
    	  <ul class='dN c_m_a_d'>
    	    <li class="ele_delete c_m_a_d_batch" title="Delete" href="<?php echo CController::createUrl('article/delete') ?>">Delete</li>
    	    <li class="c_m_a_d_tip" title="No Selected">No Selected</li>
        </ul>
      </li>
    </ul>
  </p>
  
  <div style="padding: 5px">
    <form action="<?php echo CController::createUrl('article/index') ?>" method="get" class="search_form">        
      <input type="text" name="keyword" class="radius15 search_input keyword" /> <span class="advanced_search" data="advanced_search_wrap">Advanced Search</span>
      <div class=" advanced_search_wrap">        
        <?php echo Chtml::listBox('category_id',1,$leafs,array('size' => 1, 'default' => 'all', 'class' => 'leaf_id' ) ) ?>
        <input type="checkbox" name="is_include" class="is_include" value="1">Include Subleafs
      </div>
    </form>
  </div>

  <div class="iform">        
    <table class='ilist'>
      <thead>
        <tr>
          <th class='w20P taC pr2p pl2p '><input type='checkbox' class="ele_list_all" /></th>
          <th class='w80P taC'>Sid</th>
          <th class='taL'><span class="filter radius4">title</span></th> 
          <th class='w100P taC' >create_time</th>
          <th class='w100P taC' >update_time</th>          
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