<table class='ilist'>
  <tbody class="">
<?php          
  foreach( $list as $_instance) {
?>
  <tr rel_href="<?php echo CController::createUrl('article/update', array('id'=> $_instance->id, 'ajax'=> 'ajax') ); ?>" >          
    <td class='w20p taC pr2p pl2p'><input type='checkbox' value="<?php echo $_instance->id; ?>" class="ele_item" /></td>
    <td class='w80p taC'><?php echo $_instance->id ?></td>
    <td class="content_item" data="<?php echo $_instance->id; ?>" ><?php echo $_instance->title ?></td>
    <td></td>
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
      <td colspan="6" class='taR ipagination'><?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?></td>
    </tr>
  </tfoot>
  <?php 
  }
  ?>
</table>