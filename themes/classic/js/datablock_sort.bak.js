	
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
								//console.log( html );
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
    $("#hir_wrap").jScrollPane({showArrows:true, scrollbarWidth: 17, arrowSize: 21,reinitialiseOnImageLoad: true}); 
  }
  function resetDataScroll() {
    removeDataScroll();
    initDataScroll();
  }

  initDataScroll();
  
	init_datablock_sort();
	init_datablock_droppable();
	
	
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
					/* TODO
				$.ajax({
					type: 	'get', 
					url:	$(this).attr('sort_url')+'&ajax=ajax&id1='+$item.attr('data_id')+'&id2='+$(this).attr('data_id'),
					cache:	false,
					success:	function(html){						
						if( html.indexOf('STOP') != -1 ){
							$_this.show().attr('style','');										
						}else{
						  */
						  /*  render the partial leafs */
						  /*
						  renderCategoryLeafs();
						}						
					},
					error:		function(){
						
					}					
				})				*/
				}
			});
		}
	});