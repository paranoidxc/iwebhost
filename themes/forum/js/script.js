$(document).ready(function(){
  $('#signin_user_wrap').hover(function(){
    $($(this).find('ul')).show();
  },function(){
    $($(this).find('ul')).hide();
  });
  $('.timeago').timeago();  
});
