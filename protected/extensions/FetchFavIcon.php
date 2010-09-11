<?php
class FetchFavIcon {
  /**
   * fetch website favorite icon about the specific url 
   * 
   * @return string a image src string
   * @author paranoid
   **/   
  public static $g = 'http://www.google.com/profiles/c/favicons?domain=';
  
  public static function fetch($url='', $type=null){
    if($type == 'img'){       
    }else{
      if( $url != ''){      
        $p = parse_url($url);      
        return self::$g.$p['host'];
      }
      return self::$g.'www.404errorpages.com';  
    }    
  }
  
}
?>