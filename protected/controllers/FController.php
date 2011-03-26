<?php

class FController extends Controller {	
	public function actionIndex(){			  
		if( isset( $_GET['id'] ) ){
      // sepcial node 
		  $node = Category::model()->findByPk($_GET['id']);		  
		  if($node===null){
			  throw new CHttpException(404,'The requested Node does not exist.');
		  }		  
      $this->_pageTitle = $node->name.API::lchart();
		  $articles = $node->forumarticles;		  
		}else{
      //site index 
		  $model = Category::model()->findByAttributes( array('ident_label' => 'forum_node') );
		  $criteria = new CDbCriteria;
		  $criteria->condition  = ' find_in_set(category_id, :category_id)';
		  $criteria->order = 'reply_time desc';
		  $criteria->limit = '20';
		  $leafs = Category::model()->findAll( array( 
        'select' => 'id, name',
        'condition'  => ' rgt <= :rgt AND lft >= :lft ',
        'params'    => array( ':rgt' => $model->rgt, ':lft' => $model->lft )
      ) );
      $all_leafs = '';
      foreach( $leafs as $_leaf ){
        $all_leafs .= $_leaf->id.',';
      }        
      $criteria->params[':category_id'] = $all_leafs;
      $articles = Article::model()->findAll( $criteria );
		}
		$this->render('index', array('articles' => $articles, 'node' => $node ));
	}	
}
