 <?php    
		
		$nodes  = Category::model()->ileafs(
      array( 'ident' => 'attachment','include' => true )
	  );
		
		$this->renderPartial('_node',array( 'nodes' => $nodes,'return_id' => $return_id ) );
  ?>
