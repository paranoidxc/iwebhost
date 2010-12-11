<?php
class BlogController extends Controller
{
  
  public function actionApi(){        
    echo '<pre>';
    echo '117 Category  API::node( array(\'ident_label\' => \'blog\')  下的属性<br/>';
    $blog = API::node( array('ident_label' => 'blog') );
    $blog->iprint();
    echo '<br>';
    echo '只提取blog下的文章 $articles = $blog->essays(); <br>';
    $articles = $blog->essays();
    foreach($articles as $a ){
      print_r($a->title);
      echo "<br/>";
    }
    echo '<br>';
    echo '提取blog下的文章 包括blog类别下的类别的文章 $articles = $blog->essays(array($include=>true));<Br>';
    $articles = $blog->essays(array('include'=>true));    
    foreach($articles as $a ){
      print_r($a->title);
      echo "<br/>";
    }
    echo '<br>';
    echo '提取blog下的文章 包括blog类别下的类别的文章 list($articles ,$pagination)= $blog->essays(array(\'include\'=>true,\'split\' => true ));<Br>';
    list( $x , $pagination )= $blog->essays(array('include'=>true, 'split' => true ));    
    foreach($x as $a ){
      print_r($a->title);
      echo "<br/>";
    }
    print_r($pagination->run());
    echo '<br>';
    echo '<br>';
    
    echo '提取一篇指定文章';
    echo "\$eassy = API::essay( array( 'id' => 482 ) );   \$eassy->iprint(); <br/>";    
    $eassy = API::essay( array('id'=>482) );
    $eassy->iprint();      
    echo '<br>';
    echo '以该文章为基准提取下一篇,默认提取属于同一 Category 下的文章; $eassy->getNext()->iprint(); <br/>';
    if( $eassy->getNext() ){
      $eassy->getNext()->iprint();
    }
    echo '<br>';
    echo '以该文章为基准提取上一篇,默认提取属于同一 Category 下的文章; $eassy->getPrev()->iprint();<br/>';
    if( $eassy->getPrev() ){
      $eassy->getPrev()->iprint();
    }    
    echo '<br>';
    echo '以该文章为基准提取下一篇,指定提取属于117 Category 下的文章<br/>';
    if( $eassy->getNext(117) ){
      $eassy->getNext(117)->iprint();
    }
    echo '<br>';
    echo '以该文章为基准提取上一篇,指定提取属于117 Category 下的文章<br/>';
    if( $eassy->getPrev(117) ){
      $eassy->getPrev(117)->iprint();
    }    
    /*
    
    list($list,$p) = API::essay(array(
      'id' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19'
    )); 
    
    foreach($list as $e) {
      _debug( $e->title );
    }    
    echo $p->run();
    */
    echo '</pre>';
  }
  
  public function actionAPIx(){
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
		//$blog = API::INODE( array('ident_label' => 'blog','include' => true) );
		$blog = API::node( array('ident_label' => 'blog') );
		$article = $blog->first(true);
		$this->render('index', array(
  		'article' => $article,
  		'blog'    => $blog
		) );
  } 
  
  public function actionMap(){    
    Yii::app()->name = 'xiaochuan.log';
		Yii::app()->theme='blog';
    $blog = API::node( array('ident_label' => 'blog' ) );
    
		$this->renderPartial('_map', array(  		
  		'blog'     => $blog
		) );
  }
  
  public function actionArticle() {
    Yii::app()->name = 'xiaochuan.log';
		Yii::app()->theme='blog';		
		$id = $_GET['id'];				
		$article = Article::model()->findbyPk($_GET['id']);
		$blog = API::node( array('ident_label' => 'blog') );
		$this->render( 'index', array( 'article' => $article , 'blog' => $blog ) );
  }
}
?>