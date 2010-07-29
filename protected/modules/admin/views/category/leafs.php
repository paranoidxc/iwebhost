<?php
$this->breadcrumbs=array(
	'Categories',
);

$this->menu=array(
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);



echo '<div id="content">';
$this->beginWidget('application.extensions.Tmacpanel');
$this->beginWidget('application.extensions.Sidebarpanel');
//echo '<div id="tree_splitter" style="width: 300px; border: 2px solid red;">';
//echo '<div id="tree_root">';
		echo "<ul class='tree' id='top_tree' >";
		$temp_depth = 0;			
		$class="open";
		$handle_class = 'f_'.$class;
		foreach( $leafs as $leaf ) {
			$class="open";
			$handle_class = 'f_'.$class;
			$id = $leaf->id;
			$name = $leaf->name;
			$depth = $leaf->depth;
			if( $leaf->lft +1 == $leaf->rgt ) {
				$handle_class = '';
			}
			if( $depth == 0 ) {
				echo '<li class="'.$class.'" >';
  		  	//	echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
  		  	echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
   				//echo '<span class="'.$class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
   				echo' <span class="leaf" data_id="'.$id.'">';
			}else if( $depth > $temp_depth ) {
				echo '<ul><li class="'.$class.'">';
    			echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
    			//echo '<span class="'.$class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
    			echo '<span class="leaf" data_id="'.$id.'" >';
			}else if( $depth < $temp_depth ) {
				for($i=0; $i < $temp_depth - $depth ; $i ++ ) {
      				echo '</li></ul>';
    			}
    			echo '<li class="'.$class.'">';
    			echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
    			//echo '<span class="'.$class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
    			echo '<span class="leaf" data_id="'.$id.'">';
  			}else if( $depth == $temp_depth ){
    			echo '</li><li class="'.$class.'">';
    			echo '<span class="'.$handle_class.'" data_id="'.$id.'">&nbsp;&nbsp;</span>';
    			//echo '<span class="'.$class.'" data_id="'.$id.'" >&nbsp;&nbsp;</span>';
    			echo '<span class="leaf" data_id="'.$id.'">';
  			}
			echo $name;
  			echo '</span>';
  			//echo ' <a href="?r=admin/category/create&leaf_id='.$id.'" target="_self">A</a>';
  			//echo ' <a class="view_ele" data="'.$id.'" href="?r=admin/category/view&id='.$id.'" target="_self">V</a>';
 			//echo ' <a href="?r=admin/category/delete&id='.$id.'" target="_self">D</a> ';
  		$temp_depth = $depth;
		}
		
		
		for($i=0; $i < $temp_depth; $i ++ ) {
	  	echo "</li>\r\n</ul>";
		}
		echo "</li>\r\n</ul>";					

//echo '</div>';
//echo '</div>';
$this->endWidget('application.extensions.Sidebarpanel');
$this->beginWidget('application.extensions.Siderbarmain');

?>
<div id="leaf_articles_wrap">
<input type="hidden" name='leaf_id' value="1"  id="leaf_id"/>
<ul class="actions">

	<li class="hover">
		<a href="<?php echo CController::createUrl('article/create') ?>" title="New Dir" class="ele_create_article"><img src="<?php echo Yii::app()->request->baseUrl?>/images/NewDir.png" /></a>
 	</li>	
 	
 	<li class="hover">
		<a href="<?php echo CController::createUrl('category/update') ?>" title="Update Dir" class="ele_update_leaf"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Update.png" /></a>
 	</li> 	 	
	
 	<li class="hover">
		<a href="<?php echo CController::createUrl('category/update') ?>" title="Update Dir" class="ele_update_leaf"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Recycle.png" /></a>
 	</li> 	
 	<li class="seperate"></li>
 	 	
	<li class="hover">
		<a href="<?php echo CController::createUrl('article/create') ?>" title="Create Article" class="ele_create_article"><img src="<?php echo Yii::app()->request->baseUrl?>/images/Writing.png" /></a>
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
		<a  href="<?php echo CController::createUrl('article/copy') ?>" id="artiles_move" title="Move Articles">
			<img src="<?php echo Yii::app()->request->baseUrl?>/images/Copy.png" title="Copy Articles" />
		</a>		
	</li>
	
	<li>Select</li>
	<li>
		<span class="crP" id="artiles_all">All</span>
		<span class="crP" id="artiles_none">None</span>		
	</li>
		
	<!--<li><img src="<?php echo Yii::app()->request->baseUrl?>/images/File.png" />
		<?php echo CHtml::link( 'New Dir', CController::createUrl('category/create'), 
									array( 'class' => 'ele_create_new_leaf' ) ); ?></li>
									
	<li><?php echo CHtml::link( 'Update Dir', CController::createUrl('category/update'), 
									array( 'class' => 'ele_update_leaf' ) ); ?></li>		
	<li><?php echo CHtml::link( 'Delete Dir', CController::createUrl('article/create'), 
									array( 'class' => 'ele_create_article' ) ); ?></li>
							
	<li><?php echo CHtml::link( 'New Article', CController::createUrl('article/create'), 
									array( 'class' => 'ele_create_article' ) ); ?></li>				
	<li>
		<span class="crP" id="artiles_all">All</span>
		<span class="crP" id="artiles_none">None</span>
		<span class="crP" id="artiles_move">Move</span>
		<?php echo CHtml::link( 'Delete Article', CController::createUrl('article/delete'), 
									array( 'id' => 'ele_delete_articles' ) ); ?>
	
	</li>
	-->
</ul>
<?php
echo '<div id="leaf_articles">';
echo "</div>";
echo '</div>';
$this->endWidget('application.extensions.Siderbarmain');


$this->endWidget('application.extensions.Tmacpanel');
echo '</div>';
