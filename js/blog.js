$(document).ready(function(){
  $('#map>a').toggle(function(){
    var that = $(this);    
    if( $(this).parent().next().find('ul').length == 0 ){
      $.ajax({
        type: 'get',
        cache: false,
        url: $(this).attr('href'),
        success: function(html){
          that.parent().next().html( html );
          that.parent().next().slideDown();
        }
      })
    }else{
      that.parent().next().show();
    }
    return false;
  },function(){
    $(this).parent().next().toggle();
    return false;
  })
})