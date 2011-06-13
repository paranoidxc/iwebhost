$(document).ready(function(){
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
        language : "zh",
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
