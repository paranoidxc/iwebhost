<?php
  class IroleController extends IController {
    public function actionIndex() {
      $roles = Yii::app()->authManager->getRoles();      
      $this->render('index', array( 'roles' => $roles) );      
    }
  }
?>