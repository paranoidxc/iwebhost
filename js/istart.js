$(document).ready(function(){	  
  
  $('#istart_form_tab_wrap a:first').addClass('form_tab_selected');
  
  $('.istart_form_field_wrap ').hide();
  $($('.istart_form_field_wrap')[0]).show();
  
  $('#istart_form_tab_wrap a').click(function(){
    console.log( $(this).attr('class') );
    if( !$(this).hasClass('form_tab_selected') ){      
      $('.istart_form_field_wrap ').stop(true,true).hide();
      $('#istart_form_tab_wrap .form_tab_selected').removeClass('form_tab_selected');
      $(this).addClass('form_tab_selected');
      
      var field_wrap = $('#'+$(this).attr('data'));
      field_wrap.stop(true,true).slideDown();  
    }
    return false;
  })
  
  function setChapterHeight(){    
    $remind_height = $(window).height() - $('#header').height()-$('#header_shadow').height();
    $content_height = $remind_height - $('#chapter h2').height() - 40;
    $('.chapter,.chapters').css({
      'height': $remind_height
    });
    $('#chapter .content').css({
      'height': $content_height
    });    
    
  }
  setChapterHeight();
  
  $(window).resize(function(){    
    setChapterHeight();  
  }); 
  
  /*$('.chapters ul li:first-child a').addClass('current');  */
  $('.chapter_handle').toggle(
    function(){
      $('.chapters').animate({'width': '0px'},500);            
      $('.chapter').animate({ 'width': '100%'}, 500);
      $('.chapter_handle').animate({'left': '6px'}, 500);
      
    },
    function(){
      $('.chapters').animate({'width': '20%'},500);
      $('.chapter_handle').animate({'left': '20%'}, 500);
      $('.chapter').animate({ 'width': '80%'}, 500);
    }
  );
  
	$('.chapters ul li a').click(function(){
	  $.fn.imasker({'z-index': '10000000', 'background' : '#000 url(/js/load.gif) no-repeat 50% 50% '});
	  $('.chapters ul li a.current').removeClass('current');
	  $that = $(this);
		$.ajax({
			type: 	'get',
			url:	$(this).attr('href'),
			cache: 	false,
			success:	function(html){
				$('#chapter').replaceWith(html);
				$that.addClass('current');
				setChapterHeight();
				$.fn.imasker_hide();
			}
		})
		return false;
	})
	
	$('.new_list_form').submit(function(){
		var that = $(this);		
		$.ajax({
			type:		"post",
			url:		$(this).attr('action'),
			data:		$(this).serialize(),
			success:	function(html) {
				//console.log(html);
				if( html == 'Suc' )	{
					that.addClass('suc');					
					that.slideUp(2000);
					var li = $('<li><p>'+$('#Category_name').val()+'</p></li>');
					that.parent().find('>ul').prepend(li);
					$('#Category_name').val('');
				}else if( html == 'Error') {
					that.addClass('error');					
				}else {
					that.addClass('error');				
				}
			}
		});
		return false;
	});
	
	$('.new_list_ele').click(function(){
		//console.log('111');
		$('.new_list_form').removeClass('suc');
		$('.new_list_form').removeClass('error');
		$('.new_list_form').toggle('slide');
	});
	
	$(".board_wrap").sortable({ handle: 'h2' });
	
	$('.istart_form_field_wrap ul li a,.board ul li a').hover(
		function() {
			var fcolor = $(this).css('color');						
			$(this).css({
				'background-color' 	: fcolor,				
				'color'			        : '#FFF'
			})						
		},
		function() {
			var bcolor = $(this).css('background-color');
			var fcolor = $(this).css('color');			
			$(this).css({
				'background-color'	: fcolor,			
				'color'			        : bcolor
			});				
		}
	);	
});
