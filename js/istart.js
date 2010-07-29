$(document).ready(function(){	
	
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
	
	$('.board ul li a').hover(
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
