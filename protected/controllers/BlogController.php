<?php
class BlogController extends Controller
{
  
  public function actionTestP(){
    list($list,$p) = API::essay(array(
      'id' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19'
    )); 
    
    foreach($list as $e) {
      _debug( $e->title );
    }    
    echo $p->run();
  }
  public function actionAPI(){
    $item_count =32;
    $page_size =2;
    $pages =new CPagination($item_count);
    //$pages->pageVar = 'iook=8&ok';    
    //$pages->createPageUrl(CController::createUrl('blog/index',$pages) );
    $pages->setPageSize($page_size);
    // simulate the effect of LIMIT in a sql query
    //$end =($pages->offset+$pages->limit <= $item_count ? $pages->offset+$pages->limit : $item_count);
    //$sample =range($pages->offset+1, $end);
    $pagination = new CLinkPager();
    //print_r("<pre>");
    //print_r($pagination);
    //print_r("</pre>");
    //$pages->pageVar='stat='.$_GET[stat]."&page";
    $pagination->setPages($pages);    
    $pagination->init();    
    $pagination->run();        
    print_r("--");
    print_r($pages->offset);
    print_r("--");
    $pagination = new CListPager();
    $pages->pageVar = 'ioof';
    $pagination->setPages($pages);
    $pagination->init();
    $pagination->run();     
    exit;


    echo 'find id=2 essay <br>';
    echo '<pre>';
  
    $a = API::essay(array(
      'id' => '2'
    ));      
    $a->print;  
    echo 'find id=2,3,4 essay <br>';
    $a = API::essay(array(
      'id' => ',1,2,3,4,5,6,7,,8,,9,0,0,-,-,,,,r,r,r,w,,3,2,3'
    ));  
    
    foreach( $a as $t ){
      print_r("<hr>");
      $t->print;
    }
    
    echo '</pre>';
    exit;
  }
  
  public function actionIndex(){
    Yii::app()->name = 'xiaochuan.log';
		Yii::app()->theme='blog';
		$blog = API::INODE( array('ident_label' => 'blog','include' => true) );
		$article = $blog[0]->first();
		$this->render('index', array(
  		'article' => $article
		) );
  } 
  
  public function actionMap(){    
    Yii::app()->name = 'xiaochuan.log';
		Yii::app()->theme='blog';
    $blog = API::INODE( array('ident_label' => 'blog','include' => true) );    
    
		$this->renderPartial('_map', array(
  		'articles' => $articles,
  		'blog'     => $blog  		
		) );
  }
  
  public function actionArticle() {
    Yii::app()->name = 'xiaochuan.log';
		Yii::app()->theme='blog';		
		$id = $_GET['id'];				
		$article = Article::model()->findbyPk($_GET['id']);
		$this->render( 'index', array( 'article' => $article) );
  }
}
?>