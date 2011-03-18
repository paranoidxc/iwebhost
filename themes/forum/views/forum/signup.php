<div class="iform radius5 newest-node" id="signup_wrap">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'article_ajax_form'
		
	)
)); ?>  
  <h1>
    <a href="/" ><?php echo Yii::app()->name ?></a>&raquo;&nbsp;signup
  </h1>
  <div class='iline'></div>  
  
  <div class='p10P'>
  	<h1 class="note"><?php echo Yii::t('cp','Fields with * are required.')?></h1>	
    <?php if(Yii::app()->user->hasFlash('success')) {?>
      <div class="flash_suc">
        <?php echo Yii::app()->user->getFlash('success'); ?>
      </div>
    <?php } ?>
    
    <table class='itable w100S'>
      <tbody>
        <tr>
          <th><?php echo $form->labelEx($model,'username'); ?></th>
          <td>
            <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'username'); ?>
          </td>
        </tr>
        
        <tr>
          <th><?php echo $form->labelEx($model,'password'); ?></th>
          <td>
            <?php echo $form->textField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'password'); ?>
          </td>
        </tr>
        
        <tr>
          <th><?php echo $form->labelEx($model,'email'); ?></th>
          <td>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'email'); ?>
          </td>
        </tr>
  
        <tr>
          <th></th>
          <td>
            <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('cp','Create') : Yii::t('cp','Save'), array( 'class' => 'ibtn blue')); ?>
          </td>
        </tr>
        
      </tbody>
    </table>
  </div>
<?php $this->endWidget(); ?>
</div><!-- form -->