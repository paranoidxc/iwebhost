<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class GController extends Controller
{
  /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	public $_model;
  public $tpl_params;

	public function init() {	  	  
	  if( !Yii::app()->user->isGuest ){
	    if( !Yii::app()->user->getState('current_user') ){
	      Yii::app()->user->setState('current_user', User::model()->findbyPk(Yii::app()->user->id ));
	    }	   	    
	    $u =Yii::app()->user->getState('current_user');		    
	    if( !$u->account_type ) {
	      $this->redirect( array( '/' ));
	      exit; 
	    }
    }    
	  parent::init();
	}
	
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id'])){
  			$controllerId = $this->controllerId;
	  		$imodel = new $controllerId;
				$this->_model=$imodel->findbyPk($_GET['id']);  
			}			
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	
	/**
	 * Lists all models.
	 */
	public function actionIndex($opt=null) {
	  $controllerId = strlen($opt['controllerId']) > 0 ? $opt['controllerId'] : $this->controllerId;	  
	  if( !is_array($opt) ){
	    $criteria=new CDbCriteria;
	    $keyword = trim($_GET['keyword']);      
	  }else{
	    extract($opt);
	  }

    if( isset($_GET['id_start']) && !empty($_GET['id_start']) ) {
      $criteria->condition .= " AND id >= :id_start ";
      $criteria->params[':id_start'] =& $_GET['id_start'];
      $tpl_params['id_start'] =& $_GET['id_start'];
    }
    if( isset($_GET['id_end']) && !empty($_GET['id_end']) ) {
      $criteria->condition .= " AND id <= :id_end ";
      $criteria->params[':id_end'] =& $_GET['id_end'];
      $tpl_params['id_end'] =& $_GET['id_end'];
    }

    if( isset($_GET['account_type']) && !empty($_GET['account_type']) ) {
      $criteria->condition .= " AND account_type = :account_type ";
      $criteria->params[':account_type'] =& $_GET['account_type'];
      $tpl_params['account_type'] =& $_GET['account_type'];
    }

    $tpl_params['is_hide_adv'] =& $_GET['is_hide_adv'];

    $imodel = new $controllerId;
    $item_count = call_user_func( array( $imodel, 'count') , $criteria );    
    $page_size = strlen($opt['page_size']) > 0 ? $opt['page_size'] : 10;          
    $pages =new CPagination($item_count);
    $pages->setPageSize($page_size);      
    $pagination = new CLinkPager();
    $pagination->cssFile=false;
    $pagination->setPages($pages);    
    $pagination->init();      
    $criteria->limit        =  $page_size;
    $criteria->offset       = $pages->offset;
    $select_pagination = new  CListPager();
    $select_pagination->header = Yii::t('cp','Go to:');
//    $select_pagination->htmlOptions['onchange']="";
    
    $select_pagination->setPages($pages);    
    $select_pagination->init();    
    $list = call_user_func( array( $imodel, 'findAll') , $criteria );
    
    if( !is_array($opt['tpl_params']) ){
      $opt['tpl_params'] = array();
    }
    
    $opt['tpl_params']['list']        = $list;
    $opt['tpl_params']['pagination']  = $pagination;
    $opt['tpl_params']['select_pagination']  = $select_pagination;

    // echo Chtml::listBox('category_id',1,$leafs) 
    //print_r($opt['tpl_params']);
    
    $this->tpl_params =& $tpl_params;
	  if( $is_partial ){	    
	    $this->renderPartial('_index', $opt['tpl_params'], false, true );
	  }else{
	    $tpl = strlen( $opt['tpl'] ) > 0 ? $opt['tpl'] : 'index';
	    if( $_GET['ajax'] == 'ajax'){	      
	      $this->renderPartial($tpl, $opt['tpl_params'], false, true );  
	    }else{
	      $this->render($tpl, $opt['tpl_params'], false, true );  
	    }
	  } 
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

		if(isset($_POST[$this->controllerId]))
		{
			$model->attributes=$_POST[$this->controllerId];
			$model->a_time = Time::now();
			if($model->save()){
			  $str = Yii::t('cp','Data saved success On ').Time::now();
			  Yii::app()->user->setFlash('success',$str);
			  $this->redirect(array('Update','id'=>$model->id));	
			}
		}

 		$this->render('update',array( 'model'=>$model,));  
	}	
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */

  public function actionBatch() {
  	if(Yii::app()->request->isPostRequest) {
      $type = $_POST['type'];
			if( count($_POST['ids']) >0 && $type=="删除") {
				$ids =& $_POST['ids'];
				foreach( $ids as $id) {
				  $imodel = new $this->controllerId;
					$item = $imodel->findByPk($id);
					$item->delete();
				}
        $str = '已删除 '.count($ids).' 个用户数据 '.Time::now();
      	Yii::app()->user->setFlash('success',$str);
        $this->redirect( array('index') );
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

  }

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			if( strlen($_POST['ids']) >0 ) {
				$ids = explode(',',$_POST['ids']);
				foreach( $ids as $id) {
				  $imodel = new $this->controllerId;
					$item = $imodel->findByPk($id);
					$item->delete();
					//echo $item->title;
				} 
        $str = '已删除 '.count($ids).' 个用户数据 '.Time::now();
      	Yii::app()->user->setFlash('success',$str);
        $this->redirect( array('index') );
			}			
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}
?>
