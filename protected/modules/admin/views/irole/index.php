<div class='mac_panel_wrap w800P' id="panel_irole">
  <?php  
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>Yii::t('cp','Irole Manage')) );
  ?>
  <div class="iform">        
    <table class='ilist'>
      <thead>
        <tr>
          <th class='w20P taC pr2P pl2P '><input type='checkbox' class="ele_list_all" /></th>
          <th class='w80P taC'><?php echo Yii::t('cp','Sid') ?></th>
          <th class='w40P taC vaM'><?php echo Yii::t('cp','Name') ?></th>          
        </tr>
      </thead>              
      <tbody>
        <?php
        foreach( $roles as $role ){
          ?>
          <tr>
            <td><?php echo $role->name ?></td>
            <td><?php echo $role->name ?></td>
            <td><?php echo $role->type ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <div class='mb10P ofA search_result_wrap' style="max-height: 300px">      
    </div>  
  </div>
  
  <div class="ajax_overlay" ></div>
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>