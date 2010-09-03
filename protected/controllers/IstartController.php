<?php

class IstartController extends Controller
{
	//public $layout='//layouts/column2';
	public function actionChapter(){
		if(isset($_GET['id'])){
			Yii::app()->name = 'iStartPage v0.2 beta';
			Yii::app()->theme='istart';	
			$chapter = Article::model()->findbyPk($_GET['id']);
			$this->renderPartial('chapter', array('chapter' => $chapter),false,true );
		}else {
			echo 'invalid';
			exit;
		}
	}
	
	public function getLocation($nav,&$r=array()){		
		array_unshift($r, array('name'=>$nav->name, 'id' => $nav->id) );
		if( $nav->parent ) {
			$this->getLocation($nav->parent,$r);			
		}
		return $r;		
	}
	
	/**
	 * Category function
	 *
	 * @return void
	 * @author paranoid
	 **/
	public function actionCategory(){		
		Yii::app()->name = 'iStartPage v0.2 beta';
		Yii::app()->theme='istart';
		$category = Category::model()->findbyPk($_GET['id']);
		$path = Category::model()->getPath($category->id);				
		for( $i=0; $i<count($path); $i++){	
			if( $i== 0 ) {
				if($path[$i])
				$this->location.= "<li class='home'><a href='/'>".$path[$i]['name']."</a></li>";
				$this->location.= "<li><span>»</span></li>";
			}
			else if( $i == count($path)-1 ){
				$this->location.= "<li class='link last'><span>".$path[$i]['name']."</span></li>";					
			}
			else{
				$this->location.= "<li class='link'><a href='".CController::createUrl('istart/category', array( 'id' => $path[$i]['id']) )."'>".$path[$i]['name']."</a></li>";
				$this->location.= "<li><span>»</span></li>";					
			}
		}		
		
		if(strlen(trim($category->template)) > 0){		  
			if( $category->partial ){
				$this->renderPartial($category->template, array( 'category' => $category ) ,false,true);	
			}else{
				$this->render($category->template, array( 'category' => $category ) );	
			}			
		}else{		  
			if( $category->partial ){					  
				$this->renderPartial('category',array( 'category' => $category ),false,true );
			}else{							  
				$this->render('category',array( 'category' => $category ) );
			}			
		}		
	}
	
	public function actionxBook(){
		if(isset($_GET['category_id'])){
			Yii::app()->name = 'iReadBook v0.2 beta';
			Yii::app()->theme='book';	
			$book = Category::model()->findbyPk($_GET['category_id']);					
			$nav  = Datablock::model()->findbyPk($_GET['datablock_id']);			
			$location = $this->getLocation($nav);						
			for( $i=0; $i<count($location); $i++){								
				if( $i== 0 ) {
					$this->location.= "<li class='home'><a href='/'>".$location[$i]['name']."</a></li>";
					$this->location.= "<li><span>»</span></li>";
				}
				else if( $i == count($location)-1 ){
					$this->location.= "<li class='link'><span>".$location[$i]['name']."</span></li>";					
				}
				else{
					$this->location.= "<li class='link'><a href='".CController::createUrl('istart/inav', array( 'db_id' => $location[$i]['id']) )."'>".$location[$i]['name']."</a></li>";
					$this->location.= "<li><span>»</span></li>";					
				}
					
			}			
			$this->render('book', array('book' => $book) );
		}
	}
	
	public function actionInav(){
		if(isset($_GET['db_id'])){
			Yii::app()->name = 'iStartPage v0.2 beta';
			Yii::app()->theme='istart';		
			$nav = Datablock::model()->findbyPk($_GET['db_id']);
			$this->page_navigation= Datablock::model()->iNav(array('label' => 'istart','depth'	=> 0));
			$inav_list = Datablock::model()->iNav(array('label' => $nav->label,'depth'	=> 0));
			if( strlen($nav->template) > 0 ) {
				$this->render( $nav->template, array('inav_list'=>$inav_list) );	
			}else{
				$this->render( 'inav', array('inav_list'=>$inav_list) );	
			}			
		}
	}
	
	public function actionIndex()
	{		
		Yii::app()->name = 'iStartPage v0.2 beta';
		Yii::app()->theme='istart';		
		//Yii::import('application.modules.admin.article');
	//	$article = Yii::app()->getModule('article');
	//	$data = $article::model()->find(1);					
	
		//print_r("<pre>");
		//print_r($inav_list);		
		//print_r("</pre>");
		
		
		/* how to build navigation from access datablock 'its work prefect!
		echo "<ul>";
		$temp_depth = 0;
		foreach( $inav_list as $nav ){
			if( $nav['depth'] == 0 ){
				echo "<li>";echo $nav['name'];
			}else if( $nav['depth'] > $temp_depth ){
				echo "<ul>"; echo "<li>"; echo $nav['name'];;
			}else if( $nav['depth'] < $temp_depth){
				for($i=0; $i<$temp_depth-$nav['depth']; $i++){
					echo '</li></ul>';
				}
				echo '<li>';echo $nav['name'];
			}else if( $nav['depth'] == $temp_depth ){
				echo '</li><li>';echo $nav['name'];			
			}
			$temp_depth = $nav['depth'];
		}
		for( $i=0; $i<$temp_depth; $i++){
			echo "</li></ul>";
		}
		echo "</ul>";
		*/				
		//$this->render( 'inav', array('inav_list'=>$inav_list) );
		$this->page_navigation= Datablock::model()->iNav(array('label' => 'istart','depth'	=> 0));		
		$data = Article::model()->findAll();
		$this->render('index', array(
			'data' => $data			
		));
	}
	
	public function actionTada(){		
		$model=new Category;
		$model->attributes=$_POST['Category'];		
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
						echo "Suc";
						exit;
					}								
				}catch(Exception $e) {				
					print(" exception ");					
					$transaction->rollBack();
				}
		}else {
			echo "Error";
			//echo CActiveForm::validate($model);
		}
		exit;
	}
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','inav','book','chapter','category'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('tada'),
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
