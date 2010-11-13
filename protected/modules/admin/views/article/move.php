<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Move to") )
?>


<form action="<?php echo CController::createurl('article/move') ?>" method="post" id="article_ajax_move">
<?php
    $this->renderPartial('_node',array( 'nodes' => $leafs,'return_id' => $return_id ) );
  ?>  
   <div class="taR h30P pr10P">
    Move To: 
    <input type="text" size="8" name="category_id"  id="move_category_id" readonly = true /> - 
    <input type="text" size="40" name="category_name" id="move_category_name" readonly = true />  
    <?php echo CHtml::submitButton('Ok', array( 'class' => 'ibtn')); ?>
  </div>  
  
</form>


<div class="ajax_overlay" />

<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>