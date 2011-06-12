function member_photo_pagination_reload() {   
    if( $(this).parent().hasClass('hidden') || $(this).parent().hasClass('selected')) {
      return false;
    };
    $('div.photos').addClass('member-photos-loading').empty();
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
        $('div.photos').html(html);
        $('div.photos').removeClass('member-photos-loading');
	    }
	  })
    return false;
};

function member_photo_reload() {
 $('.member-photos-pick').addClass('member-photos-loading');
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
};

function checkCoords() {
  if (parseInt($('#w').val())) return true;
	alert('请先在原头像图片选择要截取区域.');
	return false;
};

$(document).ready(function(){
    function myCustomClearup(type,value){
    alert("FFFFFFFF");
    };

  if( $('textarea.tinymce').length > 0 ){

  $('textarea.tinymce').tinymce({
     // Location of TinyMCE script
			script_url : '/js/tiny_mce/tiny_mce.js',

			// General options
		theme : "advanced",
			plugins : "autolink,media,fullscreen,emotions",
//			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,bullist,numlist,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,emotions,image,example,media,fullscreen,cleanup",
      //,|,justifyleft,justifycenter,justifyright,justifyfull,",
			///theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
//			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "",
//			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
      relative_urls: false,

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
  };

  $('.photos_close').live('click',function(){
      $('.member-photos-pick').slideUp();
  });

  var cropbox_h ,cropbox_w;
  $('#cropbox').one('load',function(){
    cropbox_h =  $(this).height();
    cropbox_w =  $(this).width();
  });
  function showPreview(coords) {
    if (parseInt(coords.w) > 0) {
		  var rx = 80 / coords.w;
			var ry = 80 / coords.h;
  		$('#cropbox_preview').css({
  			width: Math.round(rx * cropbox_w) + 'px',
				height: Math.round(ry * cropbox_h) + 'px',
				marginLeft: '-' + Math.round(rx * coords.x) + 'px',
				marginTop: '-' + Math.round(ry * coords.y) + 'px'
			});
		}
	}
	function updateCoords(c) {
  	$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
		var coords = c;
		if (parseInt(coords.w) > 0) {
		  var rx = 80 / coords.w;
			var ry = 80 / coords.h;

			$('#cropbox_preview').css({
				width: Math.round(rx * cropbox_w) + 'px',
				height: Math.round(ry * cropbox_h) + 'px',
				marginLeft: '-' + Math.round(rx * coords.x) + 'px',
				marginTop: '-' + Math.round(ry * coords.y) + 'px'
			});
		}
  };

  $('#cropbox').Jcrop({
  		aspectRatio: 1,
			onSelect: updateCoords,
			onChange: showPreview,
			minSize:			[ 80, 80 ]
	});

  /*收藏节点 全选/全不选 */
  $('#love-all').click(function(){
    if( $(this).is(':checked') ){
      $('.love-sep').attr('checked',true);
    }else{
      $('.love-sep').attr('checked',false);
    }
  });


  $('#widg_add_height').click(function(){
    $('.widgIframe').animate({ height: '+='+$(this).attr('data') });
  });
  $('#widg_dec_height').click(function(){
    $('.widgIframe').animate({ height: '-='+$(this).attr('data') });
  });

  $('.member-photos').live('click',function(){
    $('.member-photos-pick').addClass('member-photos-loading');
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
  });  
  
  $('.ipagination .yiiPager li a').live('click',member_photo_pagination_reload);

  $('.member-photos-pick ul li span').live('click',function(){
    var alt = $(this).attr('name');
    var image = $(this).attr('href');
    var img_html = "<img src='"+image+"' alt='"+alt+"' />";
    if( $('#article_content').length > 0 ) {
      $("#article_content").tinymce().execCommand("mceInsertContent",false,img_html);
    }
    /*
    if( $('#id_widgEditor').length > 0 ) {
      widgSetContent('id_widgEditor', image, alt);
    }
    if( $('#article_content').length > 0 ) {
      widgSetContent('article_content', image, alt);
    }
    */
  });


  $(window).scroll(function() { 
    if( $(this).scrollTop() == 0 ){
      $('#header').css({ 'opacity': '1', });
    }else{
      $('#header').css({ 'opacity': '0.5', });
    }
  });

  $('#header').hover(function(){
    $(this).css({ 'opacity': '1' });
  },function(){
    if( $(window).scrollTop() == 0 ){
      $(this).css({ 'opacity': '1' });
    }else{
      $(this).css({ 'opacity': '.5' });
    }
  });

  $('#signin_user_wrap').hover(function(){
    $($(this).find('ul')).show();
  },function(){
    $($(this).find('ul')).hide();
  });
  $('.timeago').timeago();  
});
