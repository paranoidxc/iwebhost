function uploadTips(ele,str) {     
  var wrap = parentOne(ele,'.mac_panel_wrap');  
  var confirm_diglog = $('<div class="tip_diglog p10P" />').html('<h1 class="fs16P">'+str+'</h1>');
  confirm_diglog_ibtn_wrap = $('<div class="taR mt10P" >');  
  confirm_diglog_ibtn_wrap.append( $('<input class="ibtn blue tip_diglog_close" type="button" value="'+G_CLOSE_STR+'" />') );        
  confirm_diglog.append( confirm_diglog_ibtn_wrap );    
  confirm_diglog.addClass('radius7 ');
  confirm_diglog.addClass('boxshadow ');
  wrap.append( confirm_diglog );    
  confirm_diglog.css({ 'position' : 'absolute', 'background' : '#FFF', 'z-index': wrap.css('z-index') })    
  confirm_diglog.css({
    'top': 0,
    'left': ( wrap.width() -confirm_diglog.width() )/2,
  });
  
  confirm_diglog.animate({
    'top': ( wrap.height() -confirm_diglog.height() )/2,
  },{ duration: 500 });
    
  setTimeout( function(){
    confirm_diglog.find('.tip_diglog_close').unbind();
    confirm_diglog.fadeOut("slow",function(){
      $(this).remove();
    });
  }, 3000 );  
  
  confirm_diglog.find('.tip_diglog_close').click(function(){    
    confirm_diglog.fadeOut("slow",function(){
      $(this).remove();
    });    
  })
}
/*c8ed6d21d94817d062662ea37da34b37 排序内容 init_content_sort */
function init_content_sort() {
  var wrap = '';
	$(".draggable_wrap").sortable({
	  handle: '.handle',
	  start: function(event, ui) { 		    	    
	    wrap = getPanel($(this));	    
	  },
		update: function(event, ui) {
			var fruitOrder = $(this).sortable('toArray').toString();			
			idebug( fruitOrder );
			formLay(wrap);
			var serial = wrap.find('.draggable_wrap').sortable('serialize');			
			$.ajax({
				type: "post",
				url: wrap.find('.sort_content_url').val(),
				data: serial,
				success: function(html) {										
					formLay(wrap,'h');
				}		
			});				
		}
	});
}
/*8a8bb7cd343aa2ad99b7d762030857a2  取得当前DOM给定的父元素 */
function parentOne(ele,exp){	  
  //if( ele.parent().find(exp).length > 0 ) {      
  if( ele.parent().find(exp).length > 0 || ele.hasClass(exp) ) {
    return ele;
  }else{
    return parentOne(ele.parent(), exp);
  }	      
}
/*693a9fdd4c2fd0700968fba0d07ff3c0 取得当前DOM的父元素中含有类mac_panel_wrap */
function getPanel(that){
  return parentOne(that,'.mac_panel_wrap');
}

/* TODO */
/* JAVASCRIPT_START */
/* 881518a1d877c78958dd6f7e7fe11f8c 全局变量定义*/
var x =y = 0, z = 1000000, distance = 25, wrap=null, parent_panel = null, class_ioverpanel = 'ioverpanel';
var ajax_str = '&ajax=ajax';	
var boolean_idebug = true;

function idebug(obj) {
  if( boolean_idebug ){
    if( $.browser.mozilla ){
      console.log(obj);  
    }
  }
}

function formLay(wrap,t){
  idebug('Call formLay');    
  if( wrap == null ){return;};
  if( t == 'h') {
    idebug('ajax overlay display ='+t);
    
    wrap.find('.ajax_overlay').hide();  
  }else{
    wrap.find('.ajax_overlay').css('z-index',z).show();
  }
}

