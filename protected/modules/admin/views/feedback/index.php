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
    <div class='mb10P ofA' style="max-height: 300px">
      <!-- table header 和 table body 视情况而变 开始-->
      <table class='ilist'>
        <thead>
          <tr>
            <th class='w20p taC pr2p pl2p'><input type='checkbox' class="ele_list_all" /></th>
            <th class='w80p taC'>Sid</th>
            <th class='w160p taL'>itype</th>
            <th class='w160p taL'>email</th>
            <th class='w160p taL'>question</th>
            <th class='taL' >answer</th>
          </tr>
        </thead>
        <tbody class="search_result_wrap">
          <?php
          $feedbacks= Feedback::model()->findAll();
          foreach( $feedbacks as $_instance ) {
          ?>
          <tr rel_href="<?php echo CController::createUrl('feedback/update', array('id'=> $_instance->id, 'ajax'=> 'ajax') ); ?>" >
            <td class='w20p taC'><input type='checkbox' value="<?php echo $_instance->id; ?>" class="ele_item" /></td>
            <td class='taC'><?php echo $_instance->id; ?></td>
            <td class='taL'><?php echo $_instance->itype; ?></td>
            <td class="w160p"><?php echo $_instance->email; ?></td>
            <td class="w160p vaM  content_item" data="<?php echo $_instance->id; ?>" ><?php echo $_instance->question; ?></td>
            <td class="w160p"><?php echo $_instance->answer; ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      <!-- table header 和 table body 视情况而变 结束-->
    </div>
  </div>
  <div class="ajax_overlay" ></div>
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');   
  ?>
</div>
