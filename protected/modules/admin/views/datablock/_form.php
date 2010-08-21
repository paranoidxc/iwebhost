<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'datablock-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'ajax_form datablock_ajax_form','p_id' => $model->p_id,
		'parent_href' => CController::createurl('datablock/hnext', array('p_id' => $model->p_id) )
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'label'); ?>
		<?php echo $form->textField($model,'label',array('size'=>60,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'label'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'p_id'); ?>		
		<?php		
		if( $model->p_id != 0 ) {
			echo $model->parent->name;
		}else{
			echo 'Data-Block-Top';
		}
		?>
		<?php echo $form->listbox($model, 'p_id', $data_block_tree, array( 'size' => 1)  ) ; ?>
		<?php echo $form->error($model,'p_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>						
		<?php echo $form->listbox($model, 'category_id', $leafs, array( 'size' => 1)  ) ;?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'rel_value'); ?>
		<?php echo $form->textField($model,'rel_value',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'rel_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'template'); ?>
		<?php echo $form->textField($model,'template',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'template'); ?>
	</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->