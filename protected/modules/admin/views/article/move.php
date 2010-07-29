<form action="<?php echo CController::createurl('article/move') ?>" method="post" id="article_ajax_move">
<select name='category_id' >
	<option>Select One...</option>
<?php 
foreach( $leafs as $key=>$leaf ) {	
	echo "<option value='$key' >$leaf</option>";
}
?>
</select>
<input type="submit" value="move"/>
</form>