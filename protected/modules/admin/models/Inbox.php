<?php

/**
 * This is the model class for table "inbox".
 *
 * The followings are the available columns in table 'inbox':
 * @property integer $id
 * @property integer $source_id
 * @property integer $dest_id
 * @property string $memo
 * @property string $c_time
 * @property integer $parent_id
 */
class Inbox extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Inbox the static model class
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
		return 'inbox';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source_id, dest_id, memo, c_time ', 'required'),
			array('source_id, dest_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('memo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, source_id, dest_id, memo, c_time, parent_id', 'safe', 'on'=>'search'),
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
        'source' => array( self::BELONGS_TO, 'User', 'source_id'),
        'dest'   => array( self::BELONGS_TO, 'User', 'dest_id'),
        'posts'  => array( self::HAS_MANY, 'Inbox', 'parent_id' ,'order' => 'c_time ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'source_id' => 'Source',
			'dest_id' => 'Dest',
			'memo' => 'Memo',
			'c_time' => 'C Time',
			'parent_id' => 'Parent',
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

		$criteria->compare('source_id',$this->source_id);

		$criteria->compare('dest_id',$this->dest_id);

		$criteria->compare('memo',$this->memo,true);

		$criteria->compare('c_time',$this->c_time,true);

		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
