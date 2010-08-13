<?php

class IstartController extends Controller
{
	//public $layout='//layouts/column2';

	public function genUl($nav,&$r=''){
		foreach( $nav['children'] as $child ){
			print_r($child['name']);
		}
	}
	
	public function actionInav(){
		if(isset($_GET['id'])){
			Yii::app()->name = 'iStartPage v0.2 beta';
			Yii::app()->theme='istart';		
			$nav = Datablock::model()->findbyPk($_GET['id']);
			$inav_list = Datablock::model()->iNav(array('label' => $nav->label,'depth'	=> 0));
			$this->render( 'inav', array('inav_list'=>$inav_list) );
		}
	}
	
	public function actionIndex()
	{		
		Yii::app()->name = 'iStartPage v0.2 beta';
		Yii::app()->theme='istart';		
		//Yii::import('application.modules.admin.article');
	//	$article = Yii::app()->getModule('article');
	//	$data = $article::model()->find(1);		
	
		$inav_list = Datablock::model()->iNav(array('label' => 'istart','depth'	=> '4'));
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
				'actions'=>array('index','inav'),
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
