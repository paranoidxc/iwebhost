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
	
	<table class='itable'>
	<tbody>
		<tr>
			<th><?php echo $form->labelEx($model,'parent_leaf_id'); ?>			
			</th>
			<td>
				parent_leaf_name :<?php echo $model->parent_leaf->name; ?><br/>
			parent_leaf_id :<?php echo $model->parent_leaf_id ?><br/>
			<?php echo $form->hiddenField($model,'parent_leaf_id') ?>	
			<?php 
				if ( isset( $leafs ) ) {
					echo $form->listbox($model, 'parent_leaf_id', $leafs, array( 'size' => 1)  ) ;
				}
			?>			
			</td>
	</tr>
	
	<tr>
		<th><?php echo $form->labelEx($model,'name'); ?></th>
		<td>
			<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'name'); ?>
		</td>
	</tr>
	
	<tr>
		<th><?php echo $form->labelEx($model,'template'); ?></th>
		<td>
			<?php echo $form->textField($model,'template',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'template'); ?>
		</td>
	</tr>
	
		<tr>
		<th><?php echo $form->labelEx($model,'partial'); ?></th>
		<td>
			<?php echo $form->checkbox($model,'partial'); ?>
			<?php echo $form->error($model,'partial'); ?>
		</td>
	</tr>

	<tr>
		<th></th>
		<td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'ibtn')); ?></td>
	</tr>		
	</tbody>
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->