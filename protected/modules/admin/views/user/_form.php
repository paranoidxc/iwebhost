<div class="iform">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'article_ajax_form'
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

  <?php if(Yii::app()->user->hasFlash('success')) {?>
    <div class="feedback">
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
  <?php } ?>
  
	<?php echo $form->errorSummary($model); ?>

  <table class='itable'>
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
  
  <div class="taR h30P pr10P">
  	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'ibtn')); ?>
  </div>

<?php $this->endWidget(); ?>
<div class="ajax_overlay" ></div>
</div><!-- form -->