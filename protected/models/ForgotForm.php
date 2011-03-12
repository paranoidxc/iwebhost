<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ForgotForm extends CFormModel
{
	public $username;
	public $email;
	

	

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, email', 'required'),
			// rememberMe needs to be a boolean
			
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
  		'username'  => Yii::t('cp','Username'),
  		'email'     => Yii::t('cp','Email'),		  
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function send_reset_pwd_mail($user)
	{
    error_reporting(E_ALL);
    //error_reporting(E_STRICT);    
    date_default_timezone_set('America/Toronto');
    //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded    
    $mail             = new PHPMailer();    
    $body             = "    Hi $user->username:\n";
    $body .="请点击下面的链接重新设置你的密码\n";
    $body .="http://www.v2ex.com/reset/$user->token";
    $body             = eregi_replace("[\]",'',$body);    
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->Host       = "mail.gmail.com"; // SMTP server
    $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "emohuang@gmail.com";  // GMAIL username
    $mail->Password   = "tianshixc";            // GMAIL password
    
    $mail->SetFrom('emohuang@gmail.com', 'ihost');
    
    $mail->AddReplyTo("49421240@qq.com","First Last");
    
    $mail->Subject    = "ihost 重新重置密码 ";
    
    //$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    
    $mail->MsgHTML($body);
    
    $address = "49421240@qq.com";
    $mail->AddAddress($address, $user->username);
    
    if(!$mail->Send()) {
      //echo "Mailer Error: " . $mail->ErrorInfo;
      return false;
    } else {
      return true;
      //echo "Message sent!";
    }
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function forgot()
	{	  
	  
		$record = User::model()->findByAttributes( array('username'=> $this->username, 'email' => $this->email ) );
		if( $record == null ) {
		  $this->addError('username',Yii::t('cp','Incorrect username or email.' ));
		  return false;
		}else{		  		  
		  $record->token = md5( sha1($record->id).time() );
		  if( $record->save() ){
		    if( $this->send_reset_pwd_mail( $record ) ){
		      return true;
		    }else{
		      $this->addError('username','邮件服务器开小差了,请稍后再试.');
		      return false;
		    }
		  }
		  return true;
		}
	}
}
