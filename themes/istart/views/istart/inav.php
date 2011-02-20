<div class="books-wrap">
<?php 
	foreach( $inav_list as $nav ){
		?>
		<div class="books">			
			<p class='thumb'><a href="<?php echo CController::createurl('istart/book', array('datablock_id'=>$nav['id'], 'category_id' => $nav['category_id'] ) ) ?>"><img src="http://t.douban.com/mpic/s4126286.jpg" alt="<?php echo $nav['name']; ?>"/></a></p>
			<p class='title'><a href=""><?php echo $nav['name'];?></a></p>
		</div>
		<?
	}
?>
</div>