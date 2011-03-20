<?php

class FController extends Controller {	
	public function actionIndex(){			  
		Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';		
		if( isset( $_GET['id'] ) ){
		  $node = Category::model()->findByPk($_GET['id']);		  
		  if($node===null){
			  throw new CHttpException(404,'The requested Node does not exist.');
		  }		  
		  $articles = $node->forumarticles;		  
		}else{
		  $articles = Article::model()->findAll( array('limit' => 20, 'order' => 'update_time desc' ) );		  		  
		}
		$this->render('index', array('articles' => $articles, 'node' => $node ));
	}	
}