<table class='ilist'>
  <tbody class="">
  <?php  
  foreach( $list as $user ) {
  ?>
  <tr rel_href="<?php echo CController::createUrl('user/update', array('id'=> $user->id, 'ajax'=> 'ajax') ); ?>" >
    <td class='w20P taC pr2P pl2P'><input type='checkbox' value="<?php echo $user->id; ?>" class="ele_item" /></td>
    <td class='w80P taC'><?php echo $user->id; ?></td>
    <td class="w160P vaM  content_item" data="<?php echo $user->id; ?>" >
    <?php 
      if( $user->is_forever ) {
        echo '<span class="forever" title="can\'t be delete">*';        
        echo '</span>';
      }
      echo $user->username; 
    ?>
    </td>
    <td class='w160P taL'><?php echo $user->password; ?></td>        
    <td class='taL' ><?php echo $user->email; ?></td>
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