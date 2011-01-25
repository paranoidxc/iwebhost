<table class='ilist'>
  <tbody class="">
  <?php  
  foreach( $list as $user ) {
  ?>
  <tr rel_href="<?php echo CController::createUrl('user/update', array('id'=> $user->id, 'ajax'=> 'ajax') ); ?>" >
    <td class='w20p taC pr2p pl2p'><input type='checkbox' value="<?php echo $user->id; ?>" class="ele_item" /></td>
    <td class='w80p taC'><?php echo $user->id; ?></td>
    <td class="w160p vaM  content_item" data="<?php echo $user->id; ?>" >
    <?php 
      if( $user->is_forever ) {
        echo '<span class="forever" title="can\'t be delete">*';        
        echo '</span>';
      }
      echo $user->username; 
    ?>
    </td>
    <td class='w160p taL'><?php echo $user->password; ?></td>        
    <td class='taL' ><?php echo $user->email; ?></td>
  </tr>
  <?php
  }
  ?>
</table>