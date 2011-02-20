<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Create Node") )
?>
 <?php    	
		$nodes  = Category::model()->ileafs(
      array( 'ident' => 'attachment','include' => true )
	  );
		$this->renderPartial('_node',array( 'nodes' => $nodes,'return_id' => $return_id ) );
  ?>
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>