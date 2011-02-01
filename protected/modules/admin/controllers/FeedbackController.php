<?php

class FeedbackController extends IController
{	
		
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{	  
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Feedback;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

    $panel_ident = $_REQUEST['panel_ident'];
		if(isset($_POST['Feedback']))
		{
			$model->attributes=$_POST['Feedback'];						
			$model->q_time = Time::now();
			if($model->save()){
			  $model->addTags('tag1, tag2, tag3')->save();
			  
			  if( isset($_GET['ajax']) ){
			    $this->renderPartial('create_next', array(
  				  'model' => $model,
  				  'panel_ident' => $panel_ident
  			  ),false,true);
  			  exit;
		    }else{
		      $this->redirect(array('view','id'=>$model->id));    
		    }
			}
		}

		if( isset($_GET['ajax']) ){
      $this->renderPartial('create',array(
  			'model'       =>$model,
  			'panel_ident' => $panel_ident
  		),false,true);      
    }else{
      $this->render('create',array(
  			'model'=>$model,
  		));  
    }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
    $panel_ident = $_REQUEST['panel_ident'];
    
    // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Feedback']))
		{
			$model->attributes=$_POST['Feedback'];
			$model->a_time = Time::now();
			if($model->save()){
  			if( isset($_GET['ajax']) ) {
					$str = 'Data saved! On '.Time::now();
					Yii::app()->user->setFlash('success',$str);
					$is_update = true;					
				}else {
					$this->redirect(array('view','id'=>$model->id));	
				}	  
			}
		}

    if( isset($_GET['ajax']) ){
    	$this->renderPartial('update',array(
    		'model'       =>  $model,
    		'is_update'   =>  $is_update,
    		'panel_ident' =>  $panel_ident
    	),false,true);	  
		}else{
  		$this->render('update',array(
  			'model'=>$model,
  		));  
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{	
		$criteria=new CDbCriteria;
		if( isset($_GET['keyword']) || !empty($_GET['keyword']) || strlen($_GET['keyword']) >0  ){
		  $keyword              = trim($_GET['keyword']);			  
      $criteria->condition  = 'question like :keyword OR answer like :keyword';
      $criteria->params     = array(':keyword'=>"%$keyword%"); 
      $opt['is_partial']    = true;
	  }
	  $criteria->order      = 'a_time DESC';
	  $opt['criteria'] =  $criteria;
	  parent::actionIndex($opt);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Feedback('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Feedback']))
			$model->attributes=$_GET['Feedback'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}



	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='feedback-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
