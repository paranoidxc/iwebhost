<?php
class mwController extends Controller
{
  public function actionIndex(){
    Yii::app()->name = 'MoWei Fashion';
		Yii::app()->theme='mw';		
		$this->render('index');
  } 
}
?>