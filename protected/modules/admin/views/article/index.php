<div class='mac_panel_wrap w800p' id="panel_article">
  <?php  
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>'Articles Manage') );
  ?>
  <input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('article/index', array('keyword' => '')) ?>" />
  <input type="hidden" name='model_type' value="iarticle" class="model_type" />      
  
  <p class=''>
    <ul class="actions"> 	      
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
      <input type="text" name="keyword" class="radius7 search_input keyword" />
    </form>
  </div>

  <div class="iform">    
    
    <div class='mb10P ofA' style="max-height: 300px">
      <table class='ilist'>
        <thead>
          <tr>
            <th class='w20p taC pr2p pl2p'><input type='checkbox' class="ele_list_all" /></th>
            <th class='w80p taC'>Sid</th>
            <th class='w160p taL'>title</th> 
            <th>&nbsp;</th>                       
          </tr>
        </thead>              
      </table> 
      <div class='mb10P ofA search_result_wrap' style="max-height: 300px">        
        <?php echo $this->renderPartial('_index', array('list'=>$list, 'pagination' => $pagination, 'select_pagination' => $select_pagination)); ?>
      </div>
    </div>
  </div>
  <div class="ajax_overlay" />    
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>