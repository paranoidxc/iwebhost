<?php  
foreach( $list as $_instance ) {
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