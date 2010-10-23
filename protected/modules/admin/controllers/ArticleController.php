<?php

class ArticleController extends Controller
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

	public function actionTest() {
		echo "!";
	}
	
	public function getRelData() {		
		$_data = Category::model()->getTreeById();
		$leafs = CHtml::listdata($_data, 'id','name');
		return array( $leafs );
	}
	
	public function actionSortarticle() {
		$sort = $_POST['sort'];
		for( $i=0; $i<count($sort); $i++ ) {		
		  echo $sort[$i];
			$at = Article::model()->findByPk($sort[$i]);
			$at->sort_id = count($sort)-$i;
			$at->save();
		}
	}
	/**
	*  Copy a list of article in same category
	*/
	public function actionCopy(){
		if( isset($_POST['ids']) ){			
			$ids = explode(',',$_POST['ids']);
			foreach( $ids as $id ){
				$at = Article::model()->findByPk($id);
				$new = new Article();							
				$new->attributes =$at->attributes;
				unset($new->attributes['id']);			
				$new->title = $new->title .' - copy';							
				$new->save();
			}
			echo count($ids)." record(s) are copy done! ";			
		}
	}
	/**
	*  Move a list of article to another category
	*/
	public function actionMove() {		
		
		if( isset($_POST['category_id']) ){			
			$category_id = $_POST['category_id'];
			$category = Category::model()->findByPk($category_id);
			$ids = explode(',',$_POST['ids']);			
			foreach( $ids as $id) {				
				$at = Article::model()->findByPk($id);
				if( $at ) {									
					$at->category_id = $category->id;
					$at->save();				
				}
			}			
			echo count($ids)." record(s) are move to ";
			echo $category->name;
			exit;
		}
		
		$leafs = Category::model()->ileafs(
        array( 'id' => $_GET['top_leaf_id'],'include' => true )
	  );	  
	  
		$this->renderPartial('move', array(
			'leafs' => $leafs
		),false, true);
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
				'actions'=>array('index','view','Sortarticle'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','test', 'move', 'copy'),
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
		$model=new Article;
		$model->category_id = $_GET['leaf_id'];
		list( $leafs ) = $this->getRelData();
				
		$leaf  = Category::model()->findByPk($_GET['leaf_id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
    
    
		if(isset($_POST['Article']))
		{
		  $model->attributes=$_POST['Article'];
		  $_sort_id = $leaf->first()->sort_id;
		  if( $_sort_id > 0 ){
		    $model->sort_id = $_sort_id +1;
		  }else{
		    $model->sort_id = 1;
		  }
		  
			if($model->save()){
				if( isset($_GET['ajax']) ) {
					echo 'create article suc';
					exit;
				}else {
					$this->redirect(array('view','id'=>$model->id));	
				}			
			}	
		}
		
		if( isset($_GET['ajax']) ) {
			$this->renderPartial('create', array(
				'model' => $model,
				'leafs'	=> $leafs,
				'leaf'	=> $leaf
					),false,ture);
		}else {
			$this->render('create',array(
				'model'	=>	$model,
				'leafs' => 	$leafs,
				'leaf'	=> $leaf
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
		list( $leafs ) = $this->getRelData();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Article']))
		{
			$model->attributes=$_POST['Article'];
			if($model->save()){
				if( isset($_GET['ajax']) ) {
					echo 'update article suc';
					exit;
				}else {
					$this->redirect(array('view','id'=>$model->id));	
				}	
			}							
		}
		if( isset($_GET['ajax']) ) {
			$this->renderPartial('update',array(
				'model'	=>	$model,
				'leafs'	=>	$leafs
			),false,true);
		}else {			
			$this->render('update',array(
				'model'	=>	$model,
				'leafs'	=>	$leafs
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
					$a = Article::model()->findByPk($id);
					$a->delete();
					//echo $id;
					//echo  $a->title;
				}
				//echo "delete done";
			}
			// we only allow deletion via POST request
			//$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			//if(!isset($_GET['ajax']))
				//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Article');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Article('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Article']))
			$model->attributes=$_GET['Article'];

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
				$this->_model=Article::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='article-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
