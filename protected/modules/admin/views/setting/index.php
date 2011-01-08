<?php
  echo "<div class='mac_panel_wrap ilogin_wrap ' >";
  $this->beginWidget('application.extensions.Smacpanel',array('title' => 'System Setting'));
?>  
<div class="icolor">
	<div class="login_column_nav column_nav">
  	<ul>
  		<li><a class="networks" href="#" data="#wrap_site_base_info">Site Base Info</a></li>
  		<li><a href="#" class="about_me" data="#wrap_user_variable">User Variable </a></li>  		
  	</ul>
  </div>
  
  <input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('setting/sconfig'); ?>" />
  <input type="hidden" name='model_type' value="users" class="model_type" />    
  <div class="form login_column_main">
    <div class="iform" id="wrap_site_base_info" >
      <?php echo $this->renderPartial('_sconfig', array('sconfig'=>$sconfig)); ?>
    </div><!-- form -->
    <div id="wrap_user_variable" class='dN'>
      ddddddddddd    
    </div>
  </div>
</div>
<div class="ajax_overlay" ></div>
<?php
  $this->endWidget('application.extensions.Smacpanel');	  
  echo '</div>';
?>