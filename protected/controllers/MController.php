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
				'actions'=>array('index','list','photos'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array('setting','you','love','unlove','nodes'),
				'users'=>array('@'),
			),			
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

  public function actionPhotos() {
    $criteria = new CDbCriteria; 
    $criteria->condition = 'user_id = :user_id';
    $criteria->params = array( ':user_id' => User()->id );
    $criteria->order        =  'c_time DESC';
    $criteria->limit        =  9;
    $photos = Attachment::model()->findAll($criteria);
    $this->renderPartial('photos', array(
          'photos' => $photos
    ),false,true);
  }


  public function actionNodes() {
    $u = User::model()->findByPk( User()->id );
    $this->render( 'nodes', array( 'user' => $u ) );
  }

  public function actionUnlove() {
    if(  $_GET['f'] ) {
      $node = Category::model()->findByPk($_GET['f']);
      $record = ManyCategoryUser::model()->findByAttributes( array('category_id' => $node->id, 'user_id'=>User()->id) );
      $record->delete();
    }
    $this->redirect( rurl() );
  }

  public function actionLove() {
    if(  $_GET['f'] ) {
      $node = Category::model()->findByPk($_GET['f']);
      $record = ManyCategoryUser::model()->findByAttributes( array('category_id' => $node->id, 'user_id'=>User()->id) );
      if( $record === null ){
        $rel = new ManyCategoryUser;
        $rel->category_id = $node->id;
        $rel->user_id     = User()->id;
        $rel->save();
      }
    }
    $this->redirect( rurl() );
  }

  public function actionYou(){
   $m = User::model()->findByPk( User()->id );
		if($m===null){
			throw new CHttpException(404,'The requested Member does not exist.');
		}		
    $this->_pageTitle = $m->username.API::lchart();
		$this->render('index', array('m' => $m));
  }

	public function actionIndex(){			  
    // $m = is_numeric( $_GET['id'] ) ? User::model()->findByPk($_GET['id']) : User::model()->findByAttributes( array('username' => $_GET['id'] ) );
    $m = User::model()->findByAttributes( array('username' => $_GET['id'] ) );
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
      $m->avatar = CUploadedFile::getInstance($m,'avatar');
      // $user->avatar->saveAs('/home/paranoid/projects/infuzhou/123.jpg');
      // $user->save(false);
      if( $m->validate() && $m->setting() ){
        $str = '会员资料已保存,';
        if(strlen($m->password)>0) {
          $str.= "密码已更新!";
        }else{
          $str.= "密码未更新!";
        }
			  Yii::app()->user->setFlash('success',$str);
       }
		   $user = User::model()->findByPk( Yii::app()->user->id );
    }
    $m->password = $m->rpassword = '';
    $this->_pageTitle = '会员资料设置'.API::lchart();
    $this->render('setting', array( 'm' => $m, 'user' => $user ) );	  
  }

}
