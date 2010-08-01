<?php

class DatablockController extends controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','hierarchical','hnext','isort','imove'),
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

	public function actionImove() {						
		$data = Datablock::model()->findByPk($_POST['id']);
		echo $data->p_id;
		$data->p_id = $_POST['p_id'];		
		$data->save();
		echo $data->p_id;
		echo 'suc';
	}
	
	public function actionIsort() {		
		$sort = $_POST['sort'];
		for( $i=0; $i<count($sort); $i++ ) {			
			$at = Datablock::model()->findByPk($sort[$i]);
			$at->sort_id = $i+1;
			$at->save();
		}
	}
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author paranoid
	 **/
	public function getRelData()
	{
		$_d = Datablock::model()->findall();
		$_data = CHtml::listdata( $_d, 'id', 'name' );		
		array_unshift($_data, 'Data-Block-Top');
		return array( $_data );
	}
	
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author paranoid
	 **/
	public function actionHnext(){
		$p_id = isset( $_GET['p_id'] ) ? $_GET['p_id'] : 0;		
		$criteria = new CDbCriteria;
		$criteria->order=" sort_id ";		
		$criteria->condition = ' p_id = :p_id ';
		$criteria->params = array(
			':p_id' => $p_id
		);
		$datas = Datablock::model()->findAll($criteria);		
		$this->renderPartial('hierarchical',array( 'datas' => $datas, 'ajax' => 'ajax', 'p_id' => $p_id ), false, true );
	}
	public function actionHierarchical()
	{
		$p_id = isset( $_GET['p_id'] ) ? $_GET['p_id'] : 0;
		$criteria = new CDbCriteria;
		$criteria->order=" sort_id ";
		$criteria->condition = ' p_id = :p_id ';
		$criteria->params = array(
			':p_id' => $p_id
		);
		$datas = Datablock::model()->findall($criteria);
		//$datas = Datablock::model()->findall(' p_id = :p_id ', array(':p_id' => $p_id)  ,' id asc ');	
		$this->render('hierarchical',
			array( 'datas' => $datas, 'p_id' => 0 ) );
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
		$model=new Datablock;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Datablock']))
		{
			$model->attributes=$_POST['Datablock'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		list( $data_block_tree )  = $this->getRelData();
		
		$this->render('create',array(
			'model'				=> $model,
			'data_block_tree'	=> $data_block_tree
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

		if(isset($_POST['Datablock']))
		{
			$model->attributes=$_POST['Datablock'];
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
		$dataProvider=new CActiveDataProvider('Datablock');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Datablock('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Datablock']))
			$model->attributes=$_GET['Datablock'];

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
				$this->_model=Datablock::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='datablock-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
