<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php
  echo "<div class='mac_panel_wrap ilogin_wrap' >";
  $this->beginWidget('application.extensions.Smacpanel');
?>  
<div class="icolor">
	<div class="login_column_nav column_nav">
  	<ul>
  		<li><a class="networks" href="#" data="#sign_in">Sign In</a></li>
  		<li><a href="#" class="about_me" data="#about_me">Me</a></li>  		
  	</ul>
  </div>
  
<div class="form login_column_main" id="sign_in">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('class' => 'itext') ); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class' => 'ipwd') ); ?>
		<?php echo $form->error($model,'password'); ?>		
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login', array('class'=>'ibtn') ); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<!-- about me start -->
	<div id="about_me" class="login_column_main">
		<h3><img src="/images/timvandamme.png" width="40" height="40" alt="About me"><strong>About Me</strong></h3>
  	<p>Single. Gemini. Born in 1985. Live in Fuzhou, China.</p>
	  <p>Paranoid is my nickname.</p>
	  <p>Enjoying colorful objects.</p>
  	<p>Never be evil. </p>								
	</div>
</div>
<?php
  $this->endWidget('application.extensions.Smacpanel');	  
  echo '</div>';
?>
