<?php

class ArticleController extends IController
{  
  
  public function actionPreview() {
    echo ereg_replace('<script.*</script>', '', Markdown($_POST['content']));
  }
  
	public function actionTest() {
		echo "!";
	}
	
	public function getRelData() {		
		$_data = Category::model()->getTreeById();
		$leafs = CHtml::listdata($_data, 'id','name');		
		//array_unshift( $leafs , array( '--ALL Nodes--' ) );
		return array( $leafs );
	}
	
	public function actionSortarticle() {
		$sort = $_POST['sort'];
		for( $i=0; $i<count($sort); $i++ ) {		
		  //echo $sort[$i];
			$at = Article::model()->findByPk($sort[$i]);
			$at->sort_id = count($sort)-$i;
			$at->save();
		}
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex($value='')
	{	  
	  list($leafs) = $this->getRelData();
	  $criteria=new CDbCriteria;
		if( isset($_GET['keyword']) || !empty($_GET['keyword']) || strlen($_GET['keyword']) >0 || strlen($_GET['leaf_id'] ) > 0 ){
		  $keyword = trim($_GET['keyword']);			  
      $criteria->condition  = 'title like :keyword ';
      $criteria->params     = array(':keyword'=>"%$keyword%");      
      $opt['is_partial']    = true;
	  }
	  
    $leaf_id    = $_GET['leaf_id'];
    $is_include = $_GET['is_include'];
    if( strlen( $leaf_id) > 0 ){
      $criteria->condition  .= ' AND find_in_set(category_id, :category_id)';
      if( $is_include ){
        $leaf = Category::model()->findbypk($leaf_id);          
        $leafs = Category::model()->findAll( array( 
          'select' => 'id, name',
          'condition'  => ' rgt <= :rgt AND lft >= :lft ',
          'params'    => array( ':rgt' => $leaf->rgt, ':lft' => $leaf->lft )
        ) );
        $all_leafs = '';
        foreach( $leafs as $_leaf ){
          $all_leafs .= $_leaf->id.',';
        }        
        $criteria->params[':category_id'] = $all_leafs;
      }else{
        $criteria->params[':category_id'] = $leaf_id;  
      }          
    }
	  $criteria->order        = 'update_time DESC';
	  $opt['criteria']        =  $criteria;
	  $opt['tpl_params']      = array( 'leafs' => $leafs );
	  parent::actionIndex($opt);
	  
	}
	public function actioncxIndex() {
	  	  
	  //print_r( ucfirst($this->getId() ) );	  
	  //$this->actionId     = $this->getAction()->getId();
	  $controllerId = $this->controllerId;	  
	  
	  $criteria=new CDbCriteria;
		if( isset($_GET['keyword']) || !empty($_GET['keyword']) || strlen($_GET['keyword']) >0  ){
		  $keyword = trim($_GET['keyword']);			  
      $criteria->condition  = 'title like :keyword ';
      $criteria->params     = array(':keyword'=>"%$keyword%");
      $is_partial = true;		  
	  }
    $imodel = new $controllerId;
    $item_count = call_user_func( array( $imodel, 'count') , $criteria );
    
    $page_size = 10;          
    $pages =new CPagination($item_count);
    $pages->setPageSize($page_size);      
    $pagination = new CLinkPager();
    $pagination->cssFile=false;
    $pagination->setPages($pages);    
    $pagination->init();      
    $criteria->limit        =  $page_size;
    $criteria->offset       = $pages->offset;
    $select_pagination = new  CListPager();
    $select_pagination->header = '跳转到:';
    $select_pagination->htmlOptions['onchange']="";
    
    $select_pagination->setPages($pages);    
    $select_pagination->init();    
    $list = call_user_func( array( $imodel, 'findAll') , $criteria );
    
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
		
	  $panel_ident = $_REQUEST['panel_ident'];
	  
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
			'leafs' => $leafs,
			'panel_ident' => $panel_ident,
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
				'actions'=>array('index','view','preview','Sortarticle'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','test', 'move', 'copy','stared','unstared'),
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

  public function actionStared(){ 
    if(Yii::app()->request->isPostRequest){	 
      $ids = $_POST['ids'];
      echo $ids;
      $sql = " update article set is_star = 1 where FIND_IN_SET(id, '$ids')";
      Article::model()->findAllBySql($sql);    
    }else{      
      $model=$this->loadModel();
      $model->is_star = 1;
      $model->save();    
    }   
  }
  
  public function actionUnstared(){
    if(Yii::app()->request->isPostRequest){	   
      $ids = $_POST['ids'];
      echo $ids;
      $sql = " update article set is_star = 0 where FIND_IN_SET(id, '$ids')";
      Article::model()->findAllBySql($sql);
    }else{
      $model=$this->loadModel();
      $model->is_star = 0;
      $model->save();  
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
		$model=new Article;
		$model->category_id = $_GET['leaf_id'];
		list( $leafs ) = $this->getRelData();
				
		$leaf  = Category::model()->findByPk($_GET['leaf_id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
    $panel_ident = $_REQUEST['panel_ident'];
    
		if(isset($_POST['Article']))
		{		
		  $model->attributes=$_POST['Article'];
		  $model->update_time = $model->create_time = date("Y-m-d H:i:s");
		  $_sort_id = $leaf->first()->sort_id;
		  if( $_sort_id > 0 ){
		    $model->sort_id = $_sort_id +1;
		  }else{
		    $model->sort_id = 1;
		  }
			if($model->save()){
				if( isset($_GET['ajax']) ) {
  				$this->renderPartial('create_next', array(
    				'model' => $model,
    				'leafs'	=> $leafs,
    				'leaf'	=> $leaf,
    				'panel_ident' =>  $panel_ident,    				
    			),false,true);
    			exit;
					//$this->renderPartial('create_next',array( 'model' =>  $model ), false,true );						
				}else {
					$this->redirect(array('view','id'=>$model->id));	
				}			
			}	
		}
		
	  if( isset($_GET['ajax']) ) {
  		$this->renderPartial('create', array(
  			'model' => $model,
  			'leafs'	=> $leafs,
  			'leaf'	=> $leaf,
  			'panel_ident' =>  $panel_ident,  			
			),false,true);					
		}else {
			$this->render('create',array(
				'model'	=>	$model,
				'leafs' => 	$leafs,
				'leaf'	=> $leaf,
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
    $panel_ident = $_REQUEST['panel_ident'];
        
		if(isset($_POST['Article']))
		{		  
			$model->attributes=$_POST['Article'];
			$model->update_time = date("Y-m-d H:i:s");
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
		if( isset($_GET['ajax']) ) {
			$this->renderPartial('update',array(
				'model'	      =>	$model,
  			'is_update'   =>  $is_update,
  			'panel_ident' =>  $panel_ident,
				'leafs'	      =>	$leafs
			),false,true);
		}else {			
			$this->render('update',array(
				'model'	=>	$model,
				'leafs'	=>	$leafs
			));
		}
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
