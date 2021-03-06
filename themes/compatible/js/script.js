(function($) { $.fn.hasScrollBar = function() { return this.get(0).scrollHeight > this.height(); } })(jQuery);
$(document).ready(function(){
  function f5() { window.location.href = window.location.href; }

  $(document).click(function(e){
    if( ! $(e.target).hasClass('handle') ) {
      $('.settings>div').hide();
    }
    if( ! $(e.target).hasClass('control_tree') ) {
      $('#w_tree_wrap').hide();
      $('.control_tree').removeClass('on');
    }

  });


  $('.settings .handle').click(function(){
    $(this).next().toggle();
  });

  if( $("#is_hide_adv").length > 0 ) {
    if( $("#is_hide_adv").val().length > 0 ) {
      $('.w_adv_search').show();
      $('span.toggle[rel*=w_adv_search]').addClass('on');
    }
  }
 

  function resize_layout(init) {
    _gheight = $(window).height();
    $('#w_right').css({'height':_gheight-31});
    $('#w_panel').css({'height':_gheight-31,'overflow':'auto'});
    //_gheight = _gheight-90;
    _gheight = _gheight-94;
    _top = 56;
    if( $("#w_search").length > 0) {
    }else{
      //var itop = parseInt( $('#w_content').css('top') )-30;
      _gheight = _gheight+30;
      //$('#w_content').css({'top':'26px'});
      //_top = 26;
      $('#w_content').css({'top':'30px'});
      _top = 30;
    }
    _gwidth = $(window).width()-$('#w_left').width();
    _gwidth = $('#w_location').width()-2;

    $('#w_content').css({'height':_gheight,'width':_gwidth, 'overflow': 'auto'});
    
    if( $('.w_adv_search').css('display') == 'block' ) {
      var h = $('.w_adv_search').innerHeight()+parseInt( $('.w_adv_search').css('margin-top') );
      $('#w_content').css({'top': h+_top,'height': _gheight-h });
    }
    if( init ) {
      if( $('#w_content').length > 0 &&$('#w_content').hasScrollBar() ) {
        var fu = $('#w_location').width();
        $('#w_content').css({'width':fu-2});
      }
    }
    resize_mac_panel_wrap();
  }

  function resize_mac_panel_wrap() {
    var h = $('.mac_panel_wrap').height();

    if( $('.mac_panel_wrap').length > 0 ){
      var l = ( $(window).width()  - 600) /2
      if( $(window).height()+100 < h ) {
        var t = 50;
      }else{
        var t = ( $(window).height()  - h) /2
      }
      $('.mac_panel_wrap').css({
        'position':'absolute',
        'top': t,
        'left': l
      });
    }
  }

  resize_layout(true);
  $(window).resize( function(){
    resize_layout(true);
  });

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

  if( $('.flash_suc').length > 0 ){ 
    var w = ($(window).width() - $('.flash_suc').width() )/2;
    $('.flash_suc').css({
      'top' : 50,
      'left' :w
    }).show();
    setTimeout( function(){ $('.flash_suc').hide() } ,5000  );
  };
  $('.list tbody tr').hover(function(){ $(this).addClass('hover'); },function(){ $(this).removeClass('hover');});

  $('.toggle').click(function(){
      $(this).toggleClass('on');
      $($(this).attr('rel')).toggle();
      /*
      if( $(this).attr('rel') == '#attachment_form') {
        var h = $('#attachment_form').innerHeight()+parseInt( $('#attachment_form').css('margin-top') );
        h += parseInt( $('#attachment_form').css('margin-bottom') );
        var t = parseInt( $('#w_content').css('top') );
        var _h = parseInt( $('#w_content').css('height') );
        if( $('#attachment_form').css('display') == 'block') {
          $('#w_content').css({'top': h+t,'height': _h-h });
        }else{
          $('#w_content').css({'top': t-h,'height': _h+h });
        }
      }
      */

      if( $(this).attr('rel') == '.w_adv_search') {
        var h = $('.w_adv_search').innerHeight()+parseInt( $('.w_adv_search').css('margin-top') );
        var t = parseInt( $('#w_content').css('top') );
        var _h = parseInt( $('#w_content').css('height') );
        if( $('.w_adv_search').css('display') == 'block' ) {
          $('#is_hide_adv').val( 'show');
          $('#w_content').css({'top': h+t,'height': _h-h });
        }else{
          $('#is_hide_adv').val('');
          $('#w_content').css({'top': t-h,'height': _h+h });
        }
      }

  });

  $('.action-btn').click(function(){
      if( $(this).hasClass('confirm') ) {
        if( confirm('process') ) {
          $('.batch_form').find("#isubmit").val( $(this).attr('type') );
          $('.batch_form').submit();
        }
      }
  });

  $('.batch_move').live('click',function() {
    $.ajax({
      type: 'post',
      url: $('.settings li a.move').attr('uri'),
//      data: 'ids='+get_ids()+'&category_id='+$('.move_category_id').val(),
      data: $('.batch_form').serialize()+'&category_id='+$('.move_category_id').val(),
      success: function(html) {
        f5();
      }
    });
  });

  $('.wrap_cld').live('click',function(){
      $('.mac_panel_wrap').remove(); 
      $(document.body).imasker_hide();
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
	


  $('.att_search_form').live('submit',function(){
    var wrap = getPanel( $(this) );
    var that = $(this);
    var url = that.attr('action')+'?keyword='+that.find('.keyword').val();
    $.ajax({
	    type: that.attr('method'),
	    cache: false,
	    url: url,
	    success:function(html){
        wrap.find('.search_result_wrap').html(html);  
	    }
	  });
    return false;
  });
 
  $('.ipagination select').live('change',function(){    
    wrap = getPanel( $(this) );
	  var that = $(this);	  
	  var url = that.val();
	  if( url.indexOf('keyword') == -1 ) {
	    url += '?keyword=';
	  }
	  $.ajax({
	    type: 'get',
	    cache: false,
	    url: url,
	    success:function(html){	      
        wrap.find('.search_result_wrap').html(html);  
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
	    url += '?keyword=';
	  }
	  $.ajax({
	    type: 'get',
	    cache: false,
	    url: url,
	    success:function(html){
        wrap.find('.search_result_wrap').html(html);  
	    }
	  })
    return false;
  });


	$('.pick').live('click',function(){
    var uri = $(this).attr('uri');
		$.ajax({
			type: 'get',
			cache: false,
			url: uri,
			success:function(html){
        $(document.body).append( $(html) );
        resize_mac_panel_wrap();
			}
		});
    $(document.body).imasker({});
    return false;
	});		
  
  $('.rpick').live('click',function(){	  
	  var wrap = getPanel($(this));
	  wrap.find('li.active').removeClass('active');	  
	  $(this).addClass('active');	  
    if( $(this).attr('isimage') == 1 ){
	    $('.rel_gavatar').attr('src', $(this).attr('rel_gavatar') ).attr('title',$(this).attr('rel_screen_name')).show();
	    $('.rel_imagerange').html( $(this).find('select').html() ).show();
    }else{
	    $('.rel_gavatar').attr('src', $(this).attr('rel_default_image') ).attr('title',$(this).attr('rel_screen_name')).show();
      $('.rel_imagerange').hide();
    }
	  //wrap.find('.rel_gavatar').attr('src', $(this).attr('rel_gavatar') ).attr('title',$(this).attr('rel_screen_name')).show();
	  //wrap.find('.rel_imagerange').html( $(this).find('select').html() ).show();
    //
	  wrap.find('.rel_id').val( $(this).attr('rel_id') );	  
	  wrap.find('.rel_screen_name').val( $(this).attr('rel_screen_name') );
    wrap.find('.screen_name').html( $(this).attr('rel_screen_name') ).attr('title', $(this).attr('rel_screen_name') );
	  wrap.find('.rel_path').val( $(this).attr('rel_path') );
	  wrap.find('.rel_extension').val( $(this).attr('rel_extension') );
    wrap.find('.wrap_footer').slideDown();
	});

	$('.att_return_submit').live('click',function(){
	  var wrap = getPanel($(this));	
	  var rel_gavatar = wrap.find('.rel_gavatar').attr('src');	 
    
    var return_wrap = $('#'+wrap.find('.return_id').val()).parent();

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
    $(document.body).imasker_hide();
	});

  $('.to_dest').live('click',function(){	  
	  var wrap = getPanel($(this));
	  wrap.find('.move_category_id').val( $(this).attr('rel_id') );
	  wrap.find('.move_category_name').val( $(this).attr('rel_name') );
	  wrap.find('.tree_leaf_current').removeClass('tree_leaf_current');
  	$(this).addClass('tree_leaf_current');	     
    wrap.find('.wrap_footer').slideDown();
    return false;
	});

  $('.mtl_to_dest').live('click',function(){
	  var wrap = getPanel($(this));
    if( $(this).hasClass('select') ) {
      $(this).removeClass('select');
    }else{
      $(this).addClass('select');
    }
    wrap.find('.wrap_footer').slideDown();
  });
  
  $('.unlink_mul_collect').live('click',function(){
    $(this).parent().remove();
    if( $('.dest_mul_collect p').length == 0 ){
      $('.dest_mul_collect').fadeOut();
    }
  })

  $('.mtl_return_submit').live('click',function() {
	  var wrap = getPanel($(this));	  
	  var return_wrap = $('#'+wrap.find('.return_id').val()).parent();
    var t = '';
    wrap.find('.select').each(function(){
      t += "<p>";
      t += $(this).attr('rel_name');
      t += " <span title='删除' class='unlink_mul_collect'>删除</span>"
      t += "<input type='hidden' size='10' name='category_article_ids[]' value="+$(this).attr('rel_id')+" />";
      t += "</p>";
    });
    if( t.length > 0 ) {
      return_wrap.find('.dest_mul_collect').empty().append( t ).show();
    }else{
      return_wrap.find('.dest_mul_collect').empty().append( t ).hide();
    }
    wrap.remove();
    $(document.body).imasker_hide();
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
    $(document.body).imasker_hide();
	});


  /*
  $('.control_tree').click(function(){
    $(this).addClass('focus');
    $('#w_tree_wrap').show().addClass('show');
  });
  */
  
  $('.load_focus').focus();
  
 
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
    //  if( $(this).is(':checked') )
    if( $(this).attr('checked') == undefined || $(this).attr('checked') == '' ){
      $(this).attr('checked','111').addClass('on');
      $('.item-sep').attr('checked',true);
      $('.item-sep').parent().parent().addClass('select');
    }else{
      $(this).attr('checked','').removeClass('on');
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
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,cimage",
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect ,forecolor,backcolor",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "cite,abbr,acronym,del,ins,attribs,|,pagebreak,cimage",
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
