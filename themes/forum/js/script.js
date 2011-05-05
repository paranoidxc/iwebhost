$(document).ready(function(){
  $('#widg_add_height').click(function(){
    $('.widgIframe').animate({ height: '+='+$(this).attr('data') });
  });
  $('#widg_dec_height').click(function(){
    $('.widgIframe').animate({ height: '-='+$(this).attr('data') });
  });

  $('.member-photos').click(function(){
    var that = $(this);
    var uri = $(this).attr('href');
    $.ajax({
			type: 'get',
			cache: false,
			url: uri,
			success:function(html){			  
        that.next().html(html);
			}
		});
  });

  $('.member-photos-pick ul li').live('click',function(){
    var alt = $(this).attr('name');
    var image = $(this).attr('href');
    widgSetContent('id_widgEditor', image, alt);
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
