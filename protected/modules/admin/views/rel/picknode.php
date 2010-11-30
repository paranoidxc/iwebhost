<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Pick Attachment Gallery") )
?>
 <?php    	
		$nodes  = Category::model()->ileafs(
      array( 'ident' => 'attachment','include' => true )
	  );
		$this->renderPartial('_node',array( 'nodes' => $nodes,'return_id' => $return_id ) );
  ?>
  <input type="hidden" class="return_id" value="<?php echo $return_id;?>" />
  <div class="taR h30P pr10P">
    relation: 
    <input type="text" size="8" name="category_id"  id="move_category_id" class="node_id" readonly="true" /> - 
    <input type="text" size="40" name="category_name" id="move_category_name" class="node_name" readonly="true" />  
    <?php echo CHtml::submitButton('Ok', array( 'class' => 'ibtn collect_return_submit' )); ?>
  </div>  
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>