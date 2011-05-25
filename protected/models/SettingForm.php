<?php

class SettingForm extends CFormModel
{
  public $id;
	public $password;
	public $rpassword;
  public $sign;
  public $avatar;
	public function rules()
	{
		return array(			
      array('password', 'match', 'pattern'=>'/^([a-z0-9_])+$/', 'message' => '字符范围26个英文字符(a-z),数字(0-9)和下划线(_)'),
    	array('password', 'length', 'allowEmpty' => true, 'min'=>5),
			array('password, rpassword,id,sign', 'default'),		
			array('rpassword', 'compare','compareAttribute'=>'password', 'message' =>'两次密码必须一致!'),
      array('avatar', 'file', 'allowEmpty'=>true,'maxSize' => '1048576', 'types'=>'jpg,jpeg, gif, png'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
  		'password'    => '新密码',
  		'rpassword'   =>  '请再输入一次',
		);
	}
	
	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function setting()
	{	
	  $record = User::model()->findByPk( $this->id );
	  if( $record == null ){
	    $this->addError('password',Yii::t('cp','user is missing.' ));
	    return false;
    }else {
      $record->sign     = $this->sign;
      if( strlen($this->password) > 0 ) {
        $record->password = $this->password;
      }
      if( $this->avatar ) {
        $name = md5($record->id).'.'.strtolower($this->avatar->getExtensionName());
        $source_avatar_path = UPFILES_AVTS_DIR.'/source_'.$name;
        $avatar_path = UPFILES_AVTS_DIR.'/'.$name;
        $this->avatar->saveAs( $source_avatar_path );
        $record->avatar = $this->avatar = $name;

        $avatar = Yii::app()->image->load($source_avatar_path);
        if($avatar->width > 600 || $avatar->height > 400 ){
          $avatar->resize(600, 400);
        }
        $avatar->save($source_avatar_path);

        $avatar->resize(80, 80);
        $avatar->save($avatar_path);
        unset($avatar);
      }
      $record->save(false); 
      return true;
    }
	}
}
