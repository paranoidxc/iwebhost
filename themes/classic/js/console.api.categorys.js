$(document).ready(function(){
  $('.api_tree_categorys_ul p span:first-child').live('click',function(e){         
    var parent = $(this).parent();
    if( parent.next() ){
      if( parent.next().css('display') == 'block' ){
        parent.children('.f_open,.f_fold').addClass('f_fold').removeClass('f_open');
        parent.children('.open,.fold').addClass('fold').removeClass('open');        
        parent.parent().children('ul').hide();
        url = $('.url_leaf_set_class').val()+"&class=fold&id="+$(this).attr('data_id');
        //url = "/index.php?r=admin/category/iclass&class=fold&id="+$(this).attr('data_id');
      }else{
        parent.children('.f_open,.f_fold').addClass('f_open').removeClass('f_fold');   
        parent.children('.open,.fold').addClass('open').removeClass('fold');                
        parent.parent().children('ul').show();
        url = $('.url_leaf_set_class').val()+"&class=open&id="+$(this).attr('data_id');
        //url = "/index.php?r=admin/category/iclass&class=open&id="+$(this).attr('data_id');
      }      
      $.ajax({
        type: 'get',
        url: url,
        cache: false,
        success: function(html){}
      })
    };
    if( $(this).hasClass('f_open') || $(this).hasClass('f_fold') ){
      return false;  
    }
  });
  
  
  
   $('.api_categorys_ul p span:first-child').live('click',function(e){         
    var parent = $(this).parent();
    if( parent.next() ){
      if( parent.next().css('display') == 'block' ){
        parent.children('.f_open,.f_fold').addClass('f_fold').removeClass('f_open');
        parent.children('.open,.fold').addClass('fold').removeClass('open');        
        parent.parent().children('ul').hide();        
      }else{
        parent.children('.f_open,.f_fold').addClass('f_open').removeClass('f_fold');   
        parent.children('.open,.fold').addClass('open').removeClass('fold');                
        parent.parent().children('ul').show();        
      }      
    };
    if( $(this).hasClass('f_open') || $(this).hasClass('f_fold') ){
      return false;  
    }
  });
  
  
/*
  $('.api_categorys_ul p').live('click',function(){     
    if( $(this).next() ){      
      if( $(this).next().css('display') == 'block' ){                
        $(this).children('.f_open,.f_fold').addClass('f_fold').removeClass('f_open');
        $(this).children('.open,.fold').addClass('fold').removeClass('open');        
        $(this).parent().children('ul').slideUp('normal');
      }else{
        $(this).children('.f_open,.f_fold').addClass('f_open').removeClass('f_fold');   
        $(this).children('.open,.fold').addClass('open').removeClass('fold');                
        $(this).parent().children('ul').slideDown('normal');
      }     
    }
  })
  */
});