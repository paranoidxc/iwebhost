<?php

class SController extends Controller {	
	public function actionIndex(){			  		
		$this->render('index');
	}
	
	public function actionError() {
    if($error=Yii::app()->errorHandler->error) {
    	if(Yii::app()->request->isAjaxRequest) {
    		echo $error['message'];
      } else {
       	$this->render('error', $error);
      }
    }
	}
	
	public function actionSignup() {
		$model=new User;
	  if(isset($_POST['User'])) {
	    $model->attributes=$_POST['User'];
			$model->c_time = Time::now();
			if($model->save()){			  
        $model->password = md5(sha1(SECRET.$model->password) );
        $model->save(false);
			  $str = '用户注册成功,请试着登录下!';
				Yii::app()->user->setFlash('success',$str);
			  $this->redirect( array( 'signin' ));
			  exit;
			}
	  }
    $this->_pageTitle = '新用户注册'.API::lchart();
	  $this->render('signup', array('model' => $model));
	}

	public function actionSignin() {
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
    // if user valid return to previou url except some sepcial url
    if( strpos( $_SERVER['HTTP_REFERER'], 'signin' ) === false  
        &&
        strpos( $_SERVER['HTTP_REFERER'], 'signup' ) === false  
        &&
        strpos( $_SERVER['HTTP_REFERER'], 'signout' ) === false  
        ) {
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
    $this->_pageTitle = '用户登录'.API::lchart();
		$this->render('signin',array('model'=>$model));
	}
	
	public function actionSignout(){
    $user = User::model()->findByPk( User()->id );
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
	  $model=new ForgotForm;	  
		if(isset($_POST['ForgotForm'])) {
			$model->attributes=$_POST['ForgotForm'];			
			if($model->validate() && $model->forgot()){			  
			  $this->render('forgotok',array('model'=>$model) );
			  exit;
			}
		}
    $this->_pageTitle = '找回密码'.API::lchart();
		$this->render('forgot',array('model'=> $model ) );
	}

	public function actionReset(){
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
    $this->_pageTitle = '重新设置密码'.API::lchart();
	  $this->render('reset', array( 'record' => $record, 'model' => $model) );	  
	}
	
}
