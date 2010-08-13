<div class="books-wrap">
<?php 
	foreach( $inav_list as $nav ){
		?>
		<div class="books">
			<p class='thumb'><img src="http://t.douban.com/mpic/s4126286.jpg" alt="<?php echo $nav['name']; ?>"/></p>
			<p class='title'><?php echo $nav['name'];?></p>
		</div>
		<?
	}
?>
</div>