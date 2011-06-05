<?php
class IbController extends Controller {
  public function filters() {
    return array(
        'accessControl',
    );
  }
	
  public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('outbox','index','c','v','r'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

  public function actionOutbox() {
    // outbox mails 
    $mails = Inbox::model()->findAllByAttributes( array('source_id' => User()->id, 'parent_id' => 0 ) );
    $u =  User::model()->findByPk( Yii::app()->user->id );
    $this->render( 'outbox', array( 'mails' => $mails, 'm' => $u  ) ,false,true );
  }

  public function actionIndex() {
    // inbox mails
    $inboxs = Inbox::model()->findAllByAttributes( array('dest_id' => User()->id, 'parent_id' => 0 ) );
    $u =  User::model()->findByPk( Yii::app()->user->id );
    $this->render( 'index', array( 'mails' => $inboxs, 'm' => $u  ) ,false,true );
  }

  // reply
  public function actionR() {
    if( isset($_POST['Inbox'] ) ){
      $model = Inbox::model()->findByPk( $_POST['Inbox']['parent_id'] );
      if($model==null && ( $model->source_id != User()->id || $model->dest_id != User()->id) ) {
        throw new CHttpException(404,'The requested Node does not exist.');
      }
      
      $u =  User::model()->findByPk( Yii::app()->user->id );
      $nmodel = new Inbox;
      $nmodel->attributes = $_POST['Inbox'];
      $nmodel->source_id = $u->id;
      $nmodel->c_time    = Time::now();
      $nmodel->memo =  strip_tags($nmodel->memo);
      if( $nmodel->save() ){
        $this->redirect( array('v', 'id' => $nmodel->parent_id) );
        exit;
      }else{
        $this->render('view', array( 'm' => $u , 'model'=> $model,'nmodel' => $nmodel ), false ,true );
      }

    }else{
      throw new CHttpException(404,'The requested Node does not exist.');
    }
  }

  public function actionV() {
    $model = Inbox::model()->findByPk( $_GET['id'] );
    if($model==null && ( $model->source_id != User()->id || $model->dest_id != User()->id) ) {
      throw new CHttpException(404,'The requested Node does not exist.');
    }
    $nmodel = new Inbox; 
    $nmodel->dest_id    = User()->id == $model->source_id ? $model->dest_id : $model->source_id;
    $nmodel->parent_id  = $model->id;
    $u =  User::model()->findByPk( Yii::app()->user->id );

    if( $u->id == $model->dest_id ) {
      // dest user read the mail
      $model->is_read = 1;
      $model->save(false);
    }

    $this->render('view', array( 'm' => $u , 'model'=> $model,'nmodel' => $nmodel ), false ,true );
  }

  public function actionC() {
    $u =  User::model()->findByPk( Yii::app()->user->id );
    $model = new Inbox;
    if( isset($_POST['Inbox']) ) {
      $model->attributes = $_POST['Inbox'];
      $dest_user =  User::model()->findByPk( $_POST['Inbox']['dest_id'] );
      $model->c_time = Time::now();
      $model->source_id = $u->id;
      $model->memo =  strip_tags($model->memo);
      if( $model->save() ) {
        $this->redirect( array('index' ) );
        exit;
      }
    }else{
      $dest_user =  User::model()->findByPk( $_GET['dest_id'] );
      if( $dest_user == null ) { 
        throw new CHttpException(404,'The requested Node does not exist.');
      }
      $model->dest_id = $dest_user->id;
    }
    $this->render('create', array('dest_user' => $dest_user,'m' => $u,'model'=>$model ), false , true );
  }

}
