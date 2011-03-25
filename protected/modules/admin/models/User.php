<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $parent_id
 */
class User extends CActiveRecord
{  
  public function __get($name)
  {    
    $getter='get'.$name;
    if(method_exists($this,$getter))
      return $this->$getter();
      
    return parent::__get($name);
  }
  
  public function getgravatar(){    
    return '/default_image/'.($this->id%100).'.png';
    //return "http://www.gravatar.com/avatar/".md5($this->email)."?s=80&d=identicon&rating=PG";
    
    //return rand(0, 100).'.png';
  }
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('current_login_time,last_logout_time,login_count,token','default'),
			array('username, password, email,c_time', 'required'),
			array('username','unique'),
			array('email','unique'),
			array('email','email'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('username, email', 'length', 'max'=>100),
			array('password', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, parent_id', 'safe', 'on'=>'search'),
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
			'username'            => Yii::t('cp','Username'),
			'password'            => Yii::t('cp','Password'),
			'email'               => Yii::t('cp','Email'),
			'c_time'              => Yii::t('cp','Account Create Time'),
			'current_login_time'  => Yii::t('cp','Current Login Time'),
  		'current_ip'          => Yii::t('cp','Current IP'),
  		'last_ip'             => Yii::t('cp','Last IP'),
  		'last_logout_time'    => Yii::t('cp','Last Logout Time'),
			'parent_id'           => 'Parent',
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

		$criteria->compare('username',$this->username,true);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}