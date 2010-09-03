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
	
	/*
	* drag the datablock and sort it in real-time	
	*/
	function init_datablock_sort() {	
	$('.data_block_hir').sortable({		 
		handle: 'span.handle'
		/*
		update: function(event, ui) {			
			var serial = $(this).sortable('serialize');			
			var that = $(this);					
			$.ajax({
					type: "post",
					url:   that.attr('href'),
					data: 	serial,
					success: function(html) { 							
						that.effect("highlight", {}, 1000);			
					}		
			});
		}		
		*/
	});	
	};	
		
	function init_datablock_droppable() {			
	$(".data_block_hir li").droppable({
			accept: ".data_block_hir li",					
			hoverClass: "ui-state-hover",
			drop: function(ev, ui) {
				var $item = $(this);
				//console.log( $(this).html() );
				$darg_parent = '';				
				ui.draggable.hide('slow', function() {				
					//$item.parent().append					
					//$(this).appendTo($item.parent()).show('slow');					
					//$(this).after(  ).show('slow');				
					
					//拖拽的父元素
					$drag_parent = $(this).parent();
					
					//拖拽到父元素
					$parent = $item.parent();
					
					if( $drag_parent.attr('id') == $parent.attr('id') ) {												;
					}else {	
						if( $(this).hasClass('selected') ){							
							$(this).show();
							return ;
						}
						
						$.ajax({
							type: 	"post",
							url: 	$parent.attr('move_href'),
							data: 	"&p_id="+$parent.attr('rel_id')+'&id='+$(this).attr('rel_id'),
							success:	function(html){
								console.log( html );
							}
						})
						
					}
					$(this).insertAfter( $item ).show();
					
					$drag_parent.find('.temp').hide();
					$parent.find('.temp').hide();										
					
					if( $drag_parent.find('li[id*=sort]').length == 0 ) {						
						$drag_parent.nextAll('.data_block_hir').remove();						
						$drag_parent.find('.temp').show();
					}
					
					var serial = $parent.sortable('serialize');									
					$.ajax({
						type: "post",
						url:   $parent.attr('href'),
						data: 	serial,
						success: function(html) { 							
							$parent.effect("highlight", {}, 1000);			
						}		
					});
						
				});
								
				//console.log( $item );
				//var $list = $($item.find('a').attr('href')).find('.connectedSortable');			
			}
		});
	}
	

