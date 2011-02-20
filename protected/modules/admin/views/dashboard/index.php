<div class='w400P mac_panel_wrap flL'>
  <?php
    $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp','User Info Remind')) );
    $current_user = Yii::app()->user->getState('current_user');
    //print_r($current_user);

  ?>  
  <table class="ilist_dash">
    <tbody>
      <tr>
        <th><?php echo Yii::t('cp','Login Account:')?></th>
        <td><?php echo $current_user['username']; ?></td>
      </tr>      
      <tr>
        <th><?php echo Yii::t('cp','Account Create Time')?>:</th>
        <td><?php echo $current_user['c_time']; ?></td>
      </tr>      
      <tr>
        <th><?php echo Yii::t('cp', 'Current Login Time');?></th>
        <td><?php echo $current_user['current_login_time']; ?></td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp', 'Current IP');?></th>
        <td><?php echo $current_user['current_ip']; ?></td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp', 'Login Count');?></th>
        <td>
          <span class="filter radius4"><?php echo $current_user['login_count']; ?></span>
          <?php echo Yii::t('cp', 'Times Login System')?>
        </td>
      </tr>

      <tr>
        <th><?php echo Yii::t('cp','Last IP')?></th>
        <td><?php echo $current_user['last_ip']; ?></td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp','Last Logout Time')?></th>
        <td><?php echo $current_user['last_logout_time']; ?></td>
      </tr>
      
    </tbody>
  </table>
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>

<div class='w400P mac_panel_wrap flL'>
  <?php
    $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp', 'Most Page View')) );
  ?>
  <input type="hidden" name="model_type" value="article" />
  <table class="ilist_dash">
    <tbody>
    <?php
      $most_pv_list = Article::model()->most_page_view()->findAll();
      foreach( $most_pv_list as $_instance ){
    ?>      
      <tr rel_href="<?php echo CController::createUrl('article/update', array('id'=> $_instance->id, 'ajax'=> 'ajax') ); ?>" >
        <td class="content_item" data="<?php echo $_instance->id; ?>" >
          <span class="filter radius4"><?php echo $_instance->pv?></span> <?php echo $_instance->title ?>
        </td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>

<div class='w400P mac_panel_wrap flL'>
  <?php
    $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp','Environment Info')));
  ?>
  <table class="ilist_dash">
    <tbody>
      <tr>
        <th><?php echo Yii::t('cp','Server Base Info:')?></th>
        <td><?php echo PHP_OS; ?> / PHP v<?php echo PHP_VERSION;?></td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp','WEB Software:')?></th>
        <td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp','Current Login IP:')?></th>
        <td><?php echo $_SERVER['SERVER_ADDR'];?></td>
      </tr>
      <tr>
        <th>magic_quote_gpc:</th>
        <td><?php echo API::get_magic_quotes_gpc(); ?></td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp','MySQL Version:') ?></th>
        <td>
          <?php echo API::mysql_version() ?>
        </td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp','Upload File Max Setting:'); ?></th>
        <td><?php echo APi::server_max_upload_size(); ?></td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp','MySQL File Size:')?></th>
        <td></td>
      </tr>
      <tr>
        <th><?php echo Yii::t('cp','Upload Used Size:') ?></th>
        <td><?php echo API::get_upload_files_size(); ?></td>
      </tr>
    </tbody>
  </table>
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>