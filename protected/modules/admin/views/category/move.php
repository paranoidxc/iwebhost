<form action="<?php echo CController::createurl('category/move') ?>" method="post" id="category_ajax_move">
<?php
    $this->renderPartial('_node_move_ul',array( 'nodes' => $leafs,'return_id' => $return_id ) );
  ?>
  Dest: 
  <input type="text" size="10" name="category_id"   id="move_category_id" readonly = true /> - 
  <input type="text" size="40" name="category_name" id="move_category_name" readonly = true />
  <input type="submit" value="move"/>
</form>