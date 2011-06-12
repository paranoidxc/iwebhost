<?php          
  foreach( $list as $_instance) {
?>
  <tr>          
    <td class='w20P taC pr2P pl2P '>
      <input type='checkbox' value="<?php echo $_instance->id; ?>" name="ids[]" class="item-sep" />
    </td>
    <td class='w80P taC'><?php echo $_instance->id ?></td>
    <td class='w40P taC vaM'>
     <?php
        $is_star          = $_instance->is_star ? 'stared' : 'unstared';        
        $star_action = $is_star == 'stared' ? 'unstared' : 'stared';
      ?>
      <span class="<?php echo $is_star?>" 
            title="<?php echo Yii::t('cp', $is_star) ?>" 
            href="<?php echo CController::createurl('article/'.$star_action, array('id'=> $_instance->id, 'ajax' => 'ajax') ) ?>" ></span>
    </td>
    <td class="content_item" data="<?php echo $_instance->id; ?>" >
      <a href="<?php echo url('/cp/article/update',array( 'id' => $_instance->id) ) ?>"><?php echo $_instance->title ?></a>
    </td>
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
      <td colspan="6" class='taR ipagination  p5P pr20P'><?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?></td>
    </tr>
  </tfoot>
  <?php 
  }
  ?>
