function prevEassy() {
  if( $("#prev a").length > 0 ){
    window.location.href = $("#prev a").attr('href');
    return false;
  } 
};

function nextEassy() {  
  if( $("#next a").length > 0 ){
    window.location.href = $("#next a").attr('href');
    return false;
  }    
}


jQuery(document).bind('keydown', 'J',prevEassy);
jQuery(document).bind('keydown', 'j',prevEassy);
jQuery(document).bind('keydown', 'k',nextEassy);
jQuery(document).bind('keydown', 'K',nextEassy);



$(document).ready(function(){    
  jQuery(document).bind('keydown', 'm',blog_map);
  jQuery(document).bind('keydown', 'shift+/',showFacebox);
  jQuery(document).bind('keydown', 'Esc',hideFacebox);
  
  $('#article').jScrollPane({
    reinitialiseOnImageLoad: true
  });
  
  $('#afk').click(showFacebox);
  $('#facebox .close').click(hideFacebox);
  function hideFacebox() {    
    $("#masker").fadeOut();
    $('#facebox').fadeOut();
    return false;
  }
  
  function showFacebox() {    
    $("#masker").show();
    $('#facebox').fadeIn();
  }
  
  function blog_map(){
    var that = $('#map>a');
    if( that.parent().next().find('ul').length == 0 ){
      $.ajax({
          type: 'get',
          cache: false,
          url: that.attr('href'),
          success: function(html){
            that.parent().next().html( html );
            that.parent().next().slideDown();
          }
      })
    }else{
      if( that.parent().next().css('display') == 'block' ){
        that.parent().next().slideUp();  
      }else{
        that.parent().next().slideDown();  
      }
      
    }
  }
  
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
  });
    

});
