$(document).ready(function(){
    
  $('.rpick').live('click',function(){	  
    $('li.active').removeClass('active');	  
	  $(this).addClass('active');	  
	  $('.rel_gavatar').attr('src', $(this).attr('rel_gavatar') ).attr('title',$(this).attr('rel_screen_name')).show();
	  $('.rel_imagerange').html( $(this).find('select').html() ).show();
	  $('.rel_id').val( $(this).attr('rel_id') );	  
	  $('.rel_screen_name').val( $(this).attr('rel_screen_name') );
	  $('.rel_path').val( $(this).attr('rel_path') );
	  $('.rel_extension').val( $(this).attr('rel_extension') );
    $('.wrap_footer').slideDown();
	});

	$('.att_return_submit').live('click',function(){
	  var rel_gavatar = $('.rel_gavatar').attr('src');	 
	  var rel_path        = $('.rel_path').val();
	  var rel_extension   = $('.rel_extension').val();
	  var rel_imagerange  = $('.rel_imagerange').val();
	  var rel_id          = $('.rel_id').val();
	  var rel_screen_name = $('.rel_screen_name').val();	  
	  var rtype           = $('.rtype').val();
	  var upfiles_dir     = $('.upfiles_dir').val();
    var rel_imagerange  = $('.rel_imagerange').val();
    CimageDialog.insert( upfiles_dir+rel_path+rel_imagerange+'.'+rel_extension , rel_screen_name);
	});


  $('.att_search_form').live('submit',function(){
    var that = $(this);
    var url = that.attr('action')+'?keyword='+that.find('.keyword').val();
    $.ajax({
	    type: that.attr('method'),
	    cache: false,
	    url: url,
	    success:function(html){
        $('.search_result_wrap').html(html);  
	    }
	  });
    return false;
  });
 
  $('.ipagination select').live('change',function(){    
	  var that = $(this);	  
	  var url = that.val();
	  if( url.indexOf('keyword') == -1 ) {
	    url += '?keyword=';
	  }
	  $.ajax({
	    type: 'get',
	    cache: false,
	    url: url,
	    success:function(html){	      
        $('.search_result_wrap').html(html);  
	    }
	  })
    return false;
  })

  $('.ipagination .yiiPager li a').live('click',function(){
    if( $(this).parent().hasClass('hidden') ){
      return false;
    }
	  var that = $(this);	  
	  var url = that.attr('href');
	  if( url.indexOf('keyword') == -1 ) {
	    url += '?keyword=';
	  }
	  $.ajax({
	    type: 'get',
	    cache: false,
	    url: url,
	    success:function(html){
        $('.search_result_wrap').html(html);  
	    }
	  })
    return false;
  });

   $.ajax({
      type: 'get',
      url:  '/cp/rel/pickimage/rtype/article_link_image.html',
      cache: false,
      success: function(html) {
        $('#w_image').html(html);
      }
   });
});
