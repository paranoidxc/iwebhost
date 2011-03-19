<?php

class ForumController extends Controller {	
	public function actionIndex(){			  
		Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';					
		$articles = Article::model()->findAll( array('limit' => 20, 'order' => 'update_time desc' ) );
		$this->render('index', array('articles' => $articles) );
	}
}
