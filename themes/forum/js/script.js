$(document).ready(function(){
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
