<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class IController extends Controller
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
			if(isset($_GET['id']))
			$controllerId = $this->controllerId;
			$imodel = new $controllerId;
				$this->_model=$imodel->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	
	/**
	 * Lists all models.
	 */
	public function actionIndex($opt=null) {
	  $controllerId = $this->controllerId;	  
	  if( !is_array($opt) ){
	    $criteria=new CDbCriteria;
	    $keyword = trim($_GET['keyword']);			  
      //$criteria->condition  = 'question like :keyword OR answer like :keyword';
      //$criteria->params     = array(':keyword'=>"%$keyword%");      
	  }else{
	    extract($opt);
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
				  $imodel = new $this->controllerId;
					$item = $imodel->findByPk($id);
					$item->delete();
					//echo $item->title;
				} 
				echo $str = count($ids).' '.$this->controllerId.' has been deleted on '.Time::now();
				//Yii::app()->user->setFlash('success',$str);
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
}
?>