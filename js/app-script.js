function init_article_sort() {  
  
		$("#article_drag_ele").sortable({
		  handle: '.handle',
		  start: function(event, ui) { 		    
		  },
			update: function(event, ui) {
				var fruitOrder = $(this).sortable('toArray').toString();
				//console.log( fruitOrder );

				var serial = $('#article_drag_ele').sortable('serialize');
				$.ajax({
					type: "post",
					url: $('#sort_content_url').val(),
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
	
	
	function isContentSelected(){
	  if( $('.cb_article:checked').length > 0 ) {
	    return true;
    }else{
      return false;
    }
	}
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
	
	
	
	/*a8866c09a3ff02198ac19d9759cf9e70  attachment pick handle*/
	$('.pick').live('click',function(){
		var uri = $(this).attr('uri');		
		wrap = getPanel($(this));
		$.ajax({
			type: 'get',
			cache: false,
			url: uri,
			success:function(html){
			  popup_panel( $(html) );
			}
		});
	});		
	
	/* 3adf93e4b9161c1409b6bc3e228c9439 返回关联图片 return attachment pick   */
	$('.rpick').live('click',function(){
	  var wrap = getPanel($(this));
	  wrap.find('tr').css({
	    background: 'none'
	  })
	  var tr_ele = parentOne( $(this), 'tr');
	  tr_ele.css({
	    background: 'green'
	  });
	  wrap.find('.rel_id').val( $(this).attr('rel_id') );
	  wrap.find('.rel_screen_name').val( $(this).attr('rel_screen_name') );
	  wrap.find('.rel_path').val( $(this).attr('rel_path') );	  
	});
	
	/*315349422075b608b865e9fb0b21812d 返回关联集合  collect return pick */
	$('.collect_return_submit').live('click',function(){	  
	  var wrap = getPanel($(this));	  
	  var return_wrap = $('#'+wrap.find('.return_id').val()).parent().next();
	  var rel_name        = wrap.find('.node_name').val();
	  var rel_id          = wrap.find('.node_id').val();
	  
	  return_wrap.find('.dest_collect_name').html( rel_name );
	  return_wrap.find('.dest_collect').show();
	  var input_default_value = return_wrap.find('input').val();
	  return_wrap.find('input').attr('value', rel_id);	  
	  return_wrap.find('.unlink_collect').attr('origin_value',input_default_value);
	});

	$('.att_return_submit').live('click',function(){
	  var wrap = getPanel($(this));	  
	  var return_wrap = $('#'+wrap.find('.return_id').val()).parent().next();
	  var rel_path        = wrap.find('.rel_path').val();
	  var rel_id          = wrap.find('.rel_id').val();
	  var rel_screen_name = wrap.find('.rel_screen_name').val();
	  var str = 'ID:'+rel_id +"\n"+ ' NAME:'+rel_screen_name;
	  
	  /*display the select thumbnail*/
	  return_wrap.find('.dest_thumbnail').find('img').attr('src', '/upfiles/g'+rel_path).attr('title', str);
	  /*relation the select id */
	  var input_default_value = return_wrap.find('input').val();
	  return_wrap.find('input').attr('value', rel_id);	
	  return_wrap.find('.unlink_dest').attr('origin_value',input_default_value);
	  return_wrap.find('.dest_thumbnail').show();
	  
	});
	
	$('.reset_default_collect').live('click',function(){
	  $(this).parent().find('p').show();
	  $(this).prev().show();
	  $(this).parent().parent().find('input').attr('value', $(this).attr('rel_id') );
	  $(this).hide();
	  
	});
	
	$('.reset_default').live('click',function(){
	  $(this).parent().find('img').show();
	  $(this).parent().parent().find('input').attr('value', $(this).attr('rel_id') );
	  $(this).hide();
	  $(this).prev().show();
	});
	
	$('.unlink_collect').live('click',function(){
	  var return_wrap =$(this).parent().parent();
	  var input = return_wrap.find('input');
	  input.attr('value', $(this).attr('origin_value') );
	  $(this).attr('origin_value','');
	  $(this).parent().hide();
	});
	
	$('.unlink_dest').live('click',function(){
	  $(this).prev().attr('src','');
	  var return_wrap = $(this).parent().parent();
	  var input = return_wrap.find('input');
	  input.attr('value', $(this).attr('origin_value') );
	  $(this).attr('origin_value','');
	  $(this).parent().hide();
  });
  
  $('.unlink_default_collect').live('click',function(){
    $(this).hide();    
    var prev = $(this).prev().hide();    
    var return_wrap = $(this).parent().parent();
    var input = return_wrap.find('input');
    input.attr('value', $(this).attr('origin_value') );
    $(this).next().css('display','block');
    $(this).hide();
  });
  
	$('.unlink_default').live('click',function(){
	  var prev = $(this).prev().hide();	  		  
	  var return_wrap = $(this).parent().parent();
	  var input = return_wrap.find('input');	  
	  input.attr('value', $(this).attr('origin_value') );
	  $(this).hide();
	  $(this).next().css('display','block');
	});
	
	$('.rpick_submit').live('click',function(){
	
	  var wrap = getPanel($(this));	  
	  var return_ele = $('#'+wrap.find('.return_id').val());
	  
	  var rel_path        = wrap.find('.rel_path').val();
	  var rel_id          = wrap.find('.rel_id').val();
	  var rel_screen_name = wrap.find('.rel_screen_name').val();
	  
	  return_ele.next().attr('origin_value', return_ele.next().attr('value') );
		return_ele.next().attr('value',rel_id);
		var return_ele_p = return_ele.parent();
		
		if( return_ele_p.prev().hasClass('dest_thumbnail')  ){
		  var dest_ele_wrap = return_ele_p.prev();
		  dest_ele_wrap.find('img').attr('src','/upfiles/s'+rel_path );
		  dest_ele_wrap.find('p').html( rel_screen_name );
		}else{
		  var dest_ele_wrap = $('<div class="dest_thumbnail" />').insertBefore(return_ele_p);		  
		  $('<span />').html('x').addClass('dest_thumbnail_close').appendTo(dest_ele_wrap).click(function(){
		    dest_ele_wrap.remove();
		    return_ele.next().attr('value',return_ele.next().attr('origin_value') );
		    
		  });
		  $('<img>').attr('src', '/upfiles/s'+rel_path ).appendTo(dest_ele_wrap);
		  $('<p>').html( rel_screen_name ).appendTo(dest_ele_wrap);
		}	
		wrap.remove();
	})

	
	
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
  				//url:	'/index.php?r=admin/category/sort&ajax=ajax&id1='+first.attr('data_id')+'&id2='+id2,
  				         ///index.php?r=admin/category/sort&ajax=ajax
  				url:	$('#sort_leaf_url').val()+'&id1='+first.attr('data_id')+'&id2='+id2,
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
	
	/* 3c0d364a98ce192722f577cf3227c2eb 点击节点显示内容 */
	var loading = $('<li class="loading"><img src="/images/ajax-loader.gif" /></li>');
	function bindLeafClick(){
  	$('.api_categorys_ul p span.leaf').each(function(item) {
  	  $(this).click(function(ev) {	 
  	    wrap = getPanel($(this));  	    
  	    if( $(this).attr('data_id') == wrap.find('#top_leaf_id').val() ){
  	      wrap.find('.ele_del_leaf').removeClass('active');
  	      wrap.find('.ele_move_leaf').removeClass('active');
  	      wrap.find('.ele_update_leaf').removeClass('active');  	      
  	    }else{
  	      wrap.find('.ele_del_leaf').addClass('active');
  	      wrap.find('.ele_move_leaf').addClass('active');
  	      wrap.find('.ele_update_leaf').addClass('active');
  	    }
  	    
  	    $('#leaf_id').val($(this).attr('data_id'));	
  	    $('#cur_leaf_id').val( $(this).attr('data_id') );
  	    $('.api_categorys_ul p.tree_leaf_current').removeClass('tree_leaf_current');
  	    $(this).parent().addClass('tree_leaf_current');  	    
  	    $.ajax({
            type: 'get',
            dataType: 'html',
            cache: false,
            url: '/index.php?r=admin/category/view&model_type='+$('#model_type').val()+'&ajax=ajax&id=' + $(this).attr('data_id'),
            success: function(html) {                
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
	$('.mac_panel_wrap').draggable({
    	handle: ".drag_handle",
    	cursor: "move"
	 });
	
	$('.mac_panel_wrap').live('click',function(){
	  z++;  
	  $(this).css( { 'z-index':z } );
	});
	
	function init_mac_panel_drag() {
	  $('.mac_panel_wrap').draggable({
	    start: function(event, ui) { 	      
	      idebug( ' global z = ' +z);
	      z++;
	      wrap = getPanel($(this));
	      wrap.css({
	        'z-index' :z
	      });	      
	    },
    	handle: ".drag_handle",
    	cursor: "move"
	  });  
	}
	
	
	
	
	
	
	
	
	
	//fun17
	$('.to_dest').live('click',function(){	  
	  $('#move_category_id').attr('value', $(this).attr('rel_id'));
	  $('#move_category_name').attr('value',$(this).attr('rel_name'));
	})	
	
	/*accb8413de43b01d42bc9f1af5aceab0 添加节点*/
	$('.ele_create_category').live('click',function () {	  
	  wrap = getPanel($(this));
	  $.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&model_type='+$('#model_type').val()+'&ajax=ajax&id=1&leaf_id='+$('#cur_leaf_id').val(),
			success:	function (html) {
			  popup_panel( $(html) );
			}			
		});
		return false;
  });
  /*d7c8386e98d5b2185c276b93b32c84e3 编辑节点*/	
	$('.ele_update_leaf').live('click', function() {			  
		wrap = getPanel($(this));
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&model_type='+$('#model_type').val()+'&ajax=ajax&id='+$('#leaf_id').val(),
			success:	function(html) {
			  popup_panel( $(html) );
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
	
	/* 137b2dfd2e8ecf4ddc2ef2b1e78ac3b4 提交删除节点 */
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
				renderPartLeafs();
			}			
		});
		}
		return false;				
	})
	

	
	$('.ele_create_new_leaf').live('click', function() {		
		//console.log( $(this).attr('href') );
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&leaf_id='+$('#leaf_id').val(),
			success:	function(html) {
				var pop = $("<div title='my god' ></div").html(html);
				pop.insertAfter($('body')).dialog( {			
					width: 600, 
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
	
	
	//98f13708210194c475687be6106a3b84  移动节点
	$('.ele_move_leaf').live('click',function(){
	  wrap = getPanel($(this));
	  $.ajax({
	    type: 'get',
	    cache: false,
	    url:    $(this).attr('href')+'&top_leaf_id='+$('#top_leaf_id').val(),
	    success: function(html){	      
	      popup_panel( $(html) );	      
	    }	    
	  });
	  return false;
	})
	//98f13708210194c475687be6106a3b84  提交移动节点
	$('#category_ajax_move').live('submit',function(){	  
	  wrap = getPanel($(this));
	  dialog = wrap.find('.panel_middle .middle .feedback');
		dialog.html('');
		
	  $.ajax({
			type: "post",
			cache: false,
			data:		$(this).serialize()+"&cur_leaf_id="+$('#cur_leaf_id').val(),
			url: $(this).attr('action'),
			success:	function(html){
			   if( html.indexOf('mac_panel_wrap') != -1 ){
			    wrap.html( html);
			  }else{
			    dialog.addClass('feedback_on').html(html).show();
			    setTimeout( "dialog.slideUp()" , 3000 );			    
			  }
        renderPartLeafs();
			}
		});
		return false;
	});

	$('.leaf_pick').live('click',function(){	  
	  $('#move_category_id').attr('value', $(this).attr('rel_id'));
	  $('#move_category_name').attr('value',$(this).attr('rel_name'));
	})
		
  
	
	/* JAVASCRIPT_START */
	/* 881518a1d877c78958dd6f7e7fe11f8c 全局变量定义*/
	var x =y = 0, z = 1000000, distance = 25, wrap=null;
	function reset_panel_postion(){	  	
	  z++;  
	  if( x >= 250 ){
	    x = y = 0;	    
	  }	  
	  x = y += distance;
	}

	function popup_panel(ele) {
	  $('body').append( ele );
	  reset_panel_postion();	  
	  ele.css({
	    top: x+'px',
	    left: y+'px',
	    'z-index': z,
	    position: 'absolute'
	  })
	  init_mac_panel_drag();
	}
	
	
	
	/* 881518a1d877c78958dd6f7e7fe11f8c 全局方法定义*/
	$(document).ajaxStart(ajaxOnStart).ajaxSuccess(ajaxOnSuccess).ajaxError(ajaxOnError);
  function ajaxOnStart() {
    if (wrap != null){       
      formLay(wrap);
      formError(wrap);
     }
    /*$.fn.imasker({
      'z-index'	   : 1000000000
    });
    */
  }
  function ajaxOnSuccess() {
    if( wrap != null ) { formLay(wrap,'h'); wrap = null;}
    /*
    $.fn.imasker_hide();
    */
  }
  function ajaxOnError() {
    if( wrap != null ) { formLay(wrap,'h'); wrap = null;}
    /*
    $.fn.imasker_hide();
    */
  }

	
	function idebug(obj) {
	  if( $.browser.mozilla ){
	    console.log(obj);  
	  }
	}
	
	/*4e134a399e16e6edf848985f4b93e107 取得当前的文章ids*/
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
	
	/*8a8bb7cd343aa2ad99b7d762030857a2  取得当前DOM给定的父元素 */
	function parentOne(ele,exp){	  
    if( ele.parent().find(exp).length > 0  ) {      
      return ele;      
    }else{
      return parentOne(ele.parent(), exp);
    }	      
	}
	/*693a9fdd4c2fd0700968fba0d07ff3c0 取得当前DOM的父元素中含有类mac_panel_wrap */
	function getPanel(that){
    return parentOne(that,'.mac_panel_wrap');
  }
  
  function formLay(wrap,t){
    idebug('Call formLay');
    if( t == 'h') {
      idebug('ajax overlay display ='+t);
      wrap.find('.ajax_overlay').hide();  
    }else{
      wrap.find('.ajax_overlay').css('z-index',z).show();
    }
  }
  function formError(wrap){
    wrap.find('.errorSummary').hide();
    wrap.find('.errorMessage').hide();
  }
  
  
  /*9d607a663f3e9b0a90c3c8d4426640dc 类mac_panel_wrap DOM的 关闭 , 最小化, 最大化事件 */
  var wrap_remove = function(){
    wrap.remove();
  };
	$('.mac_panel_wrap .close').live('click',function(){
	  getPanel($(this)).remove();
	});	
	$('.mac_panel_wrap .min').live('click',function(){
	  getPanel($(this)).slideUp();
	});	
	$('.mac_panel_wrap .max').live('click',function(){	  
	  getPanel($(this)).css({
	    width: '100%',
	    height: '100%'
	  })
	});
		
		
	/* 32cfe6c19200b67afb7c3d0e1c43eadb 新建文章  */
	var fun_article_new = function () {
	  if( $('#model_type').val() == "attachment" ){
	    $('#attachment_form_wrap').toggle();
	    return false;
	  }
	  wrap = getPanel($(this));
		$.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&id=1&leaf_id='+$('#leaf_id').val(),
			success:	function (html) {			  
			  popup_panel( $(html) );
			  init_mac_panel_drag();			  
			}			
		});
		return false;
	};
	$('.create_article_continue').live('click',function(){
	  wrap = getPanel($(this));	  
	  wrap.remove();	  
	  $.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&id=1&leaf_id='+$('#leaf_id').val(),
			success:	function (html) {			  
			  popup_panel( $(html) );
			  init_mac_panel_drag();			  
			}			
		});
	  return false;	  
	});
	$('.edit_article_continue').live('click',function(){
	  wrap = getPanel($(this));	  
	  wrap.remove();
	  var url = $(this).attr('href');
	  $.ajax({
			url:	url,
			type:	'get',
			cache:	false,
			success:	function(html){
			  popup_panel( $(html) );		
			  init_mac_panel_drag();
			}
		});
		return false;
  });
	
	$('.ele_create_article').live('click',fun_article_new);		
	
	/* b44da0a79dce2105c33f132c44842c28 移动文章 */
	$('#artiles_move').click(function(){		
	  wrap = getPanel($(this));
		$.ajax({
			type:	'get',
			url:	$('#leaf_content_move_url').val()+'&top_leaf_id='+$('#top_leaf_id').val(),
			cache:	false,
			success:	function(html){
			  popup_panel( $(html) );	
			}
		})		
		return false;
	});
	
	/* eeab0810def3336d891534c6bf06c26e  提交移动文章*/
	$('#article_ajax_move').live('submit',function(){
	  wrap = getPanel($(this));		
	  dialog = wrap.find('.panel_middle .middle .feedback');
		dialog.html('');
		var ids = get_ids();			
		$.ajax({
			type: "post",
			cache: false,
			data:		$(this).serialize()+"&ids="+ids,
			url: $(this).attr('action'),
			success:	function(html){				
				if( html.indexOf('mac_panel_wrap') != -1 ){
			    wrap.html( html);
			  }else{
			    dialog.addClass('feedback_on').html(html).show();
			    setTimeout( "dialog.slideUp()" , 3000 );			    
			  }
				render();
			}
		});
		return false;
	});
	
	/*f1ce042a27aa18b121377beab2615c57 删除文章*/
	$('#ele_delete_articles').click(function(){	  
		if( window.confirm('Really want to delete record(s) ?') ){				
		  wrap = getPanel($(this));
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
		
	/* 445a7cc846392ddd2a897553267de1ca 拷贝文章*/
	$('#artiles_copy').live('click',function(){		
	  if( confirm('Are you really want to copy this content ?') ){
	    var ids = get_ids();	
	    wrap = getPanel($(this));
  		$.ajax({
  			type:	"post",
  			cache: 	false,
  			data: 	"ids="+ids,
  			url: 	$(this).attr('href'),
  			success:	function(html){				
  				render();
  			}
  		});
	  }
		return false;
	});
	
	/*7fb7af841196fbde1802ce805a1196d3 批量文章打星星 去星星*/
	$('#artiles_stared,#artiles_unstared').live('click',function(){
	  var ids = get_ids();
	  wrap = getPanel($(this));
	  var url = wrap.find('.'+$(this).attr('id')+'_url').val();		  
	  $.ajax({
	    type: 'post',
	    cache: false,
	    data: 'ids='+ids,
	    url: url,
	    success: function(html){
	      render();
	    }
	  })
	});
	
	/*762ac59129462de0624b2877573b286f 文章打星星 去星星*/
	$('.stared,.unstared').live('click',function(){	  
	  var that = $(this);
	  $.ajax({
	    url: that.attr('href'),
	    type: 'get',
	    cache: false,
	    success: function(html){
	      idebug(html);
	      if( that.hasClass('stared') ){
	        that.removeClass('stared');
	        that.addClass('unstared');
	        that.attr('href', that.attr('href').replace('unstared','stared') );
	      }else{
	        that.removeClass('unstared');
	        that.addClass('stared');
	        that.attr('href', that.attr('href').replace('stared','unstared') );
	      }
	    }
	  })
	});
	
	/*9e57007bcc35507dfc5bc7b8f2efb076 编辑文章 */
	$('dl.thumbnail .title,.content_item').live('click',function(){
	  var url = $(this).parent().attr('rel_href');
	  wrap = getPanel($(this));
	  formLay(wrap);
		$.ajax({
			url:	url,
			type:	'get',
			cache:	false,
			success:	function(html){
			  popup_panel( $(html) );		
			  init_mac_panel_drag();
			}
		});
	});
	
	$('.form_tab').live('click',function(){	
	  if( !$(this).hasClass('form_tab_selected') ){
  	  var wrap = getPanel($(this)); 
  	  wrap.find('.form_tab_selected').removeClass('form_tab_selected');	  	  
  	  $(this).addClass('form_tab_selected');
  	  wrap.find('.form_field_wrap').hide();
  	  wrap.find('.'+$(this).attr('data')).show();
	  }
	  return false;
	});
	
	$('.inner_tab').live('click',function(){
	  if( !$(this).hasClass('inner_tab_selected') ){
  	  wrap = getPanel($(this));
  	  wrap.find('.inner_wrap').hide();
  	  wrap.find('.inner_tab_selected').removeClass('inner_tab_selected');	  
  	  $(this).addClass('inner_tab_selected');	  
  	  var that =  wrap.find('.'+$(this).attr('data') );
  	  var val = '';
  	  if( wrap.find('#Article_content').length > 0 ){
  	    val = wrap.find('#Article_content').val();
  	  }else if( wrap.find('#Category_memo').length > 0) {
  	    val = wrap.find('#Category_memo').val(); 
  	  }
  	  if( $(this).attr('data') == 'preview' ){
  	    $.ajax({
  	      type: 'post',
  	      cache: false,
  	      url: $(this).attr('url'),
  	      data: "&content="+val,
  	      success: function(html){
  	        that.html( html );
  	      }
  	    })
  	  }
  	  wrap.find('.'+$(this).attr('data')).show();  
	  }
	});
	
	
	var timeouthandle;
	/* 9e57007bcc35507dfc5bc7b8f2efb076 更新文章*/
	$('.article_ajax_form').live('submit',function(){
	  idebug( timeouthandle );
	  if( timeouthandle != undefined ){
	    clearTimeout(timeouthandle);  
	  }
		var that = $(this);
		var leaf_id = $('#Article_category_id').val();		
		wrap = getPanel($(this));
		var iform = wrap.find('.panel_middle .middle .iform');
		idebug("iform === ");
		idebug(iform.length);
		dialog = wrap.find('.panel_middle .middle .feedback');
		dialog.html('');
		$.ajax({
			type:		"post",
			url:		$(this).attr('action'),
			data:		$(this).serialize(),
			success:	function(html) {			  
			  idebug(html);
			  if( html.indexOf('mac_panel_wrap') != -1 ){
			    wrap.html( html);
			  }else{
			    /*更新操作*/
			    if( that.attr('action').indexOf('article') > 0 ){
  			    if( that.attr('action').indexOf('update') != -1 ) {
    			    dialog.addClass('feedback_on').html(html).show();
    			    timeouthandle = setTimeout( "dialog.slideUp()" , 3000 );
    			    render();
  			    }else{
  			      iform.html(html);
  			      render();
  			    }  
			    }else{
			      iform.html(html);
			      renderPartLeafs();
			    }
			  }
			}
		});		
		return false;
	});
	
	$('.actions>li').hover(function(){
	  },function(){
	  $(this).find('ul').fadeOut();
	  $(this).find('span').removeClass('hover');
	})
	
	$('.c_s_m,.c_m_a').live('click',function(){	  
	  $(this).addClass('hover').css({'z-index':z});
	  if( $(this).hasClass('c_m_a') ) {
	    // if selected 
	    if( isContentSelected() ) {
	      $(this).next().find('.c_m_a_d_batch').show();
	      $(this).next().find('.c_m_a_d_tip').hide();
	    }else{
	      $(this).next().find('.c_m_a_d_batch').hide();  
	      $(this).next().find('.c_m_a_d_tip').show();
	    } 
	  }
	  $(this).next().css({'z-index': z-1}).show();
	});
		
	$('#cb_all').click(function(e){
	  if( $(this).is(':checked') ){
	    $('.cb_article').attr('checked',true);	
	  }else{
	    $('.cb_article').attr('checked',false);	    
	  }
	  renderArticlesActions();	  
	  e.stopPropagation();	  
	});		
	$('.c_s_m_d_a').live('click',function(){
	  $('.cb_article').attr('checked',true);
	  $('#cb_all').attr('checked',true);
	});
	$('.c_s_m_d_n').live('click',function(){
	  $('.cb_article').attr('checked',false);
	  $('#cb_all').attr('checked',false);
	});
	
});
