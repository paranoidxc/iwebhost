<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Move to") )
?>

<input type="hidden" class="return_panel" value="<?php echo $panel_ident;?>" />
  <?php
    $this->renderPartial('//layouts/move_node',array( 'nodes' => $leafs,'return_id' => $return_id ) );
  ?>
  
  <div class="taR h30P pr10P">
    Move To: 
    <input type="text" size="8" name="category_id"  class="move_category_id" readonly = true /> - 
    <input type="text" size="40" name="category_name" class="move_category_name" readonly = true />  
    <?php echo CHtml::submitButton('Ok', array( 'class' => 'ibtn blue batch_move')); ?>
  </div>  

<div class="ajax_overlay" />
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>
