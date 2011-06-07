<?php

class NController extends Controller {	
  public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','del','clear'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

  public function actionIndex() {
    $u =& $this->iuser;
    $this->_pageTitle = '主题回复提醒'.API::lchart();
    $this->render('index', array('notices' => $u->notices) );
  }
  
  public function actionClear() {
    $user_id =& user()->id;
    $all = Notification::model()->deleteAll( " user_id = $user_id ");
    $this->redirect( array('n/index') );
  }

  public function actionDel() {
    $u =& $this->iuser;
    $n = Notification::model()->findByPk( $_GET['id'] );
    if( $n === null ) {	
      throw new CHttpException(404,'The requested Node does not exist.');
    }
    if( $n->user_id == user()->id ) {
      $n->delete();
    }
    $this->redirect( array('n/index') );
  }

}