function reload_tinymce(wrap_id) {
  $('#'+wrap_id+' textarea.mceEditor').tinymce({
			script_url : '/themes/classic/js/tiny_mce/tiny_mce.js',
		  theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			content_css : "/themes/forum/js/content.css",
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
      language : "zh",
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}, fullscreen_settings : {
        setup: function(ed) {
          $('#mce_fullscreen_container').css({'z-index': 200000000});
        },
      },
      setup : function(ed) {
        ed.addButton('example', {
          title: '上载图片/个人站内图片选择',
          class: 'mce_image',
          alt: '上载图片/个人站内图片选择',
          onclick: function() {
            $('.member-photos-pick').addClass('member-photos-loading').show();
            var uri = $('#member-photos-url').attr('href');
            $.ajax({
        			type: 'get',
			        cache: false,
          		url: uri,
          		success:function(html){			  
                $('.member-photos-pick').html(html);
                $('.member-photos-pick').removeClass('member-photos-loading');
			      }
		      });
          return false;
        }
      });
    }
  });
}
$(document).ready(function(){
/* tiny mce */

$('textarea.tinymce').tinymce({
     // Location of TinyMCE script
			script_url : '/themes/classic/js/tiny_mce/tiny_mce.js',

			// General options
		theme : "advanced",
//			plugins : "autolink,media,fullscreen",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			//theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,bullist,numlist,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,example,media,fullscreen,cleanup",
      //,|,justifyleft,justifycenter,justifyright,justifyfull,",
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
///			theme_advanced_buttons2 : "",
//			theme_advanced_buttons3 : "",
  			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
//			theme_advanced_buttons4 : "",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "/themes/forum/js/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
      language : "zh",
			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			},
      fullscreen_settings : {
        setup: function(ed) {
          $('#mce_fullscreen_container').css({'z-index': 200000000});
        },
      },
      setup : function(ed) {
        ed.addButton('example', {
          title: '上载图片/个人站内图片选择',
          class: 'mce_image',
          alt: '上载图片/个人站内图片选择',
          onclick: function() {
            $('.member-photos-pick').addClass('member-photos-loading').show();
            var uri = $('#member-photos-url').attr('href');
            $.ajax({
        			type: 'get',
			        cache: false,
          		url: uri,
          		success:function(html){			  
                $('.member-photos-pick').html(html);
                $('.member-photos-pick').removeClass('member-photos-loading');
			      }
		      });
          return false;
        }
      });
    }
  });

   
  
  /*02dcd9e5975fcca9ac9e448618e5cea4 放大图片 zoom_photo*/  
  $('.zoom_photo').live('click',function(){        
    var header = $('#FlatPanelHeader').val();
    var footer = $('#FlatPanelFooter').val();
    var img_html = "<div class='taC w100S'><img class='p2P' src='"+$(this).attr('href')+"' alt='' width='500' /></div>";
    var panel_html = "<div class='mac_panel_wrap w600P'>" + header + img_html + footer + "</div>";
    popup_panel( $(panel_html) );
    return false;
  })
  
  $('.choose_lang_wrap').hover(function(){  
  	if( $('.choose_lang_ul_wrap').css('display') != 'block' ) {
  	  $(this).attr('_z', $(this).css('z-index')).css('z-index', z+10);
  		$('.choose_lang_ul_wrap').attr('_z',$(this).css('z-index')).css('z-index',z+9).stop(true,true).slideDown();
  	}  	  
  },function(){
  });

  $('.choose_lang_ul_wrap').hover(function(){
  },function(){    
  	$(this).stop(true,true).slideUp('slow',function(){  	  
  	  $('.choose_lang_wrap').css('z-index',$('.choose_lang_wrap').attr('_z'));
  	  $(this).css('z-index', $(this).attr('_z'));
  	  //$(this).css('z-index',9999);
  	  //$('.choose_lang_wrap').css('z-index',$(this).attr('_z'));      
  	  
  	})
  })
  
  $('.advanced_search').live('click',function(){
    $('.'+$(this).attr('data')).toggle();
  });  
  
  $($('.ilogin_wrap .login_column_nav li')[0]).addClass('current');
  
  $('.ilogin_wrap .column_nav>ul>li').live('click',function(){
    var wrap = getPanel($(this));
    wrap.find(wrap.find('.column_nav>ul>li.current').removeClass('current').find('a').attr('data')).stop(true,true).slideUp();
    wrap.find( $(this).addClass('current').find('a').attr('data') ).stop(true,true).slideDown();
    return false;
  });
  
  /*
  $('.ilogin_wrap .column_nav>ul>li').each(function(){
    $(this).live('click',function(){
			$($('.column_nav>ul>li.current').removeClass('current').find('a').attr('data')).stop(true,true).slideUp();
			$($(this).addClass('current').find('a').attr('data')).stop(true,true).slideDown();
			return false;
		})
    
		$(this).click(function(){
			$($('.column_nav>ul>li.current').removeClass('current').find('a').attr('data')).stop(true,true).slideUp();
			$($(this).addClass('current').find('a').attr('data')).stop(true,true).slideDown();
			return false;
		});
		
	});	
	*/
	
	function isContentSelected(){
	  if( $('.cb_article:checked').length > 0 || $('.ele_item:checked').length > 0  ) {	    
	    return true;
    }else{
      return false;
    }
	}
	//var articels_action = false;	
	function renderArticlesActions() {
	  /*	  
	  if( _wrap != undefined ){
  	  if( _wrap.find('.cb_article:checked').length > 0 ) {
  	    _wrap.find('.iactions').addClass('hover');
  	  }else{
  	    _wrap.find(('.iactions').removeClass('hover');
  	  }	  
	  }*/
	};
	
	/*a8866c09a3ff02198ac19d9759cf9e70  attachment pick handle*/	
	var ithis;
	$('.pick').live('click',function(){
	  ithis = this;
	  if( $(this).attr('rtype') == undefined ){	    
	    var uri = $(this).attr('uri');		
	  }else if( $(this).attr('rtype') == 'article_link_image' ){
	    var uri = $(this).attr('uri')+'&rtype='+$(this).attr('rtype');
	  }	  
		wrap = getPanel($(this));		
		var popup_panel_id = 'prefix_'+$(this).attr('id');
	  if( isExist( popup_panel_id ) ) {	    
	    return false;
	  }
		$.ajax({
			type: 'get',
			cache: false,
			url: uri,
			success:function(html){			  
			  popup_panel( $(html).attr('id',popup_panel_id) );
			}
		});
	});		
	
	$('.search_form').live('submit',function(){	  
	  wrap = getPanel( $(this) );
	  var that = $(this);
	  var url = that.attr('action')+ ajax_str +'&keyword='+that.find('.keyword').val();
	  if( that.find('.leaf_id').length > 0 ){
	    url += "&leaf_id="+that.find('.leaf_id').val();
	  }
	  if( that.find('.is_include').length > 0 ){	    
	    if( that.find('.is_include').is(":checked") ){
	      url += "&is_include="+that.find('.is_include').val();
      }
	  }
	  if( that.find('.model_type').length > 0 ){	    	    
	    url += "&model_type="+that.find('.model_type').val();      
	  }
	  if( that.find('.cur_leaf_id').length > 0 ){	    	    
	    url += "&id="+that.find('.cur_leaf_id').val();      
	  }	  	  
	  $.ajax({
	    type: that.attr('method'),
	    cache: false,
	    url: url,
	    success:function(html){
	      if( wrap.find('.leaf_content').length > 0 ){
	        wrap.find('.leaf_content').html(html);  
	      }else if( wrap.find('.search_result_wrap').length > 0 ) {
	        wrap.find('.search_result_wrap').html(html);  
	      }
	     // wrap = null;
	    }
	  })
	  return false;
	});
	
	/* 3adf93e4b9161c1409b6bc3e228c9439 返回关联图片 return attachment pick   */
	$('.rpick').live('click',function(){	  
	  var wrap = getPanel($(this));
	  wrap.find('li.active').removeClass('active');	  
	  $(this).addClass('active');	  
	  wrap.find('.rel_gavatar').attr('src', $(this).attr('rel_gavatar') ).attr('title',$(this).attr('rel_screen_name')).show();
	  wrap.find('.rel_imagerange').html( $(this).find('select').html() ).show();
	  wrap.find('.rel_id').val( $(this).attr('rel_id') );	  
	  wrap.find('.rel_screen_name').val( $(this).attr('rel_screen_name') );
	  wrap.find('.rel_path').val( $(this).attr('rel_path') );
	  wrap.find('.rel_extension').val( $(this).attr('rel_extension') );
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
	  if( return_wrap.find('.unlink_default_collect').length > 0 ){
	    return_wrap.find('.unlink_default_collect').hide();  
	  };
	  wrap.remove();
	});

  //todo 
	$('.att_return_submit').live('click',function(){
	  var wrap = getPanel($(this));	
	  var rel_gavatar = wrap.find('.rel_gavatar').attr('src');
	  // return_wrap = form td column
	  var return_wrap = $('#'+wrap.find('.return_id').val()).parent().next();
	  var parent_panel = getPanel(return_wrap);
	  if( return_wrap.find('.unlink_default').length > 0 ) {
	    return_wrap.find('.unlink_default').hide();
	  }
	  var rel_path        = wrap.find('.rel_path').val();
	  var rel_extension   = wrap.find('.rel_extension').val();
	  var rel_imagerange  = wrap.find('.rel_imagerange').val();
	  var rel_id          = wrap.find('.rel_id').val();
	  var rel_screen_name = wrap.find('.rel_screen_name').val();	  
	  var rtype           = wrap.find('.rtype').val();
	  var upfiles_dir     = wrap.find('.upfiles_dir').val();
	  if( rtype == '' ){	    
	  }else if( rtype == 'article_link_image' ){  	    
      //alert("!!!!");
	    //alert(parent_panel.find('.widgEditor_id').val());
	    var image = upfiles_dir + rel_path+rel_imagerange+'.'+rel_extension;	    
	   // var str = '!['+rel_screen_name+ ']('+image+' "'+rel_screen_name+'")';
	    var img_html = "<img alt=\"" + image + "\" src=\"" + image + "\" />"
//      $("#article_contentfuck").tinymce().execCommand("mceInsertContent",false,"<b>fuck</b>");
      //$("#article_contentfuck").tinymce().execCommand("mceInsertContent",false,img_html);
      //$("#article_contentfuck").tinymce().execCommand("mceInsertContent",false,"<B>--------------</B>");
	    $(parent_panel.find('.widgEditor_id').val()).tinymce().execCommand('mceInsertContent',false,img_html);
      //parent_pane.find(".mceEditor").tinymce().execCommand('mceInsertContent',false,img_html);
	    //widgSetContent(parent_panel.find('.widgEditor_id').val(), image,str );	    
	    return ;
	  }
	  var str = 'ID:'+rel_id +"\n"+ ' NAME:'+rel_screen_name;
	  
	  /*display the select thumbnail*/
	  return_wrap.find('.dest_thumbnail').find('img').attr('src', rel_gavatar).attr('title', str);
	  /*relation the select id */
	  var input_default_value = return_wrap.find('input').val();
	  return_wrap.find('input').attr('value', rel_id);	
	  return_wrap.find('.unlink_dest').attr('origin_value',input_default_value);
	  return_wrap.find('.dest_thumbnail').show();
	  wrap.remove();
	});

	$('.reset_default_collect').live('click',function(){
	  $(this).parent().find('span').show();
	  //$(this).prev().show();
	  $(this).parent().parent().find('input').attr('value', $(this).attr('rel_id') );
	  $(this).hide();	  
	});
	
	$('.reset_default').live('click',function(){
	  $(this).parent().find('img').show();
	  $(this).parent().find('span').show();	  
	  $(this).parent().parent().find('input').attr('value', $(this).attr('rel_id') );
	  $(this).hide();
	  //$(this).prev().show();
	});
	
	$('.unlink_collect').live('click',function(){
	  var return_wrap =$(this).parent().parent();
	  var input = return_wrap.find('input');
	  input.attr('value', $(this).attr('origin_value') );
	  $(this).attr('origin_value','');
	  if( return_wrap.find('.unlink_default_collect').length > 0 ){
	    return_wrap.find('.unlink_default_collect').show();  
	  }
	  $(this).parent().hide();
	});
	
	$('.unlink_dest').live('click',function(){
	  $(this).prev().attr('src','');
	  var return_wrap = $(this).parent().parent();
	  if( return_wrap.find('.unlink_default').length > 0 ){
	    return_wrap.find('.unlink_default').show();
	  }
	  var input = return_wrap.find('input');
	  input.attr('value', $(this).attr('origin_value') );
	  $(this).attr('origin_value','');
	  $(this).parent().hide();
  });
  
  $('.unlink_default_collect').live('click',function(){
    $(this).hide();    
    var prev = $(this).prev().hide();    
    //return_wrap = div.origin_collect
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

/* 0a0313640368beb1dd3f7fbc9f42e93a 节点排序 category_sortable     */
function category_sortable() {      
  var wrap = '';
	$(".category_sortable").sortable({
	  placeholder: 'ui-state-highlight',
	  start: function() {
	    $(".category_sortable p span.leaf").unbind();
	    prevPagesOrder = $(this).sortable('toArray');
	    wrap = getPanel($(this));
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
	    formLay(wrap);
	    $.ajax({
				type: 'get',  				
				url:	wrap.find('.url_sort_leaf').val()+'&id1='+first.attr('data_id')+'&id2='+id2,
				cache:	false,
				success:	function(html){						
					if( html.indexOf('STOP') != -1 ){
						$_this.show().attr('style','');										
					}else{
					}			
					bindLeafClick();
					formLay(wrap,'h');
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
	    if( $(this).attr('data_id') == wrap.find('.top_leaf_id').val() ){
	      wrap.find('.ele_del_leaf').removeClass('active');
	      wrap.find('.ele_move_leaf').removeClass('active');
	      wrap.find('.ele_update_leaf').removeClass('active');  	      
	    }else{
	      wrap.find('.ele_del_leaf').addClass('active');
	      wrap.find('.ele_move_leaf').addClass('active');
	      wrap.find('.ele_update_leaf').addClass('active');
	    }  	    
	    var url = wrap.find('.ele_refresh_url').val() +'&model_type='+wrap.find('.model_type').val()+'&ajax=ajax&id=' + $(this).attr('data_id');  	    
	    wrap.find('.cur_leaf_id').val( $(this).attr('data_id') );
	    $('.api_categorys_ul p.tree_leaf_current').removeClass('tree_leaf_current');
	    $(this).parent().addClass('tree_leaf_current');  	      	    
	    $.ajax({
          type: 'get',
          dataType: 'html',
          cache: false,            
          url: url,
          success: function(html) {
            if( wrap != null )                {
              wrap.find('.leaf_content').html(html);
              wrap.find('.ele_list_all').attr('checked',false);
            }
            //$('#leaf_articles').html(html);                             
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
	/*
	* display the children datablock 
	*/	
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
	
	/*mac_panel_click = function(){	  */
	$('.mac_panel_wrap').live('click',function(){
    var cur_z = $(this).css('z-index');
    idebug( 'init ' + cur_z );
    idebug( 'reset' + z );	    
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
	  var wrap = getPanel($(this));
	  var _div = parentOne( wrap.find('.move_category_id'),'div');	  
	  if( _div.css('display') != 'block' ){
	    _div.slideDown();
	  }
	  wrap.find('.move_category_id').val( $(this).attr('rel_id') );
	  wrap.find('.move_category_name').val( $(this).attr('rel_name') );
	  wrap.find('.tree_leaf_current').removeClass('tree_leaf_current');
  	$(this).addClass('tree_leaf_current');	     
	  
	})
  
  /*d7c8386e98d5b2185c276b93b32c84e3 编辑节点*/	
	$('.ele_update_leaf').live('click', function() {			  
	  if( !$(this).hasClass('active') ){
	    alert(G_TOP_LEAF_CANT);
	    return false;
	  }
		var parent_panel =  wrap = getPanel($(this));		
		var that = $(this);
		var leaf_panel_id = 'leaf_panel_'+wrap.find('.cur_leaf_id').val();		
		if( isExist( leaf_panel_id) ){
		  return false;
		}
		
		var url = $(this).attr('href')+'&model_type='+wrap.find('.model_type').val()+'&ajax=ajax&id='+wrap.find('.cur_leaf_id').val() +'&panel_ident='+wrap.attr('id');
		$.ajax({
			type:		"get",
			url:		url,
			cache:  false,
			success:	function(html) {
			  popup_panel( $(html).attr('id', leaf_panel_id) );
			},
			complete: function(){
			  deteFormLay(parent_panel,that);
			}
		});
		return false;
	});	
	
	/* 137b2dfd2e8ecf4ddc2ef2b1e78ac3b4 提交删除节点 */
	
	$('.ele_del_leaf').live('click',function(){
	  //首节点不能删除
	  parent_panel = wrap = getPanel($(this));
	  if( wrap.find('.top_leaf_id').val() == wrap.find('.cur_leaf_id').val() ){	 
	    alert(G_TOP_LEAF_CANT);
	    return false;
	  }
	  
	  var that = $(this);	  
	  iconfirm('Are you Really want to delete the item?');
	  var url = that.attr('href')+'&ajax=ajax&id='+wrap.find('.cur_leaf_id').val();
	  wrap.find('.confirm_dialog_okay').click( function() {
      hideConfirm(wrap);
      $.ajax({
        type 		: 	"POST",
  			url	 		: 	url,
  			data		: 	"ids="+wrap.find('.cur_leaf_id').val(),
  			dataType 	:	'html',
  			success		:	function(html){  				
  				renderPartLeafs(html);
  			}  
      });
    });
    
	  wrap.find('.confirm_dialog_cancel').click( function() {
      hideConfirm(wrap);
      formLay(wrap,'h');
      wrap = null;
    })
    
		return false;				
	})
	
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
	function render(str) {	  
	  if( parent_panel ){	    
	    if( parent_panel.find('.leaf_content').length > 0 ){
	      var url = parent_panel.find('.ele_refresh_url').val()+'&model_type='+parent_panel.find('.model_type').val()+'&ajax=ajax&id='+parent_panel.find('.cur_leaf_id').val();	      
	    }else {
	      var url = parent_panel.find('.ele_refresh_url').val() ; 
	    }
	  }
	  else if( wrap.find('.return_panel').length > 0 && wrap.find('.return_panel').val() != "") {	   	   	    	    
	    parent_panel = $('#'+wrap.find('.return_panel').val());
	    var url = parent_panel.find('.ele_refresh_url').val();	    
	    
	  }else if( wrap.find('.ele_refresh_url').length > 0 ) {	    	    
	    parent_panel = wrap;
	    if( wrap.find('.leaf_content').length > 0 ){	 	      
	      var url = wrap.find('.ele_refresh_url').val()+'&model_type='+wrap.find('.model_type').val()+'&ajax=ajax&id='+wrap.find('.cur_leaf_id').val();
	    }else{
	      var url = wrap.find('.ele_refresh_url').val() ;  	      
	    }	    
	  } else {	    	    
  	  var url = '/index.php?r=admin/category/view&model_type='+wrap.find('.model_type').val()+'&ajax=ajax&id='+wrap.find('.cur_leaf_id').val();  	    	  
  	}	  
  	if( parent_panel && parent_panel.find('.ele_list_all').length > 0  ){
  	  parent_panel.find('.ele_list_all').attr('checked',false);  
  	}  	
	  $.ajax({
        type      : 'get',
        dataType  : 'html',
        cache     : false,
        url       : url,
        success   : function(html) {     
          idebug( 'search_result_wrap length = '+parent_panel.find( '.search_result_wrap').length  );
          if( parent_panel ) {
            formLay(parent_panel,'h');
          }
          if( parent_panel.find('.leaf_content').length > 0  ){                   
            idebug(' update leaf content');
            parent_panel.find('.leaf_content').html(html);            
          }
          else if( parent_panel.find('.search_result_wrap').length > 0 ){            
            idebug(' update leaf search_result_wrap ');
            parent_panel.find('.search_result_wrap').html(html);
          }else{
            wrap.find('.leaf_articles').html(html);            
          }
          if( str ){     
            uploadTips(parent_panel, str);
          }
        }
    });
	}
	
	//fun19
	function renderPartLeafs(str) {	  
	  var url = parent_panel.find('.leaf_render_url').val();
	  $.ajax({
			type:		"get",
			url:		url,
			cache: false,			
			success:	function(html) {			
			  parent_panel.find('.icategory_tree').html( html );	
			  if( str ){            
			    formLay(parent_panel,'h');
          uploadTips(parent_panel, str);
        }		  
			},
			complete: function(){
			  category_sortable();
			  bindLeafClick();
			}
		});
	}
	
	$('.ajax_form').live('submit',function(){	  
		idebug( 'ajax_form submit');		
		
		var that = $(this);
		var leaf_id = $('#Article_category_id').val();
		$dialog = parentOne(that,'.ui-dialog-content');				
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
	  alert("view_ele");
		var that = $(this);
		jQuery.ajax({
			'type'		:'get',
			'dataType' 	:'html',
			'cache'		:false,
			'url'		:'/index.php?r=admin/category/view&ajax=ajax&id='+that.attr('data'),
			'success'	:function(html) { 				
				//$('#leaf_articles').html(html);				
			}
			//'data'		:that.serialize(),						
		});				
		return false;
	});
	
	
	//98f13708210194c475687be6106a3b84  移动节点
	$('.ele_move_leaf').live('click',function(){
	  var parent_panel = wrap = getPanel($(this));
	  if( !$(this).hasClass('active') ){
	    alert(G_TOP_LEAF_CANT);
	    return false;
	  }
	  wrap = getPanel($(this));	  
	  var that = $(this);
	  $.ajax({
	    type: 'get',
	    cache: false,
	    url:    $(this).attr('href')+'&top_leaf_id='+wrap.find('.top_leaf_id').val()+'&panel_ident='+wrap.attr('id'),	    
	    success: function(html){	      
	      popup_panel( $(html) );	      
	    },
	    complete: function(){
			  //formLay(parent_panel,'s');
			  deteFormLay(parent_panel , that);	  
			}	    
	  });
	  return false;
	})
	//98f13708210194c475687be6106a3b84  提交移动节点
	$('.leaf_move_form').live('submit',function(){	  	  
	  wrap = getPanel($(this));		
	  parent_panel = $('#'+wrap.find('.return_panel').val());	  
	  $.ajax({
			type: "post",
			cache: false,
			data:		$(this).serialize()+"&cur_leaf_id="+parent_panel.find('.cur_leaf_id').val(),
			url: $(this).attr('action'),
			success:	function(html){
			  if( html.indexOf('mac_panel_wrap') != -1 ){
			    wrap.html( html);
			  }else{  			  
  			  wrap.remove();
			  }
        renderPartLeafs(html);
			}
		});
		return false;
	});
  
	
	function reset_panel_postion(){	  	
	  z++;  
	  if( x >= 250 ){
	    x = y = 0;	    
	  }	  
	  x = y += distance;
	}

  function iconfirm(str) {      
    if( wrap == null ){
      alert(G_WRAP_NULL_WRAN_STR);
      return;
    }
    formLay(wrap);
    var confirm_diglog = $('<div class="confirm_diglog p10P" />').html('<h1 class="fs16P">'+str+'</h1>');
    confirm_diglog_ibtn_wrap = $('<div class="taR mt10P" >');
    confirm_diglog_ibtn_wrap.append( $('<input class="ibtn blue confirm_dialog_okay" type="button" value="'+G_OKAY_STR+'" />') );
    confirm_diglog_ibtn_wrap.append( $('<input class="ibtn blue confirm_dialog_cancel" type="button" value="'+G_CANCEL_STR+'" />') );        
    confirm_diglog.append( confirm_diglog_ibtn_wrap );    
    confirm_diglog.addClass('radius7 ');
    confirm_diglog.addClass('boxshadow ');
    wrap.append( confirm_diglog );    
    confirm_diglog.css({ 'position' : 'absolute', 'background' : '#FFF', 'z-index': z })    
    confirm_diglog.css({
      'top': 0,
      'left': ( wrap.width() -confirm_diglog.width() )/2,
    });
    
    confirm_diglog.animate({
      'top': ( wrap.height() -confirm_diglog.height() )/2,
    },{ duration: 500 });
  }
  
	function popup_panel(ele,_wrap) {
	  if( _wrap != null ) {	    
	    x = parseInt(_wrap.css('left'));	    
	    y = parseInt(_wrap.css('top') );	    
	    z++;
	    //z = parseInt(_wrap.css('z-index'))+1;	
	    _wrap.remove();
	  }else{
	    reset_panel_postion();	  
    }
	  $('body').append( ele );	  
	  ele.css({	    
	    left: x+'px',
	    top: y+'px',
	    'z-index': z,
	    position: 'absolute'
	  });
	  if( ele.find('.article_ajax_form').length > 0 ){
	    ele.find('.article_ajax_form').submit(form_submit);  
	  }
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
    if( wrap != null ) {            
      formLay(wrap,'h'); 
      if ( wrap.find('.confirm_diglog').length > 0 ){
        wrap.find('.confirm_diglog').remove(); 
      }
      wrap = null;      
    }
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
	
	/*4e134a399e16e6edf848985f4b93e107 取得当前的文章ids*/
	function get_ids(){
	  var _temp_ids = '';
	  $('.cb_article,.ele_item').each(function(){
		  if( $(this).is(":checked") ){
		    if( _temp_ids == "") {
				  _temp_ids += $(this).val();
			  }else {
				  _temp_ids += ','+$(this).val();
			  }	
		  }
		});
		return _temp_ids;
	}
	
	
  
  function getParentPanleByWrap(wrap){
	if( wrap.find('.return_panel').length > 0 && wrap.find('.return_panel').val() != "" ){    
      return $('#'+wrap.find('.return_panel').val());  
    }else{    
      return null;
    }
  }
  
  function isExist(panel_id){    
    if( $('#'+panel_id).length == 1 ){
      $('#'+panel_id).css({'z-index':++z});
      return true;
    }
    return false;
  }
  
  function hideConfirm(wrap){
    wrap.find('.confirm_diglog').remove();
  }
 
  
  function formError(wrap){
    wrap.find('.errorSummary').hide();
    wrap.find('.errorMessage').hide();
  }
  
  function deteFormLay(wrap, that){
    if( wrap != null && that != null ){     
      if( that.hasClass(class_ioverpanel) && wrap.find('.ajax_overlay').length > 0 ){
        formLay(wrap);
      }
    }
  }  
  
  /*9d607a663f3e9b0a90c3c8d4426640dc 类mac_panel_wrap DOM的 关闭 , 最小化, 最大化事件 */
  var wrap_remove = function(){
    wrap.remove();
  };
	$('.mac_panel_wrap .close').live('click',function(){
	  var wrap = getPanel($(this));
	  formLay(getParentPanleByWrap(wrap),'h');
	  wrap.remove();
	});	
	$('.mac_panel_wrap .min').live('click',function(){
	  getPanel($(this)).slideUp();
	});	
	$('.mac_panel_wrap .max').live('click',function(){		  
	  var h = $(window).height()+'px';
	  var wrap = getPanel($(this));
	  if( wrap.css('width') != '100%' ) {
	    wrap.attr('_width', wrap.css('width'))
	    .attr('_height', wrap.css('height'))
	    .attr('_top',wrap.css('top'))
	    .attr('_left', wrap.css('left'))
	    .css({
  	    width: '100%',	    
  	    top: 0,
  	    left: 0
  	  })
	  }else{
	    wrap.css({
	      width:  wrap.attr('_width'),	      
	      height: wrap.attr('_height'),
	      top:    wrap.attr('_top'),
	      left:    wrap.attr('_left')
	    })
	  }	  
	});
	
	/*8a161950585ef087328ba6dd992caac1 navigation 点击导航*/
	$('#mainmenu>ul>li>a').click(function(){
	  if( $(this).attr('data') != undefined ){
	    var url = $(this).attr('href')+ajax_str;  	    
	    var ident_panel= $(this).attr('data');
		  if( isExist(ident_panel) ){
		    return false;
		  };
		  $.fn.imasker({
        'z-index'	   : z+10,
        'background' :'#000 url(/images/load.gif) no-repeat 50% 50%',
      });   
      $.ajax({
  	    type: 'get',
  	    cache: false,
  	    url: url,
  	    global : false,   	    
  	    success: function(html){
  	      popup_panel( $(html).attr('id',ident_panel ) );
  	      if( url.indexOf('admin/category')!= -1 ){
  	        bindLeafClick();
  	      }
  	      $.fn.imasker_hide();
  	    }
  	  });
	    return false;
	  }	  
	});
	
	/* 32cfe6c19200b67afb7c3d0e1c43eadb 新建条目(文章, 节点, 用户 === )  */
	var fun_item_new = function () {
	  parent_panel =  wrap = getPanel($(this));	  
	  if( wrap.find('.model_type').val()== "attachment" && $(this).attr('href').indexOf('category/create') == -1 ){	
      if( wrap.find('.attachment_form_wrap').length > 0 ){
        if( wrap.find('.attachment_form_wrap').css('display') == 'block' ){
          wrap.find('.attachment_form_wrap').hide();
        }else{
          wrap.find('.attachment_form_wrap').show();
        }
      }
	    wrap.find('.attachment_form_wrap').show();	    
	    return false;
	  }
	  
	  var panel_model = wrap.find('.model_type');	  
	  var url = $(this).attr('href')+'&ajax=ajax&id=1&leaf_id='+wrap.find('.cur_leaf_id').val()+'&panel_ident='+wrap.attr('id');
		$.ajax({
			type:		"get",
			url:		url,
			cache: false,
			success:	function (html) {			  
			  popup_panel( $(html) );
			  init_mac_panel_drag();
			  widgInit();
			}			
		});
		return false;
	};
	
	$('.ele_create_article,.ele_create,.ele_create_leaf').live('click',fun_item_new);		
	
	$('.create_article_continue,.ele_create_continue').live('click',function(){
	  wrap = getPanel($(this));	  
	  var panel_ident = wrap.find('.return_panel').val();
	  parent_panel = $('#'+panel_ident);	  
	  //wrap.remove();
	  $.ajax({
			type:		"get",
			url:		$(this).attr('href')+'&ajax=ajax&id=1&leaf_id='+parent_panel.find('.cur_leaf_id').val()+'&panel_ident='+panel_ident,
			success:	function (html) {			  
			  popup_panel( $(html) ,wrap);
			  init_mac_panel_drag();				  
			  widgInit();
			}			
		});
	  return false;	  
	});
	$('.edit_article_continue').live('click',function(){
	  wrap = getPanel($(this));	  
	  var panel_ident = wrap.find('.return_panel').val();
	  //wrap.remove();
	  var url = $(this).attr('href')+'&panel_ident='+panel_ident;
	  $.ajax({
			url:	url,
			type:	'get',
			cache:	false,
			success:	function(html){
			  popup_panel( $(html),wrap );		
			  init_mac_panel_drag();
			  widgInit();
			}
		});
		return false;
  });
	
	/* b44da0a79dce2105c33f132c44842c28 移动文章 */
	$('.ele_content_move').click(function(){
	  parent_panel = wrap = getPanel($(this));
	  var leaf_panel_id = 'move_leaf_panel_'+ wrap.find('.top_leaf_id').val();
	  var url = $(this).attr('href')+'&top_leaf_id='+wrap.find('.top_leaf_id').val()+'&panel_ident='+wrap.attr('id');  
		if( isExist( leaf_panel_id) ){
		  return false;
		}
		$.ajax({
			type:	'get',
			url:	url,
			cache:	false,
			success:	function(html){
			  popup_panel( $(html).attr('id',leaf_panel_id) );			  
			  
			},
			complete: function(){
			  formLay(parent_panel,'s');
			}
		})		
				
		return false;
  });	
	
	/* eeab0810def3336d891534c6bf06c26e  提交移动文章*/
	$('.ajax_move_form').live('submit',function(){
	  wrap = getPanel($(this));		
	  parent_panel = $('#'+wrap.find('.return_panel').val());	  
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
			    //dialog.addClass('feedback_on').html(html).show();
			    //setTimeout( "dialog.slideUp()" , 3000 );			    
			    wrap.remove();
			  }
				render(html);
			}
		});
		return false;
	});
	
	/* f1ce042a27aa18b121377beab2615c57 删除文章*/
	/* 445a7cc846392ddd2a897553267de1ca 拷贝文章*/
	$('.ele_delete,.ele_copy,.ele_stared,.ele_unstared').live('click',function(){	  
	  parent_panel = wrap = getPanel($(this));
	  var that = $(this);	  
	  if( $(this).hasClass('ele_delete') ){
	    iconfirm(G_DELETE_STR);
	  }else if( $(this).hasClass('ele_copy') ){
	    iconfirm(G_COPY_STR);
	  }else if( $(this).hasClass('ele_stared')  ){
	    iconfirm(G_STARTED_STR);
	  }else if( $(this).hasClass('ele_unstared')  ){
	    iconfirm(G_UNSTARTED_STR);
    }
    wrap.find('.confirm_dialog_okay').click( function() {
      hideConfirm(wrap);
      var ids = get_ids();
		  var url = that.attr('href');
  		$.ajax({
  			type 		: 	"POST",
  			url	 		: 	url,
  			data		: 	"ids="+ids,
  			dataType 	:	'html',
  			success		:	function(html){  			  
  			  render(html);
  			}			
  		});
    });
    wrap.find('.confirm_dialog_cancel').click( function() {
      hideConfirm(wrap);
      formLay(wrap,'h');
      parent_panel = wrap = null;
    })
		return false;
	});
	
	/*864577c5de51168219098730aff9add0 批量编辑附件*/
	$('.ele_update_atts').live('click',function(){
	  wrap = getPanel($(this));
	  var leaf_panel_id = 'update_atts_leaf_panel_'+wrap.find('.top_leaf_id').val();
		if( isExist( leaf_panel_id) ){
		  return false;
		}
	  var ids = get_ids();
	  var url = $(this).attr('href')+"&ids="+ids
		$.ajax({
			type:	'get',
			url:	url,
			cache:	false,
			success:	function(html){
			  popup_panel( $(html).attr('id',leaf_panel_id) );	
			}
		})		
		return false;
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
	  wrap = getPanel($(this));	  
	  var url = $(this).parent().attr('rel_href')+"&panel_ident="+wrap.attr('id');  
	  idebug(' model_type = '+wrap.find('.model_type').val() );
	  var popup_panel_id = wrap.find('.model_type').val()+$(this).attr('data');
	  if( isExist( popup_panel_id ) ) {	    
	    return false;
	  }
	  formLay(wrap);
		$.ajax({
			url:	url,
			type:	'get',
			cache:	false,
			success:	function(html){
			  popup_panel( $(html).attr('id',popup_panel_id) );		
			  init_mac_panel_drag();
        reload_tinymce(popup_panel_id);;
			  //widgInit();
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
	function form_submit(){	  
	  //alert( document.getElementById('article_content').value );
	  
	  if( timeouthandle != undefined ){
	    clearTimeout(timeouthandle);  
	  }	  
		var that = $(this);
		//var leaf_id = $('#Article_category_id').val();	
		wrap = getPanel($(this));						
		widgUpdate( wrap.find('.widgEditor_id').val() );
		parent_panel = '';
		if( wrap.find('.return_panel').length > 0 ){
		  if( wrap.find('.return_panel').val() != '' ){
		    parent_panel = $('#'+wrap.find('.return_panel').val());		    
		  }
		}		
		var iform = wrap.find('.panel_middle .middle .iform');				
		dialog = wrap.find('.panel_middle .middle .feedback');				
		dialog.html('');		
		$.ajax({
			type:		"post",
			url:		$(this).attr('action'),
			data:		$(this).serialize(),
			success:	function(html) {		  
			  if( html.indexOf('mac_panel_wrap') != -1 ){				    
			    popup_panel( $(html) , wrap );
			  }else{			    			    
			    //iform.replaceWith(html);			    				    
			    iform.html(html);			    
			    
			    if(iform.find('.article_ajax_form').length >0) {
			      iform.find('.article_ajax_form').submit( form_submit );  
			    }			    
			    if( that.attr('action').indexOf('admin/category') > 0 ){	
			      idebug( ' renderPartLeafs ' );
			      renderPartLeafs();
		      }else if(that.attr('action').indexOf('setting') > 0 ) {
		      }
		      else{		        
		        idebug( ' render ');
		        render();
		      }
			  }			 
			  widgInit(); 
			}
		});				
		return false;
	}	
	
	$('.article_ajax_form').submit(form_submit);
	
	
	$('.actions>li').live('hover',function(){	  
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
	      $(this).next().find('.c_m_a_d_tip').show();
	      $(this).next().find('.c_m_a_d_batch').hide();
	    } 
	  }
	  $(this).next().css({'z-index': z-1}).show();
	});	
  
	$('.ele_list_all').live('click',function(e){	  
	  var wrap = getPanel($(this));	  
	  //$(e.target).hasClass('ele_list_all')
    if( $(this).is(':checked') ){
    wrap.find('.ele_item').attr('checked',true);
    wrap.find('.cb_article').attr('checked',true);	
    }else{
      wrap.find('.ele_item').attr('checked',false);
      wrap.find('.cb_article').attr('checked',false);	    
    }	  
	  e.stopPropagation();	  	      
	});	
	
	$('.c_s_m_d_a').live('click',function(){
	  var wrap = getPanel($(this));
	  wrap.find('.cb_article').attr('checked',true);
	  wrap.find('.ele_list_all').attr('checked',true);
	});
	$('.c_s_m_d_n').live('click',function(){
	  var wrap = getPanel($(this));
	  wrap.find('.cb_article').attr('checked',false);
	  wrap.find('.ele_list_all').attr('checked',false);
	});
	
	/*d606a89c78a6a590167232caea08fa68  更新图片尺寸 */	
	$('.new_resize').live('click',function(){
	  var li = $(this).parent().next().clone()
	  li.find('input').val('');
	  $(this).parent().parent().append(li);
	});
  
	/*1c2b34ce8da621bd000a66c29c84ad6d 显示附件的外链 */
  $('.extra_link_ele').live('click',function(){
    var _wrap = getPanel($(this));
    _wrap.find('.extra_link_area_outer').val( $(this).attr('link_outer') );
    _wrap.find('.extra_link_area_inner').val( $(this).attr('link_inner') );
  });	
  
  new function($) {
  $.fn.setCursorPosition = function(pos) {
    if ($(this).get(0).setSelectionRange) {
      $(this).get(0).setSelectionRange(pos, pos);
    } else if ($(this).get(0).createTextRange) {
      var range = $(this).get(0).createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  }
}(jQuery);

  $('.replace').live('click',function(e){
    /*
    setCaretToPos($('#Article_content'),4);
    */
    $('#Article_content').replaceSelection('Foo', true);
    //$.each($('#Article_content'), iupdate);
    setCaretToPos(document.getElementById('Article_content'),4);
    e.preventDefault();    
  });
  function iupdate(){
    var range = $(this).getSelection();    
    //setCaretToPos($(this),4);   
  }
	
  function setCaretToPos (input, pos) {
    setSelectionRange(input, pos, pos);
  }

  function setSelectionRange(input, selectionStart, selectionEnd) {
    if (input.setSelectionRange) {
      input.focus();
      input.setSelectionRange(selectionStart, selectionEnd);
    }
    else if (input.createTextRange) {
      var range = input.createTextRange();
      range.collapse(true);
      range.moveEnd('character', selectionEnd);
      range.moveStart('character', selectionStart);
      range.select();
    }
  }
  
  $('.ipagination select').live('change',function(){    
    wrap = getPanel( $(this) );
	  var that = $(this);	  
	  var url = that.val();
	  if( url.indexOf('keyword') == -1 ) {
	    url += '&keyword=';
	  }
	  $.ajax({
	    type: that.attr('method'),
	    cache: false,
	    url: url,
	    success:function(html){	      
	      if( wrap.find('.search_result_wrap').length > 0 ){
	        wrap.find('.search_result_wrap').html(html);  
	      }else if( wrap.find('.leaf_content').length > 0 ) {
	        wrap.find('.leaf_content').html(html);  	        
	      }
	    }
	  })
    return false;
  })
  
  $('.ipagination .yiiPager li a').live('click',function(){
    if( $(this).parent().hasClass('hidden') ){
      return false;
    }
    wrap = getPanel( $(this) );
	  var that = $(this);	  
	  var url = that.attr('href');
	  if( url.indexOf('keyword') == -1 ) {
	    url += '&keyword=';
	  }
	  $.ajax({
	    type: that.attr('method'),
	    cache: false,
	    url: url,
	    success:function(html){
	      if( wrap.find('.search_result_wrap').length > 0 ){
	        wrap.find('.search_result_wrap').html(html);  
	      }else if( wrap.find('.leaf_content').length > 0 ) {
	        wrap.find('.leaf_content').html(html);  	        
	      }
	    }
	  })
    return false;
  });

  $('.ele_refresh').live('click',function(){
    wrap = getPanel( $(this) );
    var that = $(this);
    var url = wrap.find('.ele_refresh_url').val();  
    if( wrap.find('.leaf_content').length > 0 ){
      url += '&model_type='+wrap.find('.model_type').val()+'&ajax=ajax&id='+wrap.find('.cur_leaf_id').val();
    }
    $.ajax({
	    type: 'get',
	    cache: false,
	    url: url,
	    success:function(html){
	      if( wrap.find('.leaf_content').length > 0 ){
	        wrap.find('.leaf_content').html(html);
	      }else{
	        wrap.find('.search_result_wrap').html(html);  
	      }
	    }
	  })
    return false;  
  });  
});
