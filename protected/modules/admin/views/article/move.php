<form action="<?php echo CController::createurl('article/move') ?>" method="post" id="article_ajax_move">
<?php
    $this->renderPartial('_node',array( 'nodes' => $leafs,'return_id' => $return_id ) );
  ?>
  Dest: 
  <input type="text" size="10" name="category_id"   id="move_category_id" /> - 
  <input type="text" size="40" name="category_name" id="move_category_name"/>
  <input type="submit" value="move"/>
</form>