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
				'actions'=>array('gravatar','setting','you','love','unlove','nodes','lovem'),
				'users'=>array('@'),
			),			
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

  public function actionGravatar() {
    $user = User::model()->findByPk( User()->id );
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $targ_w = $targ_h = 80;
      $image = Yii::app()->image->load( UPFILES_AVTS_DIR.'/source_'.$user->avatar );
      $x = intval( $_POST['x']);
      $y = intval( $_POST['y']);
      $w = $_POST['w'];
      $h = $_POST['h'];
      $image->crop($w,$h,"$y","$x")->resize($targ_w,$targ_h);
      $image->save(UPFILES_AVTS_DIR.'/'.$user->avatar);
      $this->redirect('setting');
      exit;
    }
    $this->render('gravatar',array('user'=>$user),false,true);
  }

  public function actionPhotos() {
    $criteria = new CDbCriteria; 
    $criteria->condition = 'user_id = :user_id';
    $criteria->params = array( ':user_id' => User()->id );
    $criteria->order        =  'c_time DESC';

    if( isset($_GET['keyword']) ){
      $partial_tpl = '_photos';
    }else{
      $partial_tpl = 'photos';
    }

    $item_count = Attachment::model()->count($criteria);    
    $pages =new CPagination($item_count);
    $pages->setPageSize($page_size);      
    $pagination = new CLinkPager();
    $pagination->cssFile=false;
    $pagination->setPages($pages);    
    $pagination->init();      
    $criteria->limit        =  6; 
    $criteria->offset       = $pages->offset;
    $select_pagination = new  CListPager();    

    $photos = Attachment::model()->findAll($criteria);
    $this->renderPartial($partial_tpl, array(
          'photos' => $photos,
          'pagination' => $pagination,
          'select_pagination' => $select_pagination,
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

  public function actionLovem() {
    $users = $_POST['users'];
    $love_users = $_POST['love_users'];
    
    $accept_list = implode(',' ,$users);
    $c = new CDbCriteria;
    $c->condition = 'find_in_set(accept_id, :accept_id) AND attack_id = :attack_id';
    $c->params[':accept_id'] =  $accept_list;
    $c->params[':attack_id'] =  User()->id;
    ManyAttackAccept::model()->deleteAll( $c );
    
    foreach( $love_users as $love ){
      $rel = new ManyAttackAccept();
      $rel->attack_id = User()->id;
      $rel->accept_id = $love;
      $rel->save();
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
