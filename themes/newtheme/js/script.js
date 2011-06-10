$(document).ready(function(){
  $('.load_focus').focus();
  
  if( $("#is_hide_adv").val() > 0 ) {
    $('.w_adv_search').show();
  }
  
  $(".toggle_w_adv_search").click(function(){
    $('.w_adv_search').slideToggle();
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

}); 
