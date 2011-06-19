$(document).ready(function(){
  function parentOne(ele,exp){	  
    if( ele.parent().find(exp).length > 0 || ele.hasClass(exp) ) {
      return ele;
    }else{
      return parentOne(ele.parent(), exp);
    }	      
  }

  function getPanel(that){ return parentOne(that,'.mac_panel_wrap'); }
	function get_ids(){
	  var _temp_ids = '';
	  $('.item-sep').each(function(){
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

  function url_refresh() {
    window.location.href = window.location.href;
  }


  $('.batch_move').live('click',function() {
    $.ajax({
      type: 'post',
      url: $('.batch_form').find("input[value=移动]").attr('uri'),
//      data: 'ids='+get_ids()+'&category_id='+$('.move_category_id').val(),
      data: $('.batch_form').serialize()+'&category_id='+$('.move_category_id').val(),
      success: function(html) {
        url_refresh();
      }
    });
  });

	$('.unlink_default').live('click',function(){
	  var prev = $(this).prev().hide();	  		  
	  var return_wrap = $(this).parent().parent().parent();
	  var input = return_wrap.find('input');	  
	  input.attr('value', $(this).attr('origin_value') );
	  $(this).hide();
	  $(this).next().css('display','block');
	});
	$('.unlink_dest').live('click',function(){
	  $(this).prev().attr('src','');
	  var return_wrap = $(this).parent().parent().parent();
	  if( return_wrap.find('.unlink_default').length > 0 ){
	    return_wrap.find('.unlink_default').show();
	  }
	  var input = return_wrap.find('input');
	  input.attr('value', $(this).attr('origin_value') );
	  $(this).attr('origin_value','');
	  $(this).parent().hide();
  });
	$('.reset_default').live('click',function(){
	  $(this).parent().find('img').show();
	  $(this).parent().find('span').show();	  
	  $(this).parent().parent().parent().find('input').attr('value', $(this).attr('rel_id') );
	  $(this).hide();
	  //$(this).prev().show();
	});


  $('.unlink_default_collect').live('click',function(){
    $(this).hide();    
    var prev = $(this).prev().hide();    
    //return_wrap = div.origin_collect
    var return_wrap = $(this).parent().parent().parent();
    var input = return_wrap.find('input');
    input.attr('value', $(this).attr('origin_value') );
    $(this).next().css('display','block');
    $(this).hide();
  });	
  $('.unlink_collect').live('click',function(){
	  var return_wrap =$(this).parent().parent().parent();
	  var input = return_wrap.find('input');
	  input.attr('value', $(this).attr('origin_value') );
	  $(this).attr('origin_value','');
	  if( return_wrap.find('.unlink_default_collect').length > 0 ){
	    return_wrap.find('.unlink_default_collect').show();  
	  }
	  $(this).parent().hide();
	});
  $('.reset_default_collect').live('click',function(){
	  $(this).parent().find('span').show();
	  $(this).parent().parent().parent().find('input').attr('value', $(this).attr('rel_id') );
	  $(this).hide();	  
	});
	



	$('.pick').live('click',function(){
    var uri = $(this).attr('uri');
		$.ajax({
			type: 'get',
			cache: false,
			url: uri,
			success:function(html){
        $(html).css({
          'position':'absolute',
          'top': '100',
          'left':'100'
        });
        $(document.body).append( $(html) );
			}
		});
    return false;
	});		
  
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

	$('.att_return_submit').live('click',function(){
	  var wrap = getPanel($(this));	
	  var rel_gavatar = wrap.find('.rel_gavatar').attr('src');	 
    
    var return_wrap = $('#'+wrap.find('.return_id').val()).parent();

    console.log( return_wrap );
	  if( $('.unlink_default').length > 0 ) {
	    $('.unlink_default').hide();
	  }

	  var rel_path        = wrap.find('.rel_path').val();
	  var rel_extension   = wrap.find('.rel_extension').val();
	  var rel_imagerange  = wrap.find('.rel_imagerange').val();
	  var rel_id          = wrap.find('.rel_id').val();
	  var rel_screen_name = wrap.find('.rel_screen_name').val();	  
	  var rtype           = wrap.find('.rtype').val();
	  var upfiles_dir     = wrap.find('.upfiles_dir').val();

    /*
	  if( rtype == '' ){	    
	  }else if( rtype == 'article_link_image' ){  	    
	    var image = upfiles_dir + rel_path+rel_imagerange+'.'+rel_extension;	    
	    var img_html = "<img alt=\"" + image + "\" src=\"" + image + "\" />"
	    $($('.widgEditor_id').val()).tinymce().execCommand('mceInsertContent',false,img_html);
	    return ;
	  }
    */
    var str = 'ID:'+rel_id +"\n"+ ' NAME:'+rel_screen_name;
    $('.dest_thumbnail').find('img').attr('src', rel_gavatar).attr('title', str);
	  var input_default_value = return_wrap.find('input').val();
	  return_wrap.find('input').attr('value', rel_id);	
	  $('.unlink_dest').attr('origin_value',input_default_value);
	  $('.dest_thumbnail').show();
	  wrap.remove();
	});

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
    return false;
	});

  $('.mtl_to_dest').live('click',function(){
    if( $(this).hasClass('select') ) {
      $(this).removeClass('select');
    }else{
      $(this).addClass('select');
    }
  });

  $('.mtl_return_submit').live('click',function() {
	  var wrap = getPanel($(this));	  
	  var return_wrap = $('#'+wrap.find('.return_id').val()).parent();
    var t = '';
    wrap.find('.select').each(function(){
      t += $(this).attr('rel_name');
      t += "<input type='text' size='10' name='category_article_ids[]' value="+$(this).attr('rel_id')+" />";
      t += "<br/>";
    });
    return_wrap.append( t );
    wrap.remove();
  });



  $('.collect_return_submit').live('click',function(){	  
	  var wrap = getPanel($(this));	  
	  //var return_wrap = $('#'+wrap.find('.return_id').val()).parent().next();
	  var return_wrap = $('#'+wrap.find('.return_id').val()).parent();
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


  $('.control_tree').click(function(){
    $(this).addClass('focus');
    $('#w_left').show().addClass('show');
  });
  
  $('.load_focus').focus();
  
  if( $("#is_hide_adv").length > 0 ) {
    if( $("#is_hide_adv").val().length > 0 ) {
      $('.w_adv_search').show();
    }
  }
  
  $(".toggle_w_adv_search").click(function(){
    $('.w_adv_search').toggle();
    if( $('.w_adv_search').css('display') == 'block' ) {
      $('#is_hide_adv').val( 'show');
    }else{
      $('#is_hide_adv').val('');
    }
  });

  $('.batch_form input[type=submit]').click(function(){
      if( confirm("process") ) {
        return true;
      }
      return false;
  });

  $('.item-sep').click(function(){
    if( $(this).is(':checked') ){
      $(this).parent().parent().addClass('select');
    }else{
      $(this).parent().parent().removeClass('select');
    }
  });

  $('.item-all').click(function(){
    if( $(this).is(':checked') ){
      $('.item-sep').attr('checked',true);
      $('.item-sep').parent().parent().addClass('select');
    }else{
      $('.item-sep').attr('checked',false);
      $('.item-sep').parent().parent().removeClass('select');
    }
  });

  $("form .itable tbody tr").click(function(){
    $('form .itable tr.focus').removeClass('focus');
    $(this).addClass('focus');
  })


  if( $('textarea.tinymce').length > 0 ) {
    $('textarea.tinymce').tinymce({
      script_url : '/js/tiny_mce/tiny_mce.js',
      theme : "advanced",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect ,forecolor,backcolor",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "cite,abbr,acronym,del,ins,attribs,|,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        relative_urls: false,
        content_css : "/js/content.css",
        
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",
        language : "zh-cn",
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
            'class': 'mce_image',
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
}); 
