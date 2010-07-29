<?php

class CategoryController extends controller
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
				'actions'=>array('index','view','leafs'),
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

	public function actionLeafs() {		
		$sql = 	" SELECT node.id AS id, ".
      		 	" node.name, (COUNT(parent.name) - 1) AS depth ".
        		" FROM category AS node,".
        		" category AS parent ".
        		" WHERE node.lft BETWEEN parent.lft AND parent.rgt ".
        		" GROUP BY node.id ".
	        	" ORDER BY node.lft ";        
		$leafs =Category::model()->findAllBySql($sql);
		
		$this->render('leafs',array(
			'leafs'=> $leafs
		));		
	}
	
	
	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
			//$model = Category::model()->with('articles')->findByPk($_GET['id']);
			//' t.id = :id ',
				//array(':id' => $_GET['id'] )
			$criteria = new CDbCriteria;
			$criteria->order=" articles.sort_id asc ";
			$criteria->condition = " t.id = :id ";
			$criteria->params = array(
				':id' => $_GET['id']
			);
			//$model = Category::model()->with('articles')->findByPk( 21 , $criteria );
			$model = Category::model()->with('articles')->find( $criteria );
			//$model = Category::model()->with('articles')->findByPk(21 , array(
			//	'order' => ' articles.sort_id asc'
			//));
			
			$this->renderPartial( 'ajaxview', array(
				'model'=> $model,
				false,true
			));
			exit;
		if(isset($_GET['ajax'])) {
			
			$model = Category::model()->with('articles')->findByPk($_GET['id']);
			
			$this->renderPartial( 'ajaxview', array(
				'model'=>$this->$model,
				false,true
			));
		}else {					
			$this->render('view',array(
				'model'=>$this->loadModel(),
			));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Category;
		if( isset( $_GET['leaf_id'] ) ) {
			$model->parent_leaf_id = $_GET['leaf_id'];
			$model->parent_leaf = Category::model()->findByPk($_GET['leaf_id']);			
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			// ==2 is pass the validate 
			// validate reutrn "[]" string
			if( strlen(CActiveForm::validate($model)) == 2 ) {
				
				$cmodel = Category::model();
				$transaction = $cmodel->dbConnection->beginTransaction();				
				try {

					$leaf_model = Category::model();										
					$parent_leaf = $leaf_model->find('id = :id', array( ':id'=> $_POST['Category']['parent_leaf_id']) );
										
					$update_rgt = " UPDATE category SET rgt = rgt + 2 WHERE rgt > $parent_leaf->lft ";
					$cmodel->dbConnection->createCommand($update_rgt)->execute();

					$update_lft = " UPDATE category SET lft = lft + 2 WHERE  lft > $parent_leaf->lft ";					
					$cmodel->dbConnection->createCommand($update_lft)->execute();					
				
					$model->lft = $parent_leaf->lft + 1;
					$model->rgt = $parent_leaf->lft + 2;
					
					$model->create_time = date("Y-m-d H:i:s");
					$model->save();
					$transaction->commit();	
					
					if( $_GET['ajax'] == 'ajax' ) {
						echo 'Category Create Success!';
						exit;
					}else {							
						$this->redirect(array('leafs'));
					}
//					$this->redirect(array('view','id'=>$model->id));
								
				}catch(Exception $e) {
				//	print($e);
					print(" exception ");					
					$transaction->rollBack();
				}				
			}											
			//if($model->save())
			//	$this->redirect(array('view','id'=>$model->id));
		}

		if( $_GET['ajax'] == 'ajax' ) {
			$this->renderPartial('create', array(
				'model' => $model,
				'ajax'  => true
			), false, true );
		}else {					
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

		
		if( isset( $_GET['leaf_id'] ) ) {
			$model->parent_leaf_id = $_GET['leaf_id'];
			$model->parent_leaf = Category::model()->findByPk($_GET['leaf_id']);			
		}
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']) && strlen(CActiveForm::validate($model)) == 2 )
		{			
			$model->attributes=$_POST['Category'];
			$width = $model->rgt - $model->lft + 1;
			$pwidth = $model->parent_leaf->rgt - $model->parent_leaf->lft ;
			if( $pwidth < $width ) {
				$pwidth = $pwidth + $width;
			}
			$cmodel = Category::model();
			$transaction = $cmodel->dbConnection->beginTransaction();		
			try{	
			// step 1: temporary "remove" moving node	
					
					$model->save();
					
			    $sql 	 = " UPDATE category ";
    			$sql	.= " SET lft = -lft, rgt = -rgt ";
    			$sql	.= " WHERE lft >= $model->lft AND rgt <= $model->rgt ";
    			_debug($sql);
    			$cmodel->dbConnection->createCommand($sql)->execute(); 	    			
 
			// step 2: decrease left and/or right position values of currently 'lower' items (and parents)
			
			$width = abs($width);
			$pwidth = abs($pwidth);
    	_debug('width'.$width);
    	_debug('pwidth'.$pwidth);
    	
    	$sql = " UPDATE category  SET lft = lft  -  $width WHERE lft > $model->rgt ";	   
    	$cmodel->dbConnection->createCommand($sql)->execute(); 	
	    $sql = " UPDATE category SET rgt = rgt- $width WHERE rgt >  $model->rgt ";
	    $cmodel->dbConnection->createCommand($sql)->execute();
			
	  
			$parent_rgt = $model->parent_leaf->rgt;
			$parent_lft = $model->parent_leaf->lft;
			
			
			$t1 = $parent_rgt > $model->rgt ? $parent_rgt -$width : $parent_rgt;
			$sql = " UPDATE category SET lft = lft + $width  WHERE lft >= $t1 ";
    	
    	_debug($sql);
    	$cmodel->dbConnection->createCommand($sql)->execute();    	    	    	
    	
    	$t2 = $parent_rgt > $model->rgt ? $parent_rgt - $width : $parent_rgt;
    	$sql = " UPDATE category  SET rgt = rgt +  $width WHERE rgt >=  $t2";
    	$cmodel->dbConnection->createCommand($sql)->execute();	    	    	    	    
    	
    	// step 4 move the temporary "remove" leaf to parent    	
    	//$sql = " UPDATE category SET lft = -lft + $pwidth, rgt = -rgt + $pwidth WHERE lft < 0 ";    	    	
    	
    	$_lft = $parent_rgt > $model->rgt ? $parent_rgt - $model->rgt -1 : $parent_rgt-$model->rgt -1 + $width;
    	$_rgt = $parent_rgt > $model->rgt ? $parent_rgt - $model->rgt -1 : $parent_rgt-$model->rgt -1 + $width;
    	$sql = " UPDATE category SET lft = -lft + $_lft , rgt = -rgt + $_rgt WHERE lft < 0 ";    	    	
    	_debug( $sql );
    	
    	$cmodel->dbConnection->createCommand($sql)->execute();
	    $transaction->commit();		    		    			
    }catch(Exception $e) {
    	_debug($e);
    	$transaction->rollBack();
    }            
    if( isset($_GET['ajax']) ) {
    	echo 'update leaf suc';
    	exit;
    }else {
    	$this->redirect(array('view','id'=>$model->id));
    }
		//if($model->save())
			//$this->redirect(array('view','id'=>$model->id));
	}

		if( isset($_GET['ajax']) ) {
			$this->renderPartial('update', array(
				'model' => $model,
				'ajax'	=> 'ajax'
				),false,true);
		}else {					
			$this->render('update',array(
				'model'=>$model,
			));
		}
	}
	
	
	public function actionxUpdate()
	{
		$model=$this->loadModel();

		
		if( isset( $_GET['leaf_id'] ) ) {
			$model->parent_leaf_id = $_GET['leaf_id'];
			$model->parent_leaf = Category::model()->findByPk($_GET['leaf_id']);			
		}
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			
			
			$model->attributes=$_POST['Category'];
			
			exit;
			
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
		
		
		$cmodel = Category::model();
		$transaction = $cmodel->dbConnection->beginTransaction();		
		try {
			
			$model = $this->loadModel();	
			$width = $model->rgt - $model->lft + 1;
			
			// delete all leaf where lft between lft and rgt 
			// this will delete the leaf and children
			
			$del_sql = ' DELETE FROM '.$model->tableName().' WHERE lft BETWEEN '.$model->lft.' AND '.$model->rgt;			
			$cmodel->dbConnection->createCommand($del_sql)->execute();			
						
			$update_sql = ' UPDATE '.$model->tableName().' SET rgt = rgt - '.$width.' WHERE rgt > '.$model->rgt;
			$cmodel->dbConnection->createCommand($update_sql)->execute();
			
			$update_sql = ' UPDATE '.$model->tableName().' SET lft = lft - '.$width.' WHERE lft > '.$model->rgt;
			$cmodel->dbConnection->createCommand($update_sql)->execute();

			$transaction->commit();	
			
			$this->redirect(array('leafs'));
			
		}catch(Exception $e) {
			_debug($e);
			$transaction->rollBack();
		}																		
		
		
		$update_sql = ' UPDATE '.$model->tableName().' SET rgt = rgt - :width WHERE rgt > :rgt';
		
		$update_sql = ' UPDATE '.$model->tableName().' SET lft = lft - :width WHERE lft > :rgt';
		exit;
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
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

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
				$this->_model=Category::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
