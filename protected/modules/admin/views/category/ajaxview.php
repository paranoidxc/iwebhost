<div class="draggable_wrap">
<?php
  foreach( $list as $a ){
?>
<table  class="w100S bcc" 
        id="sort_<?php echo $a->id; ?>"
		    rel_id="<?php echo $a->id; ?>"  
		    rel_href="<?php echo CController::createurl('article/update', array('id'=> $a->id, 'ajax'=> 'ajax') ) ?>">
  <tr class="btT"      
		  rel_id="<?php echo $a->id; ?>"  
		  rel_href="<?php echo CController::createurl('article/update', array('id'=> $a->id, 'ajax'=> 'ajax') ) ?>"
		  >
    <td class="w34P taL vaM h20P ti4P ">
      <img class="vaM csD handle" src="<?php echo Yii::app()->request->baseUrl?>/images/grippy.png"  />
      <input type="checkbox" class="cb_article vaT" value="<?php echo $a->id; ?>" >
    </td>
    <td class="vaM w20P">
      <?php
        $is_star = $a->is_star ? 'stared' : 'unstared';
        $star_action = $is_star == 'stared' ? 'unstared' : 'stared';
      ?>
      <span class="<?php echo $is_star?>" href="<?php echo CController::createurl('article/'.$star_action, array('id'=> $a->id, 'ajax' => 'ajax') ) ?>" ></span>
    </td>
    <td class="vaM taL content_item" data="<?php echo $a->id; ?>" >
      <?php echo $a->title; ?>&nbsp;-&nbsp;
      <?php echo cnSub( CHtml::encode($a->content) , 10); ?>
    </td>
    <td class="vaM taR w100P">      
      <?php echo Time::timeAgoInWords($a->create_time, array('short'=>true) ) ;?>
    </td>    
    <td class="vaM taC w15P ">
      <span class='fs15P csP' >&raquo;</span>
      <?php //echo $a->update_datetime; ?>
    </td>
  </tr>  
</table>
<?php
  }
?>
<?php
if( !empty($pagination) ){
  ?>
  <table class="w100S">  
  <tr class="hover_none ">
      <td colspan="5" class='taR ipagination  p5P pr20P'><?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?></td>
  </tr>
</table>  
  <?php
 }
?>

</div>
<script type="text/javascript">
	init_content_sort();
</script>