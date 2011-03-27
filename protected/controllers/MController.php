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
		$m = User::model()->findByPk( Yii::app()->user->id );

    if( isset($_POST['User']) ){
        $m->attributes = $_POST['User'];
        $m->save();
        $str = '会员资料已保存!';
				Yii::app()->user->setFlash('success',$str);
    }
    $this->_pageTitle = '会员资料设置'.API::lchart();
    $this->render( 'setting', array( 'm' => $m ) );
  }

}
