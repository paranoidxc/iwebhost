<table class='ilist'>
  <tbody class="">
<?php          
  foreach( $list as $_instance) {
?>
  <tr rel_href="<?php echo CController::createUrl('article/update', array('id'=> $_instance->id, 'ajax'=> 'ajax') ); ?>" >          
    <td class='w20P taC pr2P pl2P '>
      <input type='checkbox' value="<?php echo $_instance->id; ?>" class="ele_item" />
    </td>
    <td class='w80P taC'><?php echo $_instance->id ?></td>
    <td class="content_item" data="<?php echo $_instance->id; ?>" ><?php echo $_instance->title ?></td>    
    <td class='w100P taC' ><?php echo Time::timeAgoInWords($_instance->create_time, array('short'=>true) )?></td>
    <td class='w100P taC ' >  
      <span class="<?php echo $_instance->create_time != $_instance->update_time ? 'fontHighLight' : '' ?> ">      
        <?php echo Time::timeAgoInWords($_instance->update_time, array('short'=>true) )?>
      </span>
    </td>     
  </tr>
<?php
  }
?> 
  </tbody>
  <?php 
  if( $pagination ){
  ?>
  <tfoot>
    <tr class="hover_none">
      <td colspan="5" class='taR ipagination  p5P pr20P'><?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?></td>
    </tr>
  </tfoot>
  <?php 
  }
  ?>
</table>