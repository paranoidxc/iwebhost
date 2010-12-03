<?php
class BlogController extends Controller
{
  public function actionAPI(){
    echo 'find id=2 essay <br>';
    echo '<pre>';
  
    $a = API::essay(array(
      'id' => '2'
    ));      
    $a->print;  
    echo 'find id=2,3,4 essay <br>';
    $a = API::essay(array(
      'id' => ',3,2,3'
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