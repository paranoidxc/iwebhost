<?php

class AttachmentController extends controller
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
				'actions'=>array('index','view','upload'),
				'users'=>array('*'),
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
   * undocumented function
   *
   * @return void
   * @author paranoid
   **/
  public function actionUpload()
  {
    if (isset($_POST["PHPSESSID"])) {
		  session_id($_POST["PHPSESSID"]);
	  } else if (isset($_GET["PHPSESSID"])) {
		  session_id($_GET["PHPSESSID"]);
	  }
	  session_start();	    
    //$save_path = WEBSITE_DIR.'/upfiles/';
    //$save_path = "H:/projects/iwebhost/upfiles/";        	
    $upload_name = "Filedata";
    $path_info = pathinfo($_FILES[$upload_name]['name']);
	  $file_extension = $path_info["extension"];
    $valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';				// Characters allowed in the file name (in a Regular Expression format)
    //$screen_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
    $screen_name  =  basename($_FILES[$upload_name]['name']);
    $file_name = time().'.'.$file_extension;
    if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], ATMS_SAVE_DIR.$file_name)) {	  	
		  exit(0);
	  }
	  $model=new Attachment;
	  $ati = array(
	    'screen_name' => $screen_name,
	    'path'        => $file_name,
	    'w' => '1',
	    'h' => '1'
    );
	  $model->attributes=$ati;
	  if($model->save()){	    
	    $file_path_t = ATMS_SAVE_DIR.'t'.$file_name;
      $file_path_s = ATMS_SAVE_DIR.'s'.$file_name;
      $image = Yii::app()->image->load(ATMS_SAVE_DIR.$file_name);      
      $image->resize(800, 600);
      $image->save();      
      $image->resize(160, 120,Image::NONE);
      $image->save($file_path_s);    
	  }	  	  
	  
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
    
		$model=new Attachment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Attachment']))
		{
			$model->attributes=$_POST['Attachment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Attachment']))
		{
			$model->attributes=$_POST['Attachment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Attachment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Attachment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Attachment']))
			$model->attributes=$_GET['Attachment'];

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
				$this->_model=Attachment::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='attachment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
