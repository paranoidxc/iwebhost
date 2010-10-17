





<?php
  echo "<div class='mac_panel_wrap' >";
  $this->beginWidget('application.extensions.Smacpanel');
  
  echo "<div class='icategory_tree'>";
  $this->renderPartial('_test_node',array( 'nodes' => $leafs,'return_id' => 'xxx' ) );
  echo "</div>";
  
  
  // top actions 
?>
  <div id="leaf_articles_wrap"  class="osX">
<input type="hidden" name='leaf_id' value="1"  id="leaf_id"/>
<ul class="actions">

	<li class="hover">
		<a  href="<?php echo CController::createUrl('category/create') ?>" 		
	      title="New Dir" class="ele_create_article"><img src="<?php echo Yii::app()->request->baseUrl?>/images/NewDir.png" /></a>
 	</li>	
 	
 	<li class="hover">
		<a href="<?php echo CController::createUrl('category/update') ?>" 		
 	     title="Update Dir" class="ele_update_leaf"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Update.png" /></a>
 	</li> 	 	
	
 	<li class="hover">
 	 <a  href="<?php echo CController::createUrl('category/delete') ?>"		
 	     title="Delete Dir" class="ele_del_leaf"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Recycle.png" /></a>
 	</li> 	
 	<li class="seperate"></li> 	 	
	<li class="hover">
		<a  href="<?php echo CController::createUrl('article/create') ?>"
	      title="Create Article" class="ele_create_article"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Writing.png" /></a>
 	</li>	
 	
	<li class="iactions">
		<a  href="<?php echo CController::createUrl('article/delete') ?>" id="ele_delete_articles" title="Delete Articles">
			<img src="<?php echo Yii::app()->request->baseUrl?>/images/Delete.png" title="Delete Articles" />
		</a>
	</li>
	
	<li class="iactions">
		<a  href="<?php echo CController::createUrl('article/move') ?>" id="artiles_move" title="Move Articles">
			<img src="<?php echo Yii::app()->request->baseUrl?>/images/Move.png" title="Move Articles" />
		</a>		
	</li>
	
	<li class="iactions">
		<a  href="<?php echo CController::createUrl('article/copy') ?>" id="artiles_copy" title="Move Articles">
			<img src="<?php echo Yii::app()->request->baseUrl?>/images/Copy.png" title="Copy Articles" />
		</a>		
	</li>
	
	<li>Select</li>
	<li>
		<span class="crP" id="artiles_all">All</span>
		<span class="crP" id="artiles_none">None</span>		
	</li>			
</ul>

<?php
  echo '<div id="leaf_articles">';
  for($i=0; $i< 50; $i++){
    echo "<p>1111111111111111111111111111111111111111111111111</p>";
  }
  echo "</div>";
  
  $this->endWidget('application.extensions.Smacpanel');	  
  echo "</div>";
?>