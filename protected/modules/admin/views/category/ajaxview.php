<div id="article_drag_ele">
<?php
  foreach( $model->articles as $a ){
?>
<table  class="w100s bcc" 
        id="sort_<?php echo $a->id; ?>"
		    rel_id="<?php echo $a->id; ?>"  
		    rel_href="<?php echo CController::createurl('article/update', array('id'=> $a->id, 'ajax'=> 'ajax') ) ?>">
  <tr class="btT"      
		  rel_id="<?php echo $a->id; ?>"  
		  rel_href="<?php echo CController::createurl('article/update', array('id'=> $a->id, 'ajax'=> 'ajax') ) ?>"
		  >
    <td class="w34p taL vaM h20p ti4P ">
      <img class="vaM csD handle" src="<?php echo Yii::app()->request->baseUrl?>/images/grippy.png"  />
      <input type="checkbox" class="cb_article vaT" rel_id="<?php echo $a->id; ?>" >
    </td>
    <td class="vaM w20p">
      ST
    </td>
    <td class="vaM taL content_item">      
      <?php echo $a->title; ?>&nbsp;-&nbsp;
      <?php echo cnSub( CHtml::encode($a->content) , 50); ?>
    </td>
    <td class="vaM taR w100p">      
      <?php echo Time::timeAgoInWords($a->create_datetime) ;?>
    </td>    
    <td class="vaM w20p">
      <?php //echo $a->update_datetime; ?>
    </td>
  </tr>
</table>
<?php
  }
?>
</div>
<script type="text/javascript">
	init_article_sort();
</script>
