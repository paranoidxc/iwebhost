$(document).ready(function(){
  $('#item-all').click(function(){
    if( $(this).is(':checked') ){
      $('.item-sep').attr('checked',true);
      $('.item-sep').parent().parent().addClass('select');
    }else{
      $('.item-sep').attr('checked',false);
      $('.item-sep').parent().parent().removeClass('select');
    }
  });
}); 
