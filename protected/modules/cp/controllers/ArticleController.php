<?php

class ArticleController extends GController
{  
  
  public function actionPreview() {
    echo ereg_replace('<script.*</script>', '', Markdown($_POST['content']));
  }
  
	public function getRelData() {		
		$_data = Category::model()->getTreeById();
		$leafs = CHtml::listdata($_data, 'id','name');		
		//array_unshift( $leafs , array( '--ALL Nodes--' ) );
		return array( $leafs );
	}

  public function getTree($top_leaf='') {
    if( strlen($top_leaf) > 0 ) {
      return Category::model()->ileafs( array( 'id' => $top_leaf ,'include' => true ) );
    }else{
      return Category::model()->ileafs( array( 'ident' => 'Root' ,'include' => true ) );
    }
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


  public function actionInnode() {
    $top_leaf = 206;
    $cur_leaf = $_GET['category_id'] ? $_GET['category_id'] : $top_leaf;
    $this->actionIndex($top_leaf,$cur_leaf);
  }


	public function actionIndex($top_leaf='',$cur_leaf='')
	{	  
	  list($leafs) = $this->getRelData();
	  $criteria=new CDbCriteria;
    $criteria->condition = " 1=1 ";
		if( isset($_GET['keyword']) || !empty($_GET['keyword']) || strlen($_GET['keyword']) >0 || strlen($_GET['leaf_id'] ) > 0 ){
		  $keyword = trim($_GET['keyword']);			  
      $criteria->condition  .= ' AND title like :keyword ';
      $criteria->params     = array(':keyword'=>"%$keyword%");      
	  }

	  $opt['page_size'] = 15;
    //$leaf_id    = $_GET['leaf_id'];
    if( strlen($cur_leaf) > 0 ) {
      $leaf_id =& $cur_leaf;
    }else{
      $leaf_id =& $_GET['category_id'];
    }
//    $is_include = $_GET['is_include'];

    $is_include = true;
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

    if( strlen($leaf_id) > 0 ) {
      $category = Category::model()->findByPk($leaf_id);
    }else{
      $category = Category::model()->findByPk(1);
    }

	  $criteria->order        = 'update_time DESC';
	  $opt['criteria']        =  $criteria;

    $leaf_tree =& $this->getTree($top_leaf);
	  $opt['tpl_params']      = array( 'top_leaf' => $top_leaf, 'leafs' => $leafs,'category' => $category,'leaf_tree' => $leaf_tree );

	  parent::actionIndex($opt);
	  
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
				'actions'=>array('index','view','preview','Sortarticle','innode'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','test', 'move', 'copy','stared','unstared','batch'),
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
      Article::model()->updateAll( array('is_star' => 1), " FIND_IN_SET(id,:ids) ", array( ':ids' => $ids) );      
      echo count( explode(',',$ids ) ).' content has beed Started';      
    }else{      
      $model=$this->loadModel();
      $model->is_star = 1;
      $model->save();
    }   
  }
  
  public function actionUnstared(){
    if(Yii::app()->request->isPostRequest){	   
      $ids = $_POST['ids'];                       
      Article::model()->updateAll( array('is_star' => 0), " FIND_IN_SET(id,:ids) ", array( ':ids' => $ids) );
      echo count( explode(',',$ids ) ).' content has beed Unstarted';      
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
    $action = $_GET['action'];
		$model=new Article;
		$model->category_id = $_GET['leaf_id'];
		list( $leafs ) = $this->getRelData();
		$leaf  = Category::model()->findByPk($_REQUEST['leaf_id']);
		if(isset($_POST['Article'])) {				  
		  $model->attributes=$_POST['Article'];
		  $model->update_time = $model->create_time = date("Y-m-d H:i:s");
		  $_sort_id = $leaf->first()->sort_id;
		  if( $_sort_id > 0 ){
		    $model->sort_id = $_sort_id +1;
		  }else{
		    $model->sort_id = 1;
		  }
			if($model->save()){
			  $str = Yii::t('cp','Create Success On ').Time::now();
			  Yii::app()->user->setFlash('success',$str);
			  $this->redirect(array('update','id'=>$model->id, 'action' => $action));	
			}	
		}

    $leaf_tree = $this->getTree();
		$this->render('create',array( 'action' => $action, 'model'	=>	$model, 'leaf_tree' => $leaf_tree ,'leafs' => 	$leafs, 'leaf'	=> $leaf ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel(); 
		list( $leafs ) = $this->getRelData();
		if(isset($_POST['Article']))
		{		  
			$model->attributes=$_POST['Article'];
			$model->update_time = date("Y-m-d H:i:s");
			if($model->save()){

        ManyCategoryArticle::model()->deleteAllByAttributes( array('article_id' => $model->id ) );
        foreach( $_POST['category_article_ids'] as $m_category_id ) {
          $_model = new ManyCategoryArticle;
          $_model->article_id = $model->id;
          $_model->category_id = $m_category_id;
          $_model->save();
        }
			  $str = Yii::t('cp','Data saved success On ').Time::now();
				Yii::app()->user->setFlash('success',$str);
				$this->redirect(array('update','id'=>$model->id));	
			}							
		}
    $leaf_tree =& $this->getTree();
    $action = $_GET['action'];
  	$this->render('update',array( 'action' => $action, 'model'	=>	$model, 'leafs'	=>	$leafs, 'leaf_tree' => $leaf_tree ));
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

  public function actionBatch() {
    if(Yii::app()->request->isPostRequest) {
      $type = $_POST['type'];
		  $ids =& $_POST['ids'];
			if( count($ids) > 0 && $type=="删除") {
				foreach( $ids as $id) {
				  $imodel = new $this->controllerId;
					$item = $imodel->findByPk($id);
					$item->delete();
				}
        $str = '已删除 '.count($ids).' 个用户数据 '.Time::now();
			}elseif ( count($ids) > 0 && $type=="复制") {
	      /* Copy a list of article in same category */
        foreach( $ids as $id ) {
          $at = Article::model()->findByPk($id);
          $new = new Article();							
          $new->attributes =$at->attributes;
          unset($new->attributes['id']);			
          $new->title = $new->title .' - copy';							
          $new->save();
        }
        $str = '已复制 '.count($ids).' 个用户数据 '.Time::now();
			}elseif ( count($ids) > 0 && $type=="重点") {
        $ids = join(',',$ids);
        Article::model()->updateAll( array('is_star' => 1), " FIND_IN_SET(id,:ids) ", array( ':ids' => $ids) );      
        $str = '已打重点 '.count($ids).' 个用户数据 '.Time::now();
			}elseif ( count($ids) > 0 && $type=="非重点") {
        $ids = join(',',$ids);
        Article::model()->updateAll( array('is_star' => 0), " FIND_IN_SET(id,:ids) ", array( ':ids' => $ids) );      
        $str = '已取消重点 '.count($ids).' 个用户数据 '.Time::now();
      }
     	Yii::app()->user->setFlash('success',$str);
      $this->redirect( rurl() );
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

  }
}
