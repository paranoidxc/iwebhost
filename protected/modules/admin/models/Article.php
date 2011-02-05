<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property string $desc
 * @property string $content
 * @property string $create_datetime
 * @property string $update_datetime
 * @property integer $sort_id
 * @property integer $category_id
 */
class Article extends CActiveRecord
{  
  public function __get($name)
  {    
    $getter='get'.$name;
    if(method_exists($this,$getter))
      return $this->$getter();
      
    return parent::__get($name);
  }
  public function iprint() {    
    echo '<table style="border-collapse:collapse; border: 1px solid #4A525A; font-size: 12px;">';
    echo '<tr>';
    foreach( $this->attributes as $k => $v ){      
      echo '<th style="border: 1px solid #4A525A; text-align:left;">'.$k.'</th>';      
    }
    echo '</tr>';
    echo '<tr>';
    foreach( $this->attributes as $k => $v ){    
      if( $k == 'content'){
        echo '<td style="border: 1px solid #4A525A; text-align: left;">'.cnSub($v,100).'</td>';
      }else{
        echo '<td style="border: 1px solid #4A525A; text-align: left;">'.$v.'</td>';
      }
    }
    echo '</table>';
  }
  
  public function getNext($opt) {
    $order_name   = empty($opt['order_name']) ? ' id ' : $opt['order_name'];
    $node_id = empty($opt['node_id']) ? '' : $opt['node_id'];      
    if( $node_id == '' ){            
      $_article = self::model()->find(array(
        'condition' => 'category_id=:category_id and sort_id < :sort_id',
        //'order'     => 'sort_id desc',
        'order'     => $order,
        'params'   => array( ':category_id' => $this->category_id, ':sort_id' => $this->sort_id) ));
      return $_article;
    }else{
      $node = Category::model()->findByPK($node_id);      
      $sub_nodes = Category::model()->findAll( array(
        'condition' => 'lft >= :lft AND rgt <= :rgt ',
        'params'    => array( ':lft' => $node->lft, ':rgt' => $node->rgt )
      ) );        
      $node_ids = '';
      foreach( $sub_nodes as $n ){        
        $node_ids .= $n->id.',';
      }      
      if( $node_ids != '' ){            
        
        $con=new CDbConnection(Yii::app()->db->connectionString, Yii::app()->db->username ,Yii::app()->db->password);
        $con->active = true;        
        $command=$con->createCommand("SET @num=0;");
        $command->execute();
        $find_current_virtual_number = " SELECT  number FROM ( 
                 SELECT @num := @num + 1 AS number, id,  title, sort_id FROM  article WHERE  FIND_IN_SET(category_id,'$node_ids') 
                  ORDER BY $order_name DESC 
                ) AS tbl 
                WHERE 
            id = $this->id";          
        /*$find_current_virtual_number = " SELECT  number FROM ( 
                 SELECT @num := @num + 1 AS number, id,  title, sort_id FROM  article WHERE  FIND_IN_SET(category_id,'$node_ids') 
                  ORDER BY sort_id DESC,create_time DESC
                ) AS tbl 
                WHERE 
            id = $this->id";          
            */
        $command=$con->createCommand($find_current_virtual_number);
        $row = $command->queryRow();
        $current_number = $row['number'];
        
        $command=$con->createCommand("SET @num=0;");
        $command->execute();
        $find_next_sql = "SELECT  number, id,  title, sort_id  
                          FROM ( 
                            SELECT @num := @num + 1 AS number, id,  title, sort_id FROM  article WHERE  FIND_IN_SET(category_id,'$node_ids') 
                            ORDER BY $order_name DESC
                            ) AS tbl 
                          WHERE number > $current_number ORDER BY number asc LIMIT 1 ";
        $command=$con->createCommand($find_next_sql);
        $row = $command->queryRow();
        if( count($row) > 0 ){
          return Article::model()->findByPk($row['id']);
        }
      }
      return array();
    }
  }
  
  public function getPrev( $opt ) {        
    $order_name   = empty($opt['order_name']) ? ' id ' : $opt['order_name'];
    $node_id = empty($opt['node_id']) ? '' : $opt['node_id'];
    
    if( $node_id == '' ){
      $_article = self::model()->find(array(
        'condition' => 'category_id=:category_id and sort_id > :sort_id',
        'order'     => 'sort_id asc',
        'params'   => array( ':category_id' => $this->category_id, ':sort_id' => $this->sort_id) ));    
      return $_article;
    }else{
      
      $node = Category::model()->findByPK($node_id);      
      $sub_nodes = Category::model()->findAll( array(
        'condition' => 'lft >= :lft AND rgt <= :rgt ',
        'params'    => array( ':lft' => $node->lft, ':rgt' => $node->rgt )
      ) );        
      $node_ids = '';
      
      foreach( $sub_nodes as $n ){        
        $node_ids .= $n->id.',';
      }
      if( $node_ids != '' ){
        $con=new CDbConnection(Yii::app()->db->connectionString, Yii::app()->db->username ,Yii::app()->db->password);
        $con->active = true;        
        $command=$con->createCommand("SET @num=0;");
        $command->execute();
        $find_current_virtual_number = " SELECT  number FROM ( 
                 SELECT @num := @num + 1 AS number, id,  title, sort_id FROM  article WHERE  FIND_IN_SET(category_id,'$node_ids') 
                  ORDER BY $order_name DESC
                ) AS tbl 
                WHERE 
            id = $this->id";      
        $command=$con->createCommand($find_current_virtual_number);
        $row = $command->queryRow();
        $current_number = $row['number'];
        $command=$con->createCommand("SET @num=0;");
        $command->execute();        
        $find_next_sql = "SELECT  number, id,  title, sort_id  
                          FROM ( 
                            SELECT @num := @num + 1 AS number, id,  title, sort_id FROM  article WHERE  FIND_IN_SET(category_id,'$node_ids') 
                            ORDER BY $order_name DESC
                            ) AS tbl 
                          WHERE number < $current_number ORDER BY number DESC LIMIT 1 ";
        $command=$con->createCommand($find_next_sql);
        $row = $command->queryRow();
        if( count($row) > 0 ){
          return Article::model()->findByPk($row['id']);
        }          
      }
      return array();
    }
  }
  
  public function scopes(){      
    return array(
      'most_page_view' => array(
        'order' => ' pv DESC ',
        'limit' => '10',
      ),
      'first' => array(
        'order' => ' sort_id asc ',
        'limit' => 1
      )
    );            
  }
	/**
	 * Returns the static model of the specified AR class.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attachment_id, gallery_id,content,is_star,rich,tpl,pv','default'),
			array('title, category_id', 'required'),
			array('sort_id, category_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('link', 'length', 'max'=>255),
			array('desc', 'default'),			
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, subtitle, desc, content, create_time, update_time, sort_id, category_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'leaf' 			=> array( self::BELONGS_TO , 'Category', 	'category_id' ),
			'attachment'	=> array( self::BELONGS_TO,  'Attachment',	'attachment_id'),
			'gallery'		=> array( self::BELONGS_TO,  'Category',	'gallery_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'        => 'ID',
			'title'     => 'Title',
			'subtitle'  => 'Subtitle',
			'desc'      => 'Desc',
			'content'     => 'Content',
			'create_time' => 'Create Datetime',
			'update_time' => 'Update Datetime',
			'sort_id'     => 'Sort',
			'category_id' => 'Category',
			'is_star'     => 'stared?'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('subtitle',$this->subtitle,true);

		$criteria->compare('desc',$this->desc,true);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('create_time',$this->create_time,true);

		$criteria->compare('update_time',$this->update_time,true);

		$criteria->compare('sort_id',$this->sort_id);

		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
