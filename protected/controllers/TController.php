<?php

class TController extends Controller {	
	public function actionIndex(){			  
		Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';			
		$article = Article::model()->findByPk($_GET['id']);
		if($article===null){
			throw new CHttpException(404,'The requested Topic does not exist.');
		}
		$article->pv = $article->pv +1;
		$article->save();
		$this->render('index', array('inst' => $article ));
	}		
	
	public function actionCreate() {	  
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';
	  $model = new Article('forum');
		$model->category_id = $_GET['f'];
		if(isset($_POST['Article']) && !Yii::app()->user->isGuest )
		{
		  $model->attributes=$_POST['Article'];
		  $model->update_time = $model->create_time = date("Y-m-d H:i:s");
		  $model->user_id = Yii::app()->user->id;
		  if( $model->save() ){			    
		    $this->redirect(array('t/index','id'=>$model->id) );
		    exit;
		  }
		}		
		$node = Category::model()->findByPk($_GET['f']);
		if($node===null){
			throw new CHttpException(404,'The requested Node does not exist.');
		}
	  $this->render('create', array('model'=>$model, 'node' => $node) );
	}
}