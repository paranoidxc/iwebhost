<?php          
  foreach( $list as $_instance) {
?>
  <tr rel_href="<?php echo CController::createUrl('article/update', array('id'=> $_instance->id, 'ajax'=> 'ajax') ); ?>" >          
    <td class='w20p taC'><input type='checkbox' value="<?php echo $_instance->id; ?>" class="ele_item" /></td>
    <td class='taC'><?php echo $_instance->id ?></td>
    <td class="content_item" data="<?php echo $_instance->id; ?>" ><?php echo $_instance->title ?></td>
    <td></td>
  </tr>
<?php
  }
?>