<div class="iform ">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'article_ajax_form'
	)
)); ?>

	<p class="note"><?php echo Yii::t('cp','Fields with * are required.')?></p>

  <?php if(Yii::app()->user->hasFlash('success')) {?>
    <div class="flash_suc">
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
  <?php } ?>
  
	<?php echo $form->errorSummary($model); ?>

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
    </tbody>
  </table>
  
  <div class="taR h30P lh30P pr10P pt5P">
  	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('cp','Create') : Yii::t('cp','Save'), array( 'class' => 'ibtn blue bigrounded')); ?>
  </div>

<?php $this->endWidget(); ?>
</div><!-- form -->