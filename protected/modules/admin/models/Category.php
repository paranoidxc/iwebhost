<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property integer $lft
 * @property integer $rgt
 * @property string $create_time
 * @property string $update_time
 * @property integer $type
 */
class Category extends CActiveRecord
{
	public $depth;
	public $parent_leaf_id;
	public $parent_leaf;
	
	/**
	 * undocumented function
	 *
	 * @return html
	 * @author paranoid
	 **/	
	public function vleafs($name='root',$depth=1){
		$sql =  " SELECT node.* ,  (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth".
				" FROM category AS node, ".
				" category AS parent, ".
				" category AS sub_parent, ".
				" ( ".
				" SELECT node.name, (COUNT(parent.name) - 1) AS depth ".
				" FROM category AS node, ".
				" category AS parent ".
				" WHERE node.lft BETWEEN parent.lft AND parent.rgt ".
				" AND node.name = '$name' ".
				" GROUP BY node.name ".
				" ORDER BY node.lft ".
				" ) AS sub_tree ".
				" WHERE node.lft BETWEEN parent.lft AND parent.rgt ".
				" AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt ".
				" AND sub_parent.name = sub_tree.name ".
				" GROUP BY node.id ".
				" HAVING depth <= $depth ".
				" ORDER BY node.lft, node.sort_id desc ";
		 return $this->findAllBySql($sql);	
	}
	
	public function articles_to_s() {		
		$r = '';
		foreach( $this->articles as $article ) {
			$r .= $article->title . '<br/>';
		}
		return $r;
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTreeById() {
		 $sql = " SELECT node.id AS id, ".
		 	 	" CONCAT( REPEAT('.', COUNT(parent.name) - 1), node.name) AS name ".      			
        		" FROM category AS node,         ".
        		" category AS parent ".
			    " WHERE node.lft BETWEEN parent.lft AND parent.rgt ".
        		" GROUP BY node.id ".
	        	" ORDER BY node.lft ";
	    return $this->findAllBySql($sql);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,parent_leaf_id', 'required'),
			array('lft, rgt, type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, lft, rgt, create_time, update_time, type', 'safe', 'on'=>'search'),
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
			'articles' => array( self::HAS_MANY, 'Article', 'category_id' , 'order'=>'articles.sort_id asc ',)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'type' => 'Type',
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

		$criteria->compare('name',$this->name,true);

		$criteria->compare('lft',$this->lft);

		$criteria->compare('rgt',$this->rgt);

		$criteria->compare('create_time',$this->create_time,true);

		$criteria->compare('update_time',$this->update_time,true);

		$criteria->compare('type',$this->type);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}