$(document).ready(function(){		
	$('.tree ul li').sortable({
		//update: function(event,ui){
		//	ui.item.unbind('click');
		//}
	});
  function renderCategoryLeafs() {    
    $.ajax({
      type: 'get',
      cache:  false,
      url:  $('#top_tree').attr('render_url'),
      success:  function(html){
        $('#top_tree').replaceWith(html);
      }
    });    
  }
  
	$(".tree ul li span.leaf").droppable({
		accept: ".tree ul li span.leaf",
		hoverClass: "touch",
		drop: function(ev, ui) {						
			// 拖动到 $item 元素的下方
			$item = $(this);			
			ui.draggable.hide('slow', function() {
				//拖拽的父元素			
				$drag_parent = $(this).parent();					
				$_this = $(this);
				//拖拽到 $item的父元素
				$parent = $item.parent();
				if( $(this).attr('sort_url') ){						
					$(this).show();
				$.ajax({
					type: 	'get', 
					url:	$(this).attr('sort_url')+'&ajax=ajax&id1='+$item.attr('data_id')+'&id2='+$(this).attr('data_id'),
					cache:	false,
					success:	function(html){						
						if( html.indexOf('STOP') != -1 ){
							$_this.show().attr('style','');										
						}else{
						  /* render the partial leafs */
						  renderCategoryLeafs();
						}						
					},
					error:		function(){
						
					}					
				})				
				}
			});
		}
	});
	
	/*
	* create hierarchicla node
	*/
	$('.data_block_hir h2').live('click', function(){
		$that = $(this);
		$.ajax({
			type:	'get',
			url:	$that.attr('create_href'),
			cache: 	false,
			success:	function(html){
				var pop = $("<div title='view article' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 1000, 
					minWidth: 600
				});	
			}
		});
	});
	/*
	* edit hierarchicla node
	*/
	$('.data_block_hir>li>span.block_ele').live('dblclick',function(){
		$that = $(this).parent();
		$.ajax({			
			url:	$that.attr('edit_href'),
			type:	'get',
			cache:	false,
			success:	function(html){
				var pop = $("<div title='edit note ' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 1000, 
					minWidth: 600
				});			
			}
		});
	});
	
	
  function removeDataScroll() {
     $('#("#hir_wrap"').jScrollPaneRemove();
  }
  function initDataScroll(){
//    $('#hir_wrap').jScrollHorizontalPane();
    $("#hir_wrap").jScrollPane({showArrows:true, scrollbarWidth: 17, arrowSize: 21,reinitialiseOnImageLoad: true}); 
  }
  function resetDataScroll() {
    removeDataScroll();
    initDataScroll();
  }

  initDataScroll();

	init_datablock_sort();
	init_datablock_droppable();
	/*
	* display the children datablock 
	*/
	//$('.data_block_hir>li[id*=sort]').live('click',function(){
		$('.data_block_hir>li>span.block_ele').live('click',function(){	
		//var that = $(this);		
		var that = $(this).parent();
		$.ajax({
			type: 'get',
			url: that.attr('href'),
			cache: false,
			success: function(html){				
				if( that.parent().find('li.selected').length  == 0 || that.parent().next().length == 0 ) {
					that.parent().nextAll('ul.data_block_hir').remove();
					//that.parent().after( html ).show('slow');	
					$(html).insertAfter( that.parent() ).show('slow');
				} else {
					that.parent().next().replaceWith( html );					
				}
				that.parent().find('li').removeClass('selected');
				that.addClass('selected');
        resetDataScroll();
			}
		});
		
	})
	
	
	
	/*
	* draggble the mac panel
	*/
	$('.mac_panel_wrap,').draggable({
    	handle: ".drag_handle",
    	cursor: "move"
	 });
	  	
	//var articels_action = false;
	
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
					width: 1000, 
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
					width: 1000, 
					minWidth: 600
				});		
			}
		})		
		return false;
	});
	
	/*
	* simple copy articles to same category
	*/
	$('#artiles_copy').live('click',function(){		
		var ids = '';
		$('dl.highlight_selected').each(function(){
			if( ids == "") {
				ids += $(this).attr('rel_id');
			}else {
				ids += ','+$(this).attr('rel_id');
			}			
		});
		
		$.ajax({
			type:	"post",
			cache: 	false,
			data: 	"ids="+ids,
			url: 	$(this).attr('href'),
			success:	function(html){				
				render();
			}
		});
		return false;
		
		
	});
	
	$('#ele_delete_articles').click(function(){
		if( window.confirm('Really want to delete record(s) ?') ){					
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
		}
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
	
	/*
	* 
	*/
	$('.ele_del_leaf').live('click',function(){
		if( window.confirm('Are you Really want to delete the item?') ){					
		$.ajax({
			type 		: 	"POST",
			url	 		: 	$(this).attr('href')+'&ajax=ajax&id='+$('#leaf_id').val(),
			data		: 	"ids="+$('#leaf_id').val(),
			dataType 	:	'html',
			success		:	function(html){
				console.log(html);
			}			
		});
		}
		return false;				
	})
	
	/* create new leaf */
	$('.ele_update_leaf').live('click', function() {		
		
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&id='+$('#leaf_id').val(),
			success:	function(html) {
				var pop = $("<div title='my god' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 1000, 
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
					width: 1000, 
					minWidth: 600
				});		
				console.log( 'ajax create new leaf get suc' );
			}
		});
		return false;
	});
	function renderDataBlock(ele){
		
		$.ajax({
			type:	'get',
			url:	ele.attr('parent_href'),
			cache:	false,
			success: function(html){				
				$('#data_block_'+ele.attr('p_id')).replaceWith( html );
				$('#data_block_'+ele.attr('p_id')).effect("highlight", {}, 1000)
			}			
		})
		
	}
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
	
	function parentOne(ele,exp){
    if( ele.parent().find(exp) ) {
      return ele.parent();
    }else{
      parentOne(ele.parent(), exp);
    }	  
	}
	
	$('.ajax_form').live('submit',function(){
		console.log( 'ajax_form submit');		
		var that = $(this);
		var leaf_id = $('#Article_category_id').val();
		$dialog = parentOne(that,'.ui-dialog-content');		
		//$dialog = $(this).parents().find('.ui-dialog-content');		
		$.ajax({
			type:		"post",
			url:		$(this).attr('action'),
			data:		$(this).serialize(),
			success:	function(html) {
				console.log(html);				
				if( that.hasClass('datablock_ajax_form') ) {					
					renderDataBlock(that);
				}else{
					render();		
				}
				$dialog.html(html);
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
