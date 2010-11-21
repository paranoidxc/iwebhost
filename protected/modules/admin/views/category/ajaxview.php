<table class="w100s bcc">
<?php
  foreach( $model->articles as $a ){
?>
  <tr class="btT csP"
      id="sort_<?php echo $article->id; ?>"
		  rel_id="<?php echo $article->id; ?>"  
		  rel_href="<?php echo CController::createurl('article/update', array('id'=> $a->id, 'ajax'=> 'ajax') ) ?>"
		>
    <td class="w34p taL vaM h20p ti4P ">
      <img class="vaM" src="<?php echo Yii::app()->request->baseUrl?>/images/grippy.png"  />
      <input type="checkbox" class="cb_article vaT" rel_id="<?php echo $a->id; ?>" >
    </td>
    <td class="vaM">
      ST
    </td>
    <td class="vaM content_item">
      <?php echo $a->title; ?>&nbsp;-&nbsp;
      <?php echo cnSub( CHtml::encode($a->content) , 50); ?>
    </td>
    <td class="vaM ">
      <?php //echo $a->update_datetime; ?>
    </td>
    <td class="vaM">
      pp
    </td>    
  </tr>
<?php
  }
?>
</table>
<script type="text/javascript">
	init_article_sort();
</script>
