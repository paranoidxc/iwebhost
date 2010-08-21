<div class="books-wrap">
<?php 
	// get the sub category 	
	$sub_categorys = Category::model()->vleafs($category->id);	
	$this->page_navigation= Datablock::model()->iNav(array('label' => 'istart','depth'	=> 0));
	foreach( $sub_categorys as $category ){
		?>
			<div class="books">			
			<p class='thumb'><a href="<?php echo CController::createurl('istart/category', array('id' => $category->id) ) ?>"><img src="http://t.douban.com/mpic/s4126286.jpg" alt="<?php echo $category->name; ?>"/></a></p>
			<p class='title'><a href=""><?php echo $category->name;?></a></p>
		</div>
		<?
	}
	
?>
</div>