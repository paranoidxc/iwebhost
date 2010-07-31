$(document).ready(function(){

/*
  function removeTreeScroll() {
    $('#top_tree').jScrollPaneRemove();
  };

  function initTreeScroll() {
    $('#top_tree').jScrollPane({
      scrollbarWidth: 10,
      scrollbarMargin: 10,
      showArrows: false
    });
  };
  function resetTreeScroll() {
    removeTreeScroll();
    initTreeScroll();
  };
  initTreeScroll();
*/
  
  function clear_leaf_class() {
    $('span.leaf').removeClass('current');
  };
/*
    $("#tree_root").resizable({
      maxWidth: '500',
      minWidth: '300',
      start : function() {
        removeTreeScroll();
      },
      resize: function() {
        var remainingSpace = $(this).parent().width()-$(this).outerWidth();
        var mainContent = $(this).next();
        var mainContentWidth = remainingSpace - (mainContent.outerWidth() - mainContent.width());
        mainContent.css('width', mainContentWidth + 'px');
      },
      stop : function() {
        initTreeScroll();
      }
    });
 */
  $('span.f_open,span.f_fold').each(function(i){

    $(this).click(function(){
      var data_id = $(this).attr('data_id');
      var class_name = '';

      if( $(this).hasClass('f_fold') ) {
        $(this).removeClass('f_fold').addClass('f_open');
        $(this).parent().removeClass('fold').addClass('open');
        class_name = 'open';
      }else{
        $(this).removeClass('f_open').addClass('f_fold');
        $(this).parent().removeClass('open').addClass('fold');
        class_name = 'fold';
      }
      
      //resetTreeScroll();
    });
  });


var loading = $('<li class="loading"><img src="/images/ajax-loader.gif" /></li>');
  $('span.leaf').each(function(item){  	
    $(this).click(function(ev){
      if( ev.detail == 1 || ev.detail == undefined) {
        clear_leaf_class();
        $(this).addClass('current');
      }      
      $('#leaf_id').val($(this).attr('data_id'));      
      
      if( ev.detail == 1 ) {
      $('.actions').append(loading);
      $.ajax({
        type      : 'get',
        dataType  : 'html',
        cache     : false,
        url       : '/index.php?r=admin/category/view&ajax=ajax&id='+$(this).attr('data_id'),
        success   : function(html) {       
        	$('.loading').remove(); 
        	$('#leaf_articles').html(html);
        }
      });      
    }
    }).dblclick(function(ev){
      clear_leaf_class();
      $(this).addClass('current');
      if( $(this).prev().hasClass('f_fold' ) ) {
      	if( $(this).prev().hasClass('f_fold') ) {
      		$(this).prev().removeClass('f_fold').addClass('f_open');	
      	}
        $(this).parent().removeClass('fold').addClass('open');
      }else{
      	if( $(this).prev().hasClass('f_open') ){
      		$(this).prev().removeClass('f_open').addClass('f_fold');	
      	}        
        $(this).parent().removeClass('open').addClass('fold');
      }      
      /*
      if( $(this).prev().prev().hasClass('f_fold' ) ) {
        $(this).prev().prev().removeClass('f_fold').addClass('f_open');
        $(this).parent().removeClass('fold').addClass('open');
      }else{
        $(this).prev().prev().removeClass('f_open').addClass('f_fold');
        $(this).parent().removeClass('open').addClass('fold');
      }                      
      */
     // resetTreeScroll();
    });
  });
});
