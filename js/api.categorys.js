$(document).ready(function(){
  $('.api_categorys_ul p').click(function(){    
    if( $(this).next() ){
      if( $(this).next().css('display') == 'block' ){                
        $(this).children('.f_open,.f_fold').addClass('f_fold').removeClass('f_open');
        $(this).children('.open,.fold').addClass('fold').removeClass('open');
        //$(this).next().slideUp("normal");
        $(this).parent().children('ul').slideUp('normal');
      }else{
        $(this).children('.f_open,.f_fold').addClass('f_open').removeClass('f_fold');        
        $(this).children('.open,.fold').addClass('open').removeClass('fold');        
        //$(this).next().slideDown("normal");
        $(this).parent().children('ul').slideDown('normal');
      }
    }
  })
});