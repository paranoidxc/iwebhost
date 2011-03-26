<?php
class MController extends Controller {	
	public function actionIndex(){			  
		$m = User::model()->findByPk($_GET['id']);
		if($m===null){
			throw new CHttpException(404,'The requested Member does not exist.');
		}		
		$this->render('index', array('m' => $m));
	}	
}
