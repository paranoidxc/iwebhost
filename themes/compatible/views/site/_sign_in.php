<style>
#sign_in {
  height: 1%;
  overflow: hidden;
  float: right;
  margin-top: 20px;
  background: #FFF;
  border: 1px solid #ccc;
  border-color: #CCC #666 #666 #CCC;
  padding: 2px;
  width: 242px;
}
#sign_in .sign_w {
  width: 200px;
  padding: 20px 30px 10px 20px;
  background: #FAF9F8;
}

#sign_in fieldset {
  margin-bottom: 10px;
}
#sign_in label {
  display: block;
  margin-bottom: 2px;
}
#sign_in label.irem {
  display: inline;
}
.errorMessage {
  font-size: 12px;
}
#sign_in .itext ,
#sign_in .ipwd {
  width: 200px;
}
#sign_in .itext.error ,
#sign_in .ipwd.error {
  border: 1px solid #C36;
  border-bottom: 1px solid #F6BAB2;
  border-right: 1px solid #F6BAB2;
}
</style>

<div id="sign_in" class="iform w100S">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>
  <div class='sign_w'>
    <fieldset>
      <?php echo $form->labelEx($model,'username'); ?>
      <?php echo $form->textField($model,'username', array('class' => 'itext') ); ?>
      <?php echo $form->error($model,'username'); ?>
    </fieldset>
    
    <fieldset>
      <?php echo $form->labelEx($model,'password'); ?>
      <?php echo $form->passwordField($model,'password',array('class' => 'ipwd') ); ?>
      <?php echo $form->error($model,'password'); ?>		
    </fieldset>
    
    <fieldset>
      <?php echo $form->checkBox($model,'rememberMe'); ?>
      <?php echo $form->label($model,'rememberMe', array('class' => 'irem' )); ?>
      <?php echo $form->error($model,'rememberMe'); ?>		
    </fieldset>

    <fieldset>
            <?php echo CHtml::submitButton(Yii::t('cp','Login'), array('class'=>'') ); ?>
    </fieldset>
  </div>
<?php $this->endWidget(); ?>
</div>
