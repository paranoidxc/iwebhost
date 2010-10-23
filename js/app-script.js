function init_article_sort() {  
  
		$("#article_drag_ele").sortable({
			update: function(event, ui) {

				var fruitOrder = $(this).sortable('toArray').toString();
				//console.log( fruitOrder );

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
	

$(document).ajaxStart(ajaxOnStart).ajaxSuccess(ajaxOnSuccess).ajaxError(ajaxOnError);

function ajaxOnStart() {
  $.fn.imasker({
    'z-index'	   : 1000000000
  });
}
function ajaxOnSuccess() {
  $.fn.imasker_hide();
}
function ajaxOnError() {
  $.fn.imasker_hide();
}

$(document).ready(function(){	
  
  
  // fun1 login function  
  $('.ilogin_wrap .login_column_main').hide();  
  $($('.ilogin_wrap .login_column_main')[0]).show();
  
  $($('.ilogin_wrap .login_column_nav li')[0]).addClass('current');
  
  $('.ilogin_wrap .column_nav>ul>li').each(function(){
		$(this).click(function(){
			$($('.column_nav>ul>li.current').removeClass('current').find('a').attr('data')).stop(true,true).slideUp();
			$($(this).addClass('current').find('a').attr('data')).stop(true,true).slideDown();
			return false;
		});
	});
	
	
	//var articels_action = false;	
	function renderArticlesActions() {
	  if( $('.cb_article:checked').length > 0 ) {
	    $('.iactions').addClass('hover');
	  }else{
	    $('.iactions').removeClass('hover');
	  }
	  /*
		if( $('.highlight_selected').length > 0 ){
			$('.iactions').addClass('hover');
		}else {
			$('.iactions').removeClass('hover');
		}*/
	};
	
	/*
	$('.item_checkbox :checkbox').live('click',function(){
	  $(this).parent().parent().toggleClass('highlight_selected', $(this).is(':checked') );
	  renderArticlesActions();	  
	});		
	*/
	
	//fun14
	$('#cb_all').click(function(){
	  if( $(this).is(':checked') ){
	    $('.cb_article').attr('checked',true);
	  }else{
	    $('.cb_article').attr('checked',false);
	  }
	  renderArticlesActions();
	});
	
	$('#artiles_all').click(function(){
	  $('.cb_article').attr('checked',true);	  
	  /*$('.item_checkbox :checkbox').attr('checked', true);
		$('dl.thumbnail').addClass('highlight_selected');
		renderArticlesActions();
		*/
	});
	
	$('#artiles_none').click(function(){
	  $('.cb_article').attr('checked',false);
	  /*
	  $('.item_checkbox :checkbox').attr('checked', false);
		$('dl.thumbnail').removeClass('highlight_selected');
		renderArticlesActions();		
		*/
	});
	
	//attachment pick handle
	$('.pick').live('click',function(){
		var uri = $(this).attr('uri');		
		$.ajax({
			type: 'get',
			cache: false,
			url: uri,
			success:function(html){
				var pop = $("<div title='Pick' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 400, 
					minWidth: 400
				});	
			}
		});
	});
	
	$('.rpick').live('click',function(){
		var return_ele = $('#'+$(this).attr('return_id'));		
		return_ele.next().attr('origin_value', return_ele.next().attr('value') );
		return_ele.next().attr('value',$(this).attr('rel_id'));
		var return_ele_p = return_ele.parent();
		
		if( return_ele_p.prev().hasClass('dest_thumbnail')  ){
		  var dest_ele_wrap = return_ele_p.prev();
		  dest_ele_wrap.find('img').attr('src','/upfiles/s'+$(this).attr('rel_path') );
		  dest_ele_wrap.find('p').html( $(this).attr('rel_screen_name') );
		}else{
		  var dest_ele_wrap = $('<div class="dest_thumbnail" />').insertBefore(return_ele_p);		  
		  $('<span />').html('x').addClass('dest_thumbnail_close').appendTo(dest_ele_wrap).click(function(){
		    dest_ele_wrap.remove();
		    return_ele.next().attr('value',return_ele.next().attr('origin_value') );
		    
		  });
		  $('<img>').attr('src', '/upfiles/s'+$(this).attr('rel_path') ).appendTo(dest_ele_wrap);
		  $('<p>').html($(this).attr('rel_screen_name')).appendTo(dest_ele_wrap);
		  
		}	
	});
	
	
	$('.gallery_return_pick').live('click',function(){
		var return_ele = $('#'+$(this).attr('return_id'));
		return_ele.next().attr('origin_value', return_ele.next().attr('value') );
		return_ele.next().attr('value',$(this).attr('rel_id'));
		var return_ele_p = return_ele.parent();
		
		if( return_ele_p.prev().hasClass('dest_gallery')  ){
		  var dest_ele_wrap = return_ele_p.prev();
		  dest_ele_wrap.find('p').html( $(this).attr('rel_name') );
		}else{
		  var dest_ele_wrap = $('<div class="dest_gallery" />').insertBefore(return_ele_p);
		  $('<span />').html('x').addClass('dest_gallery_close').appendTo(dest_ele_wrap).click(function(){
	      dest_ele_wrap.remove();
		    return_ele.next().attr('value',return_ele.next().attr('origin_value') );		    
		  });		  
		  $('<p>').html($(this).attr('rel_name')).appendTo(dest_ele_wrap);		
		}		
	});
	
	
	function cct_option_div_hide(that){
	  that.parent().find('.uri').hide();	 
	  that.parent().find('.oct').hide();	 
	  that.parent().find('.ost').hide();
	}
	
	$('.cct_pick').live('change',function(){	  	  
	  switch($(this).val()){
	    case '3': 	      
	      cct_option_div_hide($(this));
	      $(this).parent().find('.oct').show();
        break;
      case '5':        
        cct_option_div_hide($(this));
        $(this).parent().find('.ost').show();
        break;
      case '6':              
        $(this).parent().find('.uri').show();
        break;
      default:
        cct_option_div_hide($(this));
	  }
  });
	
  
  

  // fun7	    
  
  function category_sortable() {      
  	$(".category_sortable").sortable({
  	  placeholder: 'ui-state-highlight',
  	  start: function() {
  	    $(".category_sortable p span.leaf").unbind();
  	    prevPagesOrder = $(this).sortable('toArray');
  	  },
  	  stop: function() {
  	    bindLeafClick();
  	  },
  	  update: function(event, ui){
  	    var first = ui.item;
  	    var second = first.prev();
  	    if( second.length > 0 ){
  	      var id2 = second.attr('data_id');
  	    }else{
  	      id2 = -1;
  	    }	    
  	    $.ajax({
  				type: 'get', 
  				url:	'/index.php?r=admin/category/sort&ajax=ajax&id1='+first.attr('data_id')+'&id2='+id2,
  				cache:	false,
  				success:	function(html){						
  					if( html.indexOf('STOP') != -1 ){
  						$_this.show().attr('style','');										
  					}else{
  					}			
  					bindLeafClick();			
  				},
  				error:		function(){		
  				}					
  			})
  	  }
  	});
  };
  category_sortable();
	
	// fun8
	var loading = $('<li class="loading"><img src="/images/ajax-loader.gif" /></li>');
	function bindLeafClick(){
  	$('.api_categorys_ul p span.leaf').each(function(item) {
  	  $(this).click(function(ev) {	    
  	    $('#leaf_id').val($(this).attr('data_id'));	
  	    $('#cur_leaf_id').val( $(this).attr('data_id') );
  	    $('.api_categorys_ul p.tree_leaf_current').removeClass('tree_leaf_current');
  	    $(this).parent().addClass('tree_leaf_current');
  	    $('.actions').append(loading);
  	    $.ajax({
            type: 'get',
            dataType: 'html',
            cache: false,
            url: '/index.php?r=admin/category/view&model_type='+$('#model_type').val()+'&ajax=ajax&id=' + $(this).attr('data_id'),
            success: function(html) {
                $('.loading').remove();
                $('#leaf_articles').html(html);                             
            }
        });
  	  });
    });
  };
	bindLeafClick();
	
	
	
  $('.lightbox').lightBox({		
		imageLoading: '/images/lightbox-ico-loading.gif',
		imageBtnClose:'/images/lightbox-btn-close.gif',
		imageBtnPrev: '/images/lightbox-btn-prev.gif',
		imageBtnNext: '/images/lightbox-btn-next.gif',		
   });
   	
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
	
	
	//fun12
	$('#article_ajax_move').live('submit',function(){
		var dialog = $(this).parents().find('.ui-dialog-content');
		var ids = '';
		
		$('.cb_article').each(function(){
		  if( $(this).is(":checked") ){
		    if( ids == "") {
				  ids += $(this).attr('rel_id');
			  }else {
				  ids += ','+$(this).attr('rel_id');
			  }	
		  }
		});			
		
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
		$.ajax({
			type:	'get',
			url:	$('#leaf_content_move_url').val()+'&top_leaf_id='+$('#top_leaf_id').val(),
			cache:	false,
			success:	function(html){			  			  
			  if( $('#dialog_move_content').length > 0 ){
			    $('#dialog_move_content').dialog("destroy");
			    $('#dialog_move_content').remove();
			  }
				var pop = $("<div title='Move Content' id='dialog_move_content' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 400, 
					minWidth: 600
				});		
			}
		})		
		return false;
	});
	
	//fun17
	$('.to_dest').live('click',function(){	  
	  $('#move_category_id').attr('value', $(this).attr('rel_id'));
	  $('#move_category_name').attr('value',$(this).attr('rel_name'));
	})
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
	
	
	//fun16
	function get_ids(){
	  var _temp_ids = '';
	  $('.cb_article').each(function(){
		  if( $(this).is(":checked") ){
		    if( _temp_ids == "") {
				  _temp_ids += $(this).attr('rel_id');
			  }else {
				  _temp_ids += ','+$(this).attr('rel_id');
			  }	
		  }
		});
		return _temp_ids;
	}
	
	//fun15
	$('#ele_delete_articles').click(function(){	  
		if( window.confirm('Really want to delete record(s) ?') ){					
		  var ids = get_ids();
		  var url = $("#leaf_content_del_url").val();		
  		$.ajax({
  			type 		: 	"POST",
  			url	 		: 	url,
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
	//fun9
	
	$('.ele_create_article').live('click',function () {
	  if( $('#model_type').val() == "attachment" ){
	    $('#attachment_form_wrap').toggle();
	    return false;
	  }
	  
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
	
	//fun10	
	$('.ele_create_category').live('click',function () {
	  $.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&model_type='+$('#model_type').val()+'&ajax=ajax&id=1&leaf_id='+$('#cur_leaf_id').val(),
			success:	function (html) {
				var pop = $("<div title='new article'></div>").html(html);
				pop.insertAfter($('body')).dialog({
					width: 550
				});
			}			
		});
		return false;
  });	
	/* create new article end */
	//fun11
	$('.atts').live('click',function(){
	  	
	  $.ajax({
	    type:		"get",
			url:		$(this).attr('rel_url'),
			success:	function (html) {
				var pop = $("<div title='Edit Attachment'></div>").html(html);
				pop.insertAfter($('body')).dialog({
					width: 700,
					minwidth: 700,
					height: 500,
					minheight: 500
				});
			}			
	  })
	  
	});
	
	/*
	* 
	*/
	$('.ele_del_leaf').live('click',function(){
	  //首节点不能删除
	  if( $('#top_leaf_id').val() == $('#cur_leaf_id').val() ){	 
	    alert(' Top Leaf Cannot Be Delete!');
	    return false;
	  }
		if( window.confirm('Are you Really want to delete the item?') ){					
		$.ajax({
			type 		: 	"POST",
			url	 		: 	$(this).attr('href')+'&ajax=ajax&id='+$('#leaf_id').val(),
			data		: 	"ids="+$('#leaf_id').val(),
			dataType 	:	'html',
			success		:	function(html){
				//console.log(html);
			}			
		});
		}
		return false;				
	})
	
	/* create new leaf */
	$('.ele_update_leaf').live('click', function() {		
		
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&model_type='+$('#model_type').val()+'&ajax=ajax&id='+$('#leaf_id').val(),
			success:	function(html) {
				var pop = $("<div title='my god' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 1000, 
					minWidth: 600
				});		
				//console.log( 'ajax update new leaf get suc' );
			}
		});
		return false;
	});
	$('.ele_create_new_leaf').live('click', function() {		
		//console.log( $(this).attr('href') );
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&leaf_id='+$('#leaf_id').val(),
			success:	function(html) {
				var pop = $("<div title='my god' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 1000, 
					minWidth: 600
				});		
				//console.log( 'ajax create new leaf get suc' );
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
	
	//fun13
	function render() {
	  /*if( $("#model_type") == "attachment") ){
	    var url = '/index.php?r=admin/category/view&ajax=ajax&id='+$('#leaf_id').val();  
	  }else{
	    var url = '/index.php?r=admin/category/view&ajax=ajax&id='+$('#leaf_id').val();  
	  }	
	  */  
	  var url = '/index.php?r=admin/category/view&model_type='+$('#model_type').val()+'&ajax=ajax&id='+$('#leaf_id').val();
	  
	  $.ajax({
        type      : 'get',
        dataType  : 'html',
        cache     : false,
        url       : url,
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
	//fun19
	function renderPartLeafs() {
	  var url = $('#leaf_render_url').val();
	  $.ajax({
			type:		"get",
			url:		url,
			cache: false,			
			success:	function(html) {			
			  $('.icategory_tree').html( html );			  
			},
			complete: function(){
			  category_sortable();
			  bindLeafClick();
			}
		});
	}
	
	$('.ajax_form').live('submit',function(){
		//console.log( 'ajax_form submit');		
		var that = $(this);
		var leaf_id = $('#Article_category_id').val();
		$dialog = parentOne(that,'.ui-dialog-content');		
		//$dialog = $(this).parents().find('.ui-dialog-content');		
		$.ajax({
			type:		"post",
			url:		$(this).attr('action'),
			data:		$(this).serialize(),
			success:	function(html) {
				//console.log(html);				
				if( that.attr('id') == 'category-form' ){
				  renderPartLeafs(); 
				}else if( that.hasClass('datablock_ajax_form') ) {					
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
