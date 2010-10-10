 <?php
    $nodes = API::categorys(array( 
		  'id'          => 1,
		  'depth'       => 10000,
		  'recursion'   => true
		));	
		$this->renderPartial('_node',array( 'nodes' => $nodes,'return_id' => $return_id ) );
  ?>
