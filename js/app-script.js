function init_article_sort() {	
		$("#article_drag_ele").sortable({
			update: function(event, ui) {

				var fruitOrder = $(this).sortable('toArray').toString();
				console.log( fruitOrder );

				var serial = $('#article_drag_ele').sortable('serialize');
				$.ajax({
					type: "post",
					url:'/index.php?r=admin/article/sortarticle',
					data: serial,
					success: function(html) { 	
						//console.log(html);
						$('#article_drag_ele').effect("highlight", {}, 1000);			
					}		
				});
				//alert( $('#article_drag_ele').sortable('serialize') );
				//console.log( $(this).attr('rel_data_id') ) ;
			}
		});
}
$(document).ready(function(){
	var articels_action = false;
	
	function renderArticlesActions() {
		if( $('dl.highlight_selected').length > 0 ){
			$('.iactions').addClass('hover');
		}else {
			$('.iactions').removeClass('hover');
		}
	}
	/* select article start*/
	$('dl.thumbnail').live('click',function(){		
		$(this).toggleClass('highlight_selected', !$(this).hasClass('highlight_selected'));
		renderArticlesActions();
	});
	/*
	* double click mouse pop the article 
	*/
	$('dl.thumbnail').live('dblclick',function(){
		$.ajax({
			url:	$(this).attr('rel_href'),
			type:	'get',
			cache:	false,
			success:	function(html){
				var pop = $("<div title='view article' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 600, 
					minWidth: 600
				});
				render();
			}
		});
	});
	
	$('#artiles_all').click(function(){
		$('dl.thumbnail').addClass('highlight_selected');				
		renderArticlesActions();
	});
	$('#artiles_none').click(function(){
		$('dl.thumbnail').removeClass('highlight_selected');
		renderArticlesActions();		
	});
	$('#article_ajax_move').live('submit',function(){
		var dialog = $(this).parents().find('.ui-dialog-content');
		var ids = '';
		$('dl.highlight_selected').each(function(){
			if( ids == "") {
				ids += $(this).attr('rel_id');
			}else {
				ids += ','+$(this).attr('rel_id');
			}			
		});	
		console.log(ids);
		$.ajax({
			type: "post",
			cache: false,
			data:		$(this).serialize()+"&ids="+ids,
			url: $(this).attr('action'),
			success:	function(html){
				dialog.html(html);
				render();
			}
		});
		return false;
	});
	$('#artiles_move').click(function(){
		//alert( ids +' records will move ');
		$.ajax({
			type:	'get',
			url:	$(this).attr('href'),
			cache:	false,
			success:	function(html){
				var pop = $("<div title='move articles' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 600, 
					minWidth: 600
				});		
			}
		})		
		return false;
	});
	
	$('#ele_delete_articles').click(function(){
		var ids = '';
		$('dl.highlight_selected').each(function(){
			ids += $(this).attr('rel_id')+',';
		});		
		$.ajax({
			type 		: 	"POST",
			url	 		: 	$(this).attr('href'), 
			data		: 	"ids="+ids,
			dataType 	:	'html',
			success		:	function(html){
				render();
			}			
		});
		return false;
	});
	
	/* select article end */
	/* create new article start */	
	$('.ele_create_article').live('click',function () {
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&id=1&leaf_id='+$('#leaf_id').val(),
			success:	function (html) {
				var pop = $("<div title='new article'></div>").html(html);
				pop.insertAfter($('body')).dialog({
					width: 700,
					minwidth: 700,
					height: 500,
					minheight: 500
				});
			}			
		});
		return false;
	});
	/* create new article end */
	
	/* create new leaf */
	$('.ele_update_leaf').live('click', function() {
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&id=1&leaf_id='+$('#leaf_id').val(),
			success:	function(html) {
				var pop = $("<div title='my god' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 600, 
					minWidth: 600
				});		
				console.log( 'ajax update new leaf get suc' );
			}
		});
		return false;
	});
	$('.ele_create_new_leaf').live('click', function() {		
		console.log( $(this).attr('href') );
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&leaf_id='+$('#leaf_id').val(),
			success:	function(html) {
				var pop = $("<div title='my god' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 600, 
					minWidth: 600
				});		
				console.log( 'ajax create new leaf get suc' );
			}
		});
		return false;
	});
	
	function render() {
	$.ajax({
        type      : 'get',
        dataType  : 'html',
        cache     : false,
        url       : '/index.php?r=admin/category/view&ajax=ajax&id='+$('#leaf_id').val(),
        success   : function(html) {         
         $('#leaf_articles').html(html);
        }
      });  
	}
	
	$('.ajax_form').live('submit',function(){
		console.log( 'ajax_form submit');		
		var that = $(this);
		var leaf_id = $('#Article_category_id').val();
		var dialog = $(this).parents().find('.ui-dialog-content');
		$.ajax({
			type:		"post",
			url:		$(this).attr('action'),
			data:		$(this).serialize(),
			success:	function(html) {
				console.log(html);
				dialog.html(html);
				render();
			}
		});
		return false;
	});
	
	
	
	$('.article_ele_title').live('click', function(){
		//console.log($(this).html());
	});
	
		
	$('.view_ele').click(function(){		
		var that = $(this);
		jQuery.ajax({
			'type'		:'get',
			'dataType' 	:'html',
			'cache'		:false,
			'url'		:'/index.php?r=admin/category/view&ajax=ajax&id='+that.attr('data'),
			'success'	:function(html) { 				
				$('#leaf_articles').html(html);
			}
			//'data'		:that.serialize(),						
		});				
		return false;
	});
	
	
});