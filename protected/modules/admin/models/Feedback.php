<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property string $email
 * @property string $homepage
 * @property string $question
 * @property string $answer
 * @property string $itype
 */
class Feedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Feedback the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

 function behaviors() {
    return array(
        'tags' => array(
            'class' => 'ext.yiiext.behaviors.model.taggable.ETaggableBehavior',
            // Table where tags are stored
            'tagTable' => 'Tag',
            // Cross-table that stores tag-model connections.
            // By default it's your_model_tableTag
            'tagBindingTable' => 'modelTag',
            // Foreign key in cross-table.
            // By default it's your_model_tableId
            //'modelTableFk' => 'id',
            // Tag table PK field
            'tagTablePk' => 'id',
            // Tag name field
            'tagTableName' => 'name',
            // Tag counter field
            // if null (default) does not write tag counts to DB
            'tagTableCount' => 'count',
            // Tag binding table tag ID
            'tagBindingTableTagId' => 'tagId',
            // Caching component ID.
            // false by default.
            'cacheID' => 'cache',
 
            // Save nonexisting tags.
            // When false, throws exception when saving nonexisting tag.
            'createTagsAutomatically' => true,
 
            // Default tag selection criteria
            'scope' => array(
                //'condition' => ' t.user_id = :user_id ',
                //'params' => array( ':user_id' => Yii::app()->user->id ),
            ),
 
            // Values to insert to tag table on adding tag
            'insertValues' => array(
                'user_id' => Yii::app()->user->id,
            ),
        )
    );
}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('q_time, a_time', 'default'),
			array('email, homepage, question, answer, itype', 'required'),
			array('email, homepage, answer, itype', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, homepage, question, answer, itype', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'homepage' => 'Homepage',
			'question' => 'Question',
			'answer' => 'Answer',
			'itype' => 'Itype',
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

		$criteria->compare('email',$this->email,true);

		$criteria->compare('homepage',$this->homepage,true);

		$criteria->compare('question',$this->question,true);

		$criteria->compare('answer',$this->answer,true);

		$criteria->compare('itype',$this->itype,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}