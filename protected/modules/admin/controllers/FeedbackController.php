<?php

class FeedbackController extends controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

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
			if($model->save()){
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
			if($model->save()){
  			if( isset($_GET['ajax']) ) {
					$str = 'Data saved! On '.date("Y-m-d H:i:s") ;
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
	  if(Yii::app()->request->isPostRequest)
		{
		  if( strlen($_POST['ids']) >0 ) {
				$ids = explode(',',$_POST['ids']);
				foreach( $ids as $id) {
					$a = Feedback::model()->findByPk($id);
					$a->delete();
				}
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{	
		$criteria=new CDbCriteria;
		if( isset($_GET['keyword']) || !empty($_GET['keyword']) || strlen($_GET['keyword']) >0  ){
		  $keyword = trim($_GET['keyword']);			  
      $criteria->condition  = 'question like :keyword OR answer like :keyword';
      $criteria->params     = array(':keyword'=>"%$keyword%");
      $is_partial = true;		  
	  }	  
    $item_count = Feedback::model()->count($criteria);    
    $page_size = 2;          
    $pages =new CPagination($item_count);
    $pages->setPageSize($page_size);      
    $pagination = new CLinkPager();
    $pagination->setPages($pages);    
    $pagination->init();      
    $criteria->limit        =  $page_size;
    $criteria->offset       = $pages->offset;
    $select_pagination = new  CListPager();
    $select_pagination->htmlOptions['onchange']="";
    $select_pagination->setPages($pages);    
    $select_pagination->init();      
    $list = Feedback::model()->findAll( $criteria );
	  if( $is_partial ){
	    $this->renderPartial('_index',array(
	      'list' => $list, 
	      'pagination' => $pagination, 'select_pagination' => $select_pagination 
	      ),false,true);
	  }else{
	     $this->render('index',array(  			
  			'list'  =>  $list,
  			'pagination' => $pagination, 'select_pagination' => $select_pagination
  		),false,true);
	  }
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Feedback::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
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
