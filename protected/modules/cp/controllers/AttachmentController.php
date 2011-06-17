<?php

class AttachmentController extends GController
{
	
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
				'actions'=>array('upload'),
				'users'=>array('*'),
			),
	
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','upload','pick','move','BatchEdit','BatchUpdate','leaf_create','leaf_update'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','batch'),
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

	public function actionMove() {		
		
	  $panel_ident = $_REQUEST['panel_ident'];
		if( isset($_POST['category_id']) ){			
			$category_id = $_POST['category_id'];
			$category = Category::model()->findByPk($category_id);
			$ids = explode(',',$_POST['ids']);
			foreach( $ids as $id) {				
				$at = Attachment::model()->findByPk($id);
				if( $at ) {									
					$at->category_id = $category->id;
					$at->save();				
				}
			}			
			echo count($ids)." record(s) are move to ";
			echo $category->name;
			exit;
		}
		
		//$_data = Category::model()->getTreeById();
		//$leafs = CHtml::listdata($_data, 'id','name');
		
		$leafs = Category::model()->ileafs(
        array( 'id' => $_GET['top_leaf_id'],'include' => true )
	  );	  
				
		$this->renderPartial('move', array(
			'leafs' => $leafs,
			'panel_ident' => $panel_ident,
		),false, true);
	}
	
	
	public function actionPick(){		
		$return_id = $_GET['return_id'];
		$this->renderPartial('pick',array('return_id' => $return_id),false,true);
	}
  /**
   * undocumented function
   *
   * @return void
   * @author paranoid
   **/
  public function actionUpload()
  {    

    $category_id = $_GET['category_id'];
    $user_id     = $_GET['user_id'];
    if( strlen( trim($category_id) ) ==  0 ) {
      //$category_id = 30;
      $category_id = Category::model()->autoCreate();      
    }    

	  ini_set("html_errors", "0");
    $upload_name = "Filedata";
    $path_info = pathinfo($_FILES[$upload_name]['name']);
	  $file_extension = $path_info["extension"];
    $valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';				// Characters allowed in the file name (in a Regular Expression format)
    //$screen_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
    $screen_name  =  basename($_FILES[$upload_name]['name']);
    $time = time();
    $file_name = $time.'.'.$file_extension;

    $put_file_path = API::upload_prefix_dir();
    $put_file_to_dir = ATMS_SAVE_DIR.$put_file_path;

    if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $put_file_to_dir.$file_name)) {	  	
      echo 'fuck';
		  exit(0);
	  }
	  
	  $model=new Attachment;
	  
	  $is_image = false;
	  $w = 0;
	  $h = 0;
	  if( in_array(strtolower($file_extension),API::$IMAGE_EXTENSION) ){
	    $image = Yii::app()->image->load($put_file_to_dir.$file_name);
	    $w = $image->width;	    
	    $h = $image->height;
	    $is_image = true;
	  }
	  
	  $ati = array(
	    'screen_name' => $screen_name,
	    'path'        => $put_file_path.$time,
	    'w' => $w,
	    'h' => $h,
  	  'c_time' => Time::now(),
  	  'extension' => $file_extension,
	    'category_id' => $category_id,
      'user_id'     => $user_id,
    );
	  $model->attributes=$ati;
	  if($model->save()){
	    if( $is_image ){
	      
	      $file_path_l = $put_file_to_dir.$time.'_800_600'.'.'.$file_extension;
        $file_path_t = $put_file_to_dir.$time.'_160_120'.'.'.$file_extension;
        $file_path_g = $put_file_to_dir.$time.'_48_48'.'.'.$file_extension;        
        
        if( $w >800 && $h>600){
          $image->resize(800, 600);
        }
        $image->save($file_path_l);          	            
        
        if( $w >160 && $h>120){
          $image->resize(160, 120);
        }
        //,Image::NONE);        
        $image->save($file_path_t);
        
        $image->resize(48, 48);
        $image->save($file_path_g);
        
        $model->tips  = str_pad($w, 4, "_", STR_PAD_LEFT).'*'. str_pad($h,4,"_", STR_PAD_RIGHT).',';
        $model->tips .= '_800*600_,';
        $model->tips .= '_160*120_,';
        $model->tips .= '__48*48__,';
        $model->save();
        rename($put_file_to_dir.$file_name, $put_file_to_dir.$time.'_'.$w.'_'.$h.'.'.$file_extension );
      }
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
    $action =& $_GET['action'];
    $cur_leaf_id =& $_GET['leaf_id'];
    $cur_leaf = Category::model()->findByPk($cur_leaf_id);
    $leafs = Category::model()->findAll( array( 
          'select' => 'id, name',
          'condition'  => ' rgt <= :rgt AND lft >= :lft ',
          'params'    => array( ':rgt' => $cur_leaf->rgt, ':lft' => $cur_leaf->lft )
    ) );
    $all_leafs = '';
    foreach( $leafs as $_leaf ){
      $all_leafs .= $_leaf->id.',';
    }        
    $model = new Attachment;
    $criteria=new CDbCriteria;
    $criteria->condition = ' find_in_set(category_id, :category_id)';
    $criteria->limit = '10000';
    $criteria->order =' c_time DESC ';
    $criteria->params[':category_id'] = $all_leafs;
    $list = $model->findAll( $criteria );

    $leaf_tree = $this->getTree(30);
		$this->render('create',array( 'list' => $list,'cur_leaf'=>$cur_leaf,
                          'leaf_tree' => $leaf_tree,'action' => $action) );
	}

  public function actionBatchUpdate(){
    
    $ids = $_POST['ids'];
    $list = explode(',',$ids);
    $resize_w = $_POST['resize_w'];
		$resize_h = $_POST['resize_h'];
		
    foreach( $list as $id){
      $model=Attachment::model()->findbyPk($id);      
      if( !$model->is_image() ){
        continue;  
      }
      unset($tips);
      if( is_array( $resize_w ) && count( $resize_w) > 0 ){
        for( $i=0; $i<count($resize_w); $i++ ){
          if( is_numeric($resize_w[$i]) && is_numeric($resize_h[$i]) ){
            $image = Yii::app()->image->load(ATMS_SAVE_DIR.$model->path.'.'.$model->extension);		        
            $_path= ATMS_SAVE_DIR.$model->path.'_'.$resize_w[$i].'_'.$resize_h[$i].'.'.$model->extension; 
            $image->resize($resize_w[$i], $resize_h[$i]);
            $image->save($_path);
            if( isset($tips) ){
              $tips .= str_pad($resize_w[$i], 4, "_", STR_PAD_LEFT).'*'. str_pad($resize_h[$i],4,"_", STR_PAD_RIGHT).',';                  
            }else{
              $tips = str_pad($resize_w[$i], 4, "_", STR_PAD_LEFT).'*'. str_pad($resize_h[$i],4,"_", STR_PAD_RIGHT).',';
            }
				  }
        }
        if( isset($tips) ){
			    $model->tips .= $tips;
			    $model->save();
				}
      }
    }
    echo 'update';
    exit;
  }
  
  public function actionBatchEdit(){
    $ids = $_GET['ids'];
    $this->renderPartial('batch_edit',array(		  
      'ids' => $ids
		),false,true);
  }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
    $action       =& $_GET['action'];
    $top_leaf_id  =& $_GET['top_leaf_id'];
		$model=$this->loadModel();
		if(isset($_POST['Attachment']))
		{
			$model->attributes=$_POST['Attachment'];
			if($model->save()){
			  if( isset($_GET['ajax']) ) {
					//echo 'update attachment suc';
					if($model->is_image()){
  					$resize_w = $_POST['resize_w'];
  					$resize_h = $_POST['resize_h'];
  					if( is_array( $resize_w ) && count( $resize_w) > 0 ){
  					  for( $i=0; $i<count($resize_w); $i++ ){
  					    if( is_numeric($resize_w[$i]) && is_numeric($resize_h[$i]) ){			      
  					      $image = Yii::app()->image->load(ATMS_SAVE_DIR.$model->path.'_'.$model->w.'_'.$model->h.'.'.$model->extension);
  					      list($y,$m,$d,$iname) =  explode('/',$model->path);
                  $_path= ATMS_SAVE_DIR.$y.'/'.$m.'/'.$d.'/'.$iname.'_'.$resize_w[$i].'_'.$resize_h[$i].'.'.$model->extension; 
                  $image->resize($resize_w[$i], $resize_h[$i]);
                  $image->save($_path);
                  if( isset($tips) ){
                    $tips .= str_pad($resize_w[$i], 4, "_", STR_PAD_LEFT).'*'. str_pad($resize_h[$i],4,"_", STR_PAD_RIGHT).',';                  
                  }else{
                    $tips = str_pad($resize_w[$i], 4, "_", STR_PAD_LEFT).'*'. str_pad($resize_h[$i],4,"_", STR_PAD_RIGHT).',';
                  } 
  					    }
  					  }
  					  if( isset($tips) ){
  					    $model->tips .= $tips;
  					    $model->save();
  					  }
  					}
					}
				}else {
					$str = 'Data Updated Suc On '.Time::now();
					Yii::app()->user->setFlash('success',$str);
					$this->redirect(array('update','id'=>$model->id,'action' => $action, 'top_leaf_id' => $top_leaf_id ));	
				}	
			}
		}
    $top_leaf = Category::Model()->findByPk($top_leaf_id);
    $leaf_tree =& $this->getTree($top_leaf_id);
    $this->render('update',array( 'model'=>$model,
          'leaf_tree' => $leaf_tree,'action' => $action, 'top_leaf' => $top_leaf),false,true);
	}

  /*
  public function actionBatch() {
    if(Yii::app()->request->isPostRequest) {
		  if( count($_POST['ids']) >0 ) {
				$ids = $_POST['ids'];
				foreach( $ids as $id) {
					$a = Attachment::model()->findByPk($id);
				  $a->delete();  
				}
				$str = '已删除 '.count($ids).' 个用户数据 '.Time::now();
  			Yii::app()->user->setFlash('success',$str);
			}
    }

    $this->redirect( array('index') );
  }
  */

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	 /*
	/**
	 * Lists all models.
	 */
  public function getTree($top_leaf='') {
    if( strlen($top_leaf) > 0 ) {
      return Category::model()->ileafs( array( 'id' => $top_leaf ,'include' => true ) );
    }else{
      return Category::model()->ileafs( array( 'ident' => 'Root' ,'include' => true ) );
    }
  }

	public function actionIndex($top_leaf_id='',$cur_leaf_id='') {

    //fetch top leaf
    if( strlen($top_leaf_id) == 0 ) {
      $top_leaf_id = 30;
    }
    $top_leaf = Category::model()->findByPk($top_leaf_id);

    //fetch current leaf
    if( strlen($cur_leaf_id) == 0 ) {
      $cur_leaf_id  =& $_GET['category_id'];
    }
    $cur_leaf     = Category::model()->findByPk($cur_leaf_id);

	  $criteria=new CDbCriteria;
    $criteria->condition = " 1=1 ";
		if( isset($_GET['keyword']) || !empty($_GET['keyword']) 
        || strlen($_GET['keyword']) >0 || strlen($_GET['leaf_id'] ) > 0 ){
		  $keyword = trim($_GET['keyword']);			  
      $criteria->condition  .= ' AND screen_name like :keyword ';
      $criteria->params     = array(':keyword'=>"%$keyword%");      
      $opt['tpl_params']['keyword'] =& $_REQUEST['keyword'];
	  }

    $is_include = true;
    if( strlen( $cur_leaf_id) > 0 ){
      $criteria->condition  .= ' AND find_in_set(category_id, :category_id)';
      if( $is_include ){
        $leafs = Category::model()->findAll( array( 
          'select' => 'id, name',
          'condition'  => ' rgt <= :rgt AND lft >= :lft ',
          'params'    => array( ':rgt' => $cur_leaf->rgt, ':lft' => $cur_leaf->lft )
        ) );
        $all_leafs = '';
        foreach( $leafs as $_leaf ){
          $all_leafs .= $_leaf->id.',';
        }        
        $criteria->params[':category_id'] = $all_leafs;
      }else{
        $criteria->params[':category_id'] = $cur_leaf_id;  
      }
    }

    $criteria->order =' c_time DESC ';
    $leaf_tree =& $this->getTree($top_leaf_id);
    $opt['criteria']        =  $criteria;
    $opt['tpl_params']['top_leaf']  =& $top_leaf;
    $opt['tpl_params']['cur_leaf']  =& $cur_leaf;
    $opt['tpl_params']['leaf_tree'] =& $leaf_tree;

    parent::actionIndex($opt);
	}

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

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='attachment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
