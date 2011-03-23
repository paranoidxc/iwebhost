<?php

class TController extends Controller {	
  public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','reply'),
				'users'=>array('@'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	
	public function actionIndex(){			  
		Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';			
		$article = Article::model()->findByPk($_GET['id']);
		if($article===null){
			throw new CHttpException(404,'The requested Topic does not exist.');
		}
		$article->pv = $article->pv +1;
		$article->save();
		
		$model = new Post;		
		$model->content = "<p></p>";
		$model->article_id = $article->id;
		$this->render('index', array('inst' => $article, 'model' => $model ));
	}		
	
	public function actionReply() {	    
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';		
	  $model = new Post;	  
	  if( isset($_POST['Post']) &&  !Yii::app()->user->isGuest ){
	    $model->attributes=$_POST['Post'];
		  $model->c_time  = date("Y-m-d H:i:s");
		  $model->user_id = Yii::app()->user->id;
		  $article = Article::model()->findByPk($model->article_id);
		  if( strlen($article->content) > 0 ){
		    $model->content = str_replace('<div><br /></div>','<div>&nbsp;</div>',$model->content);
		  }
		  if( $model->save() ){			    
		    $article->reply_count ++;
		    $article->reply_time = date("Y-m-d H:i:s");		    
		    $article->save();
		    
		    $this->redirect(array('t/index','id'=>$model->article_id) );		    
		  }		  
		  if( $model->content == ''){
		    $model->content = "<p></p>";
		  }
		  $this->render('index', array('inst' => $article, 'model' => $model ));		  
	  }else {
	    throw new CHttpException(404,'The requested does not allow.');
	  }
	  
	}
	
	public function actionCreate() {	  
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';		
	  $model = new Article('forum');
	  $model->content = "<p></p>";
		$model->category_id = $_GET['f'];
		if(isset($_POST['Article']) && !Yii::app()->user->isGuest )
		{
		  $model->attributes=$_POST['Article'];
		  $model->reply_time = $model->update_time = $model->create_time = date("Y-m-d H:i:s");
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
		if( $model->content == ''){
		  $model->content = "<p></p>";
		}
	  $this->render('create', array('model'=>$model, 'node' => $node) );
	}
	
	
	
 
}