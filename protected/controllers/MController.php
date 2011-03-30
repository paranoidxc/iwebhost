<?php
class MController extends Controller {	
 public function filters() {
		return array(
			'accessControl', 
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('index','list'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array('setting'),
				'users'=>array('@'),
			),			
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){			  
    $m = is_numeric( $_GET['id'] ) ? User::model()->findByPk($_GET['id']) : User::model()->findByAttributes( array('username' => $_GET['id'] ) );
		if($m===null){
			throw new CHttpException(404,'The requested Member does not exist.');
		}		
    $this->_pageTitle = $m->username.API::lchart();
		$this->render('index', array('m' => $m));
	}	

  public function actionList() {
    $users = User::model()->findAll( ' account_type = 0 ' );
    $this->_pageTitle = '会员列表'.API::lchart();
    $this->render( 'list', array('users'=>$users) );
  }

  public function actionSetting() {
    $m = new SettingForm;	 
		$user = User::model()->findByPk( Yii::app()->user->id );
    $m->id = $user->id;
    $m->sign = $user->sign;

    if( isset($_POST['SettingForm'] ) ){
      $m->attributes = $_POST['SettingForm'];
      if( $m->validate() && $m->setting() ){
        $str = '会员资料已保存,';
        if(strlen($m->password)>0) {
          $str.= "密码已更新!";
        }else{
          $str.= "密码未更新!";
        }
			  Yii::app()->user->setFlash('success',$str);
       }
    }
    $m->password = $m->rpassword = '';
    $this->_pageTitle = '会员资料设置'.API::lchart();
    $this->render('setting', array( 'm' => $m, 'user' => $user ) );	  
  }

}
