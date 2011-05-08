<?php

class FController extends Controller {	
  public function actionAll() {
    $nodes = API::INODE( array( 'ident_label' =>  'forum_node' ) );
    $this->render('all',array(
          'nodes' => $nodes
          ) ,false,true);
  }

  public function actionLove(){
//    $record = ManyCategoryUser::model()->findAllByAttributes(array( 'user_id'=>User()->id) );
 //   $record->deleteAll();
    $record = ManyCategoryUser::model()->deleteAll(array( 'user_id'=>User()->id) );

    $nodes = $_POST['nodes'];
    foreach($nodes as $node ){
      $rel = new ManyCategoryUser;
      $rel->category_id = $node;
      $rel->user_id     = User()->id;
      $rel->save();
    }
    $this->redirect( rurl() );
  }

	public function actionIndex(){			  
    $_criteria = new CDbCriteria;
    $_criteria->condition  = ' find_in_set(category_id, :category_id)';
 
		if( isset( $_GET['id'] ) ){
      // sepcial node 
		  $node = Category::model()->findByPk($_GET['id']);		  
		  if($node===null){
			  throw new CHttpException(404,'The requested Node does not exist.');
		  }		  
      $this->_pageTitle = $node->name.API::lchart();
		  $articles = $node->forumarticles;		  
      $_criteria->params[':category_id'] = $node->id;
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
      
      $_criteria->params[':category_id'] = $all_leafs;
		}

    $latest_articles = Article::model()->latest()->findAll($_criteria);
		$this->render('index', array('latest_articles' => $latest_articles, 'articles' => $articles, 'node' => $node ));
	}	
}
