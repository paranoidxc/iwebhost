<?php
class API {
  public static function articles_ul($category, $option){
    $r = '<ul class="api_chapters_ul" style="text-indent: '.$option['text_indent'].'">';
    if( $category->articles ) {
      foreach( $category->articles as $article ) {                
        $r .= '<li><a href="'.Yii::app()->urlManager->createUrl($option['url'],array('id' => $article->id, 'ajax' => 'ajax' )).'" title="'.$article->title.'" >';
        $r .= $article->title;
        $r .= '</a></li>';
		  }
    }
    $r .= '</ul>';
    return $r;
  }
  
  /**
   * get articles
   * parameter type => category id/ category obj
   * @return pure array data, ul date, 
   * @author paranoid
   **/
  public static function articles($option){        
    $r = '';
    if( is_array($option) ){
      
      if( $option['type'] == 'id' ){        
        $category = Category::model()->findbyPk($_GET['id']);
      }else if ($option['type'] == 'obj'){
        $category = $option['obj'];
      }            
      if( $option['dom'] == 'ul' ){
        $r .= self::articles_ul($category,$option);                
      }
      return $r;                  
    }else{
      echo "API articles Parameter Error!";
      exit;
    }    
  }
  /**
   * get category recursion
   *
   * @return data
   * @author paranoid
   **/
  public static function categorys($option){
    if( is_array( $option) ){            
     $id = $option['id'];
     $depth = $option['depth'];
     $r = Category::model()->vleafs($id, $depth);
     return $r;
    }    
  }
  

  public static function NAV($opt) {    
    if( is_array( $opt ) ) {      
      $opt = array_merge($opt, array('include' => false ) );      
      return Category::model()->ileafs($opt);            
    }else{
      echo " API ERROR in Nav ";
      exit;
    }
  }
}
?>
