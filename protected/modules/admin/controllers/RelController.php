<?php

class RelController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionPickAtt(){		
		$return_id = $_GET['return_id'];
		$rtype = $_GET['rtype'];
		if( isset($_GET['screen_name']) ){
		  $screen_name = trim($_GET['screen_name']);		  
		  $atts = Attachment::model()->findAll(
		    array(
            'condition' => 'screen_name like :screen_name',
            'params'=>array(':screen_name'=>"%$screen_name%")            
        ));
		  $this->renderPartial('_att',array('return_id' => $return_id,'atts' => $atts,'rtype' => $rtype ),false,true);
		}else{
		  $atts = Attachment::model()->findAll();      
		  $this->renderPartial('pickatt',array('return_id' => $return_id,'atts' => $atts ,'rtype' => $rtype ),false,true);
		}
		
	}
	
	public function actionPicknode(){
		$return_id = $_GET['return_id'];
		$this->renderPartial('picknode',array('return_id' => $return_id),false,true);	
	}
	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}