<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'ajax_form'
	)
)); ?>
	<!-- <p class="note">Fields with <span class="required">*</span> are required.</p> -->
	<?php //echo $form->errorSummary($model); ?>
	<table class='itable'>
	
	<tr>
		<th class='alt leftborder'><?php echo $form->labelEx($model,'title'); ?></th>
		<td>
			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'title'); ?>
		</td>
	</tr>

	<tr>
		<th class='alt leftborder'><?php echo $form->labelEx($model,'subtitle'); ?></th>
		<td>
			<?php echo $form->textField($model,'subtitle',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'subtitle'); ?>
		</td>
	</tr>

	<tr>
		<th class='alt leftborder'><?php echo $form->labelEx($model,'desc'); ?></th>
		<td>
			<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'desc'); ?>
		</td>
	</tr>

	<tr>
		<th class='alt leftborder'><?php echo $form->labelEx($model,'content'); ?></th>
		<td>
			<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'content'); ?>
		</td>
	</tr>	

	<tr>
		<th class='alt leftborder'><?php echo $form->labelEx($model,'category_id'); ?></th>
		<td>
			<?php echo $form->textField($model,'category_id'); ?>
			<?php echo $form->listbox($model, 'category_id', $leafs, array( 'size' => 1)  ) ?>
			<?php echo $form->error($model,'category_id'); ?>
		</td>
	</tr>

	<tr>
		<th class='leftborder alt'></th>
		<td>
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</td>
	</tr>
	</table>
<?php $this->endWidget(); ?>

</tr><!-- form -->