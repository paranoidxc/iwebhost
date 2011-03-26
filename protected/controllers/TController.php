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
		$article = Article::model()->findByPk($_GET['id']);
		if($article===null){
			throw new CHttpException(404,'The requested Topic does not exist.');
		}

    // page view plus expcet the owner of the article
    if( $article->user_id != Yii::app()->user->id ) {
		  $article->pv = $article->pv +1;
		  $article->save();
    }

    //article auther read the reply
    if( $article->user_id == Yii::app()->user->id ) {
      Notification::model()->article_auther_readed_notices($article->id,Yii::app()->user->id);
    }

		$model = new Post;		
		$model->content = "<p></p>";
		$model->article_id = $article->id;
    $this->_pageTitle = CHtml::encode( $article->title).API::lchart().$article->leaf->name.API::lchart();
		$this->render('index', array('inst' => $article, 'model' => $model ));
	}		
	
	public function actionReply() {	    
	  $model  = new Post;	  
    $now    = date("Y-m-d H:i:s");
	  if( isset($_POST['Post']) &&  !Yii::app()->user->isGuest ){
	    $model->attributes=$_POST['Post'];
		  $model->c_time  = $now;
		  $model->user_id = Yii::app()->user->id;
		  $article = Article::model()->findByPk($model->article_id);
		  if( strlen($article->content) > 0 ){
		    $model->content = str_replace('<div><br /></div>','<div>&nbsp;</div>',$model->content);
		  }
		  if( $model->save() ){
		    $article->reply_count ++;
		    $article->reply_time = $now;
		    $article->save();
		    
        // add Notification except the auther of the article
        if( $article->user_id != Yii::app()->user->id ) {
          $n = new Notification;
          $n->attributes = array( 
              'user_id'     => $article->user_id,
              'article_id'  => $article->id,
              'post_id'     => $model->id,
              'c_time'      => $now,
              );
          $n->save();
        }
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

    $this->_pageTitle = '新主题'.API::lchart().$node->name.API::lchart();
	  $this->render('create', array('model'=>$model, 'node' => $node) );
	}
 
}
