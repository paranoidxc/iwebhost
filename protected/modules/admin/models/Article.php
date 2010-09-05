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

 // public function first()
 // {
    //echo '!!!!!!!!';
   //$this->getDbCriteria()->mergeWith(array(
     // 'order' => 'sort_id asc',
      //'limit' => 1
      //'condition'=>'CreatedAt BETWEEN :start AND :end',
      //'params'=>array(':start'=>$start, ':end'=>$end)
        //));
    //return $this;
 // }
  
  public function scopes(){
    return array(
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
			array('title, content, category_id', 'required'),
			array('sort_id, category_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('subtitle', 'length', 'max'=>255),
			array('desc', 'default'),
			array('update_datetime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, subtitle, desc, content, create_datetime, update_datetime, sort_id, category_id', 'safe', 'on'=>'search'),
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
			'leaf' => array( self::BELONGS_TO , 'Category', 'category_id' )
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'subtitle' => 'Subtitle',
			'desc' => 'Desc',
			'content' => 'Content',
			'create_datetime' => 'Create Datetime',
			'update_datetime' => 'Update Datetime',
			'sort_id' => 'Sort',
			'category_id' => 'Category',
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

		$criteria->compare('create_datetime',$this->create_datetime,true);

		$criteria->compare('update_datetime',$this->update_datetime,true);

		$criteria->compare('sort_id',$this->sort_id);

		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
