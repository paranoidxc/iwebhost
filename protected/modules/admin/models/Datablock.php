<?php
/**
 * This is the model class for table "datablock".
 *
 * The followings are the available columns in table 'datablock':
 * @property integer $id
 * @property string $name
 * @property integer $p_id
 * @property string $type
 * @property string $rel_value
 * @property string $template
 * @property integer $sort_id
 */
class Datablock extends CActiveRecord
{
	public function pushChild($obj,&$r,$i,$depth){		
		if( $i > $depth ){
			return;
		}
		$i++;
		foreach( $obj->children as $t){
			$r[] = array('name' => $t->name , 'depth' => $i);
			if( $t->children ){			
				$this->pushChild($t,$r,$i,$depth);
			}			
		}
	}
	
	public function iNav($options){
		$_r = $this->find(' label = :label', array( ':label' => $options['label'] ) );
		$r = array();
		$i = 0;
		foreach( $_r->children as $obj ){
			$r[] = array('name' => $obj->name , 'depth' => $i);
			if( $options['depth'] >= 1 ){				
				$this->pushChild($obj,&$r,$i,$options['depth']);
			}			
		}
		return $r;
	}
	/*public function pushChild($obj,&$r=array()){		
		
		foreach($obj->children as $t ){
			$temp = array(
				'name'	 	=> $t->name,
				'label'		=> $t->label,
				'p_id'		=> $t->p_id				
			);
			if( $t->children ){
				$temp['children'] = $this->pushChild($t);
			}
			$r[] = $temp;
		}
		return $r;
	}
	
	public function iNav($options){
		print_r($options);		
		$r = $this->find(' label = :label', array( ':label' => $options['label'] ) );
		$_r = array();
		foreach( $r->children as $obj ){
			//$_r[] = $obj;
			$temp = array(
				'name'	 	=> $obj->name,
				'label'		=> $obj->label,
				'p_id'		=> $obj->p_id				
			);
			
			if( $options['depth'] > 1 ){
				$temp['children'] = $this->pushChild($obj);
			}			
			$_r[] = $temp;
		}		
		return $_r;
	}
	*/
	/**
	 * Returns the static model of the specified AR class.
	 * @return Datablock the static model class
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
		return 'datablock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,label', 'required'),			
			array('label', 'unique'),
			array('p_id, sort_id', 'numerical', 'integerOnly'=>true),
			array('name, rel_value, template', 'length', 'max'=>100),
			array('type', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, p_id, type, rel_value, template, sort_id', 'safe', 'on'=>'search'),
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
			'parent' 	=> array( self::BELONGS_TO, 'Datablock', 'p_id' ),
			'children' 	=> array( self::HAS_MANY, 	'Datablock', 'p_id', 'order' => ' sort_id asc ' ),
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
			'p_id' => 'P',
			'type' => 'Type',
			'rel_value' => 'Rel Value',
			'template' => 'Template',
			'sort_id' => 'Sort',
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

		$criteria->compare('p_id',$this->p_id);

		$criteria->compare('type',$this->type,true);

		$criteria->compare('rel_value',$this->rel_value,true);

		$criteria->compare('template',$this->template,true);

		$criteria->compare('sort_id',$this->sort_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}