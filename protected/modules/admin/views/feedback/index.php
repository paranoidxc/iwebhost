<div class='mac_panel_wrap w800p' id="panel_feedback">
  <?php 
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>'Feedback Manage') );
  ?>
 
  <input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('feedback/index', array('keyword' => '')) ?>" />
  <input type="hidden" name='model_type' value="feedback" class="model_type" />   
 
  <p class=''>
    <ul class="actions">     
      <li><a href="<?php echo CController::createUrl('feedback/create') ?>" title="Create feedback" class="ele_create_article">new</a></li>
      <li>      
        <span class="c_m_a">
          More Actions<span class="more"></span>
        </span>
        <ul class='dN c_m_a_d'>
          <li class="ele_delete c_m_a_d_batch" title="Delete" href="<?php echo CController::createUrl('feedback/delete') ?>">Delete</li>
          <li class="c_m_a_d_tip" title="No Selected">No Selected</li>
        </ul>
      </li>
    </ul>
  </p>
 
  <div style="padding: 5px">
    <form action="<?php echo CController::createUrl('feedback/index') ?>" method="get" class="search_form">       
      <input type="text" name="keyword" class="radius7 search_input keyword" />
    </form>
  </div>

  <div class="iform">  
    <table class='ilist'>
      <thead>
        <tr>
          <th class='w20p taC pr2p pl2p'><input type='checkbox' class="ele_list_all" /></th>
          <th class='w80p '>Sid</th>
          <th class='w80p taL'>itype</th>
          <th class='w160p taL'>email</th>
          <th class='w160p taL'>question</th>
          <th class='w100p taL'>q_time</th>
          <th class='taL' >answer</th>
          <th class='w100p taL'>a_time</th>
        </tr>
      </thead>
    </table> 
    <div class='mb10P ofA search_result_wrap' style="max-height: 300px">      
      <?php echo $this->renderPartial('_index', array('list'=>$list, 'pagination' => $pagination, 'select_pagination' => $select_pagination)); ?>
      <!-- table header 和 table body 视情况而变 结束-->
    </div>
  </div>
  <div class="ajax_overlay" ></div>
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');   
  ?>
</div>
