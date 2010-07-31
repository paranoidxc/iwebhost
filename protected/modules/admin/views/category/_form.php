<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,	
	'htmlOptions' => array(
		'class' => 'ajax_form'
	)
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	insert into category (name,lft,rgt,create_time) values ( 'ROOT', 1,2, now() );
	<?php echo $form->errorSummary($model); ?>	
	
	<div class="row">
		<?php echo $form->labelEx($model,'parent_leaf_id'); ?>
		parent_leaf_name :<?php echo $model->parent_leaf->name; ?><br/>
		parent_leaf_id :<?php echo $model->parent_leaf_id ?>
		<?php echo $form->hiddenField($model,'parent_leaf_id') ?>		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'ibtn')); ?>
	</div>		

<?php $this->endWidget(); ?>

</div><!-- form -->