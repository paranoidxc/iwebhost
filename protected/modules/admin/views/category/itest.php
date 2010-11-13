<?php
  echo "<div class='mac_panel_wrap' >";
  $panel_title = 'Name:'.$top_leaf->name.' - ID:'.$top_leaf->id;
  $this->beginWidget('application.extensions.Smacpanel',array('title'=>$panel_title) );
  
  echo "<div class='icategory_tree'>";
  $this->renderPartial('_test_node',array( 'nodes' => $leafs,'return_id' => 'xxx' ) );
  echo "</div>";    
  // top actions 
?>

<input type="hidden" name='top_leaf_id' value="<?php echo $top_leaf->id; ?>"  id="top_leaf_id"/>
<input type="hidden" name='cur_leaf_id' value="<?php echo $top_leaf->id; ?>"  id="cur_leaf_id"/>


<input type="hidden" name='leaf_id'      value="<?php echo $top_leaf->id; ?>"           id="leaf_id"  />
<input type="hidden" name='model_type'   value="<?php echo $top_leaf->model_type; ?>"   id="model_type" />

<input type="hidden" value="<?php echo CController::createUrl('category/view', array('ajax' => 'ajax') ) ?>" id="leaf_content_view_url" />

<input type="hidden"  value="<?php echo CController::createUrl('category/part_leafs',array('top_leaf_id' => $top_leaf->id)) ?>"   id="leaf_render_url"/>

<?php 
  if( $top_leaf->model_type == 'attachment' ) {
    ?>
    <input type="hidden"  value="<?php echo CController::createUrl('attachment/move') ?>"   id="leaf_content_move_url"/>
    <input type="hidden"  value="<?php echo CController::createUrl('attachment/delete') ?>" id="leaf_content_del_url"/>
    <?php
  }
  else{
    ?>
    <input type="hidden"  value="<?php echo CController::createUrl('article/move') ?>"    id="leaf_content_move_url"/>
    <input type="hidden"  value="<?php echo CController::createUrl('article/delete') ?>"  id="leaf_content_del_url"/>
    <?
  }
?>


<div id="leaf_articles_wrap"  class="osX">

<ul class="actions">

	<li class="hover">
		<a  href="<?php echo CController::createUrl('category/create') ?>" 		
	      title="create new leaf inside current leaf" class="ele_create_category"><img src="<?php echo Yii::app()->request->baseUrl?>/images/NewDir.png" /></a>
 	</li>	
 	
 	<li class="hover">
		<a href="<?php echo CController::createUrl('category/update') ?>" 		
 	     title="update the current leaf" class="ele_update_leaf"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Update.png" /></a>
 	</li> 	 	
	
 	<li class="hover">
		<a href="<?php echo CController::createUrl('category/move') ?>" 		
 	     title="move the current leaf to another" class="ele_move_leaf"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Move.png" /></a>
 	</li> 	 	
 	
 	<li class="hover">
 	 <a  href="<?php echo CController::createUrl('category/delete') ?>"		
 	     title="delete current leaf" class="ele_del_leaf"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Recycle.png" /></a>
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
		<a id="artiles_move" title="Move Articles">
			<img src="<?php echo Yii::app()->request->baseUrl?>/images/Move.png" title="Move Articles" />
		</a>		
	</li>
  <?php
	if( $top_leaf->model_type != 'attachment' ) {
  ?>
	<li class="iactions">
		<a  href="<?php echo CController::createUrl('article/copy') ?>" id="artiles_copy" title="Move Articles">
			<img src="<?php echo Yii::app()->request->baseUrl?>/images/Copy.png" title="Copy Articles" />
		</a>		
	</li>
	<?php
    }
  ?>
	<li></li>
	<li>
	  <div id="cb_all_wrap">
	    Select(ALL/None):<input type="checkbox" id="cb_all" />
	  </div>		
	</li>			
</ul>

<?php
  echo '<div id="leaf_articles">';
  echo '</div>';    
  echo '<div class="ajax_overlay" />';
  $this->endWidget('application.extensions.Smacpanel');	  
  echo "</div>";
?>