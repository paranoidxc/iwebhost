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

$(document).ready(function(){
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
    if( $('#id_widgEditor').length > 0 ) {
      widgSetContent('id_widgEditor', image, alt);
    }
    if( $('#article_content').length > 0 ) {
      widgSetContent('article_content', image, alt);
    }
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
