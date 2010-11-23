<?php
class BlogController extends Controller
{
  public function actionIndex(){
    Yii::app()->name = 'xiaochuan.log';
		Yii::app()->theme='blog';
		$blog = API::INODE( array('ident_label' => 'blog','include' => true) );
		$article = $blog[0]->first();
		$this->render('index', array(
  		'article' => $article
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