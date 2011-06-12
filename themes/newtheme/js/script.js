$(document).ready(function(){
  $('.load_focus').focus();
  
  if( $("#is_hide_adv").val().length > 0 ) {
    $('.w_adv_search').show();
  }
  
  $(".toggle_w_adv_search").click(function(){
//    $('.w_adv_search').slideToggle();
    $('.w_adv_search').toggle();
    if( $('.w_adv_search').css('display') == 'block' ) {
      $('#is_hide_adv').val( 'show');
    }else{
      $('#is_hide_adv').val('');
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


  $('textarea.tinymce').tinymce({
		script_url : '/js/tiny_mce/tiny_mce.js',
		theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
      //,|,justifyleft,justifycenter,justifyright,justifyfull,",
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
  			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
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

}); 
