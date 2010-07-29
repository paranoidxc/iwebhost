<div id="article_drag_ele">
<?php
	foreach( $model->articles as $article ) {
		?>	
		<dl id="sort_<?php echo $article->id; ?>" rel_id="<?php echo $article->id; ?>" class="thumbnail" >
			<dt class="thumb"><img src="images/File.png" width="64" height="64"/></dt>			
			<dt class="title article_ele_title"><a><span><?php echo $article->title; ?></span></a></dt>
			<dd class="summary"><?php echo $article->desc; ?></dd>	
		</dl>
		<?php
	}
?>
</div>
<script type="text/javascript">
	init_article_sort();
</script>
