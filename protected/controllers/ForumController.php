<?php

class ForumController extends Controller {	
	public function actionIndex(){			  
		Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';						
		$this->render('index');
	}
	
	
	public function actionSignup() {
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';		
		$model=new User;
	  if(isset($_POST['User'])) {
	    $model->attributes=$_POST['User'];
			$model->c_time = Time::now();
			if($model->save()){			  
			  $this->redirect( array( 'forum/signin' ));
			  exit;
			}
	  }
	  $this->render('signup', array('model' => $model));
	}
	public function actionSignin() {
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';	
			
		$model=new LoginForm;		
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}		
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];		
			if($model->validate() && $model->login()){
			  $this->redirect(Yii::app()->user->returnUrl);			  		
			}
		}		
		$this->render('signin',array('model'=>$model));
	}
}
