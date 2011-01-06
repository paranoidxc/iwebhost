<div class='mac_panel_wrap w800p'>
  <?php  
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>'Users') );
  ?>
  
  <input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('user/index', array('keyword' => '')) ?>" />
  <input type="hidden" name='model_type' value="admin" class="model_type" />
  
  <p class=''>
    <ul class="actions"> 	
      <li><a href="<?php echo CController::createUrl('user/create') ?>" title="Create Admin" class="ele_create_article">new</a></li>
      <li>	  
    	  <span class="c_m_a">
    	    More Actions<span class="more"></span>
    	  </span>
    	  <ul class='dN c_m_a_d'>
    	    <li class="ele_delete c_m_a_d_batch" title="Delete" href="<?php echo CController::createUrl('user/delete') ?>">Delete</li>
        </ul>
      </li>
    </ul>
  </p>
  
  <div style="padding: 5px">
    <form action="<?php echo CController::createUrl('user/index') ?>" method="get" class="search_form">        
      <input type="text" name="keyword" class="radius7 search_input keyword" />
    </form>
  </div>

  <div class="iform">    
    
    <div class='mb10P'>
      <table class='ilist'>
        <thead>
          <tr>
            <th class='w20p taC pr2p pl2p'><input type='checkbox' class="ele_list_all" /></th>
            <th class='w80p taC'>Sid</th>
            <th class='w160p taL'>Account</th>
            <th class='w160p taL'>Password</th>
            <th class='taL' >Email</th>
          </tr>
        </thead>
        <tbody class="search_result_wrap">
          <?php
          $admins = User::model()->findAll();
          foreach( $admins as $user ) {
          ?>
          <tr rel_href="<?php echo CController::createUrl('user/update', array('id'=> $user->id, 'ajax'=> 'ajax') ); ?>" >
            <td class='w20p taC'><input type='checkbox' value="<?php echo $user->id; ?>" class="ele_item" /></td>
            <td class='taC'><?php echo $user->id; ?></td>
            <td class="w160p vaM  content_item" data="<?php echo $user->id; ?>" ><?php echo $user->username; ?></td>
            <td class='w160p taL'><?php echo $user->password; ?></td>        
            <td class='taL' ><?php echo $user->email; ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="ajax_overlay" />    
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>