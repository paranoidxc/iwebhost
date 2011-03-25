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
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

  public function actionIndex() {
    $u =  User::model()->findByPk( Yii::app()->user->id );
    $this->render('index', array('notices' => $u->notices) );
  }

}
