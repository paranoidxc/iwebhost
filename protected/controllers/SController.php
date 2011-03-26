<?php

class SController extends Controller {	
	public function actionIndex(){			  		
	  Yii::app()->name = 'infuzhou';
	  Yii::app()->theme='forum';	
		$this->render('index');
	}
	
	public function actionError()
	{
	  Yii::app()->name = 'infuzhou';
	  Yii::app()->theme='forum';	
    if($error=Yii::app()->errorHandler->error)
    {
    	if(Yii::app()->request->isAjaxRequest)
    		echo $error['message'];
    	else
        	$this->render('error', $error);
    }
	}
	
	
	public function actionSignup() {
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';		
		$model=new User;
	  if(isset($_POST['User'])) {
	    $model->attributes=$_POST['User'];
			$model->c_time = Time::now();
			if($model->save()){			  
			  $str = '用户注册成功,请试着登录下!';
				Yii::app()->user->setFlash('success',$str);
			  $this->redirect( array( 'signin' ));
			  exit;
			}
	  }
	  $this->render('signup', array('model' => $model));
	}
	public function actionSignin() {
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';
		if( !Yii::app()->user->isGuest ){
		  $this->render('diffsignin');
		  exit;
		}
		
		$model=new LoginForm;		
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}		
    //print_r( $_SERVER['HTTP_REFERER'] );
		if( Yii::app()->user->returnUrl == '/index.php' ) {
		  Yii::app()->user->returnUrl = $_SERVER['HTTP_REFERER'];
		}		
		
		if(isset($_POST['LoginForm']))
		{		  
			$model->attributes=$_POST['LoginForm'];		
			if($model->validate() && $model->login()){
			  Yii::app()->request->redirect(Yii::app()->user->returnUrl);					  
			  exit;
			}
		}		
		$this->render('signin',array('model'=>$model));
	}
	
	public function actionSignout(){
	  $user = Yii::app()->user->getState('current_user');	  
	  if( $user ){
  		$user->last_logout_time = Time::now();
  		$user->last_ip = API::get_ip();
  		$user->save();
		}
		Yii::app()->user->logout();						
		if( isset( $_GET['rurl'] ) ){		  		  
		  $this->redirect(array($_GET['rurl']));		    
		}else{
		  $this->redirect(Yii::app()->homeUrl);  
		}
	}
	
	public function actionForgot() {
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';		
	  $model=new ForgotForm;	  
		if(isset($_POST['ForgotForm'])) {
			$model->attributes=$_POST['ForgotForm'];			
			if($model->validate() && $model->forgot()){			  
			  $this->render('forgotok',array('model'=>$model) );
			  exit;
			}
		}
		$this->render('forgot',array('model'=> $model ) );
	}

	public function actionReset(){
	  Yii::app()->name = 'infuzhou';
		Yii::app()->theme='forum';
	  $token = trim($_GET['token']);
	  $model = new ResetPasswordForm;	 
	  if( isset($_POST['ResetPasswordForm'] ) ){
	    $model->attributes = $_POST['ResetPasswordForm'];	    
	    if( $model->validate() && $model->reset() ){
	      $str = '密码重置成功,请试着登录下!';
				Yii::app()->user->setFlash('success',$str);
	      $this->redirect( array('s/signin') );
	    }
    }else{
      $record = User::model()->findByAttributes( array('token'=> $token) );        
      $model->token = $record->token;
      if( $record == null ){
	      throw new CHttpException(404,'The requested Reset Password does not exist.');
	      exit;
	    }
    }
	  $this->render('reset', array( 'record' => $record, 'model' => $model) );	  
	}
	
}