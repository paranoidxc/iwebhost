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
  
  
  public static function leafs() {
    
  }
  
  public static function leaf_tree(){
    
  }  
  
  /**
   * move the leaf to another 
   * @parameter $opt['from] => the id of moving leaf ; $opt['to'] => the parent leaf id 
   * WARNNING: can't move leaf to self
   * @return boolean
   * @author paranoid
   **/
  public static function leaf_move($opt){
    if( is_array($option) && is_numeric($opt['from']) && is_numeric($opt['to']) ){      
      return Category::model()->leafMoveToAnother($opt['from'], $opt['to']);
    }else{
      echo "ERROR PHP File:".dirname(__FILE__).'/API.php';
      echo "ERROR Fuction category_move";
      exit;
    }
  }    

  /**
   * get category recursion
   * @parameter $opt
   * 
   * @return boolean
   * @author paranoid
   **/
  public static function INODE($opt) {
    if( is_array( $opt ) ) {      
      $opt = array_merge($opt, array('include' => false ) );      
      return Category::model()->ileafs($opt);        
    }else{
      echo "ERROR PHP File:".dirname(__FILE__).'/API.php';      
      echo "ERROR Fuction INODE";
      exit;
    }
  }
}
?>
