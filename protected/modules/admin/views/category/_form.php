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
			
			parent_leaf_id :<?php echo $model->parent_leaf_id ?> 
			parent_leaf_name :<?php echo $model->parent_leaf->name; ?>
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
			<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'name'); ?>
		</td>
	</tr>
	
	<tr>
		<th><?php echo $form->labelEx($model,'template'); ?></th>
		<td>
			<?php echo $form->textField($model,'template',array('size'=>60,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'template'); ?>
		</td>
	</tr>
	<tr>
	  <th><?php echo $form->labelEx($model,'memo'); ?></th>
	  <td><?php echo $form->textArea($model,'memo',array('rows'=>6, 'cols'=>50)); ?></td>
	</tr>
	
	<tr>
		<th><?php echo $form->labelEx($model,'partial'); ?></th>
		<td>
			<?php echo $form->checkbox($model,'partial'); ?>
			<?php echo $form->error($model,'partial'); ?>
		</td>
	</tr>

	<tr>
		<th>Tpl</th>
		<td>
			<p>				
				<?php echo $form->textField($model,'home_tpl', array('class' => 'small' )); ?>.php
				<?php echo $form->labelEx($model,'home_tpl', array('class' => 'normal' )); ?>
				<?php echo $form->error($model,'home_tpl'); ?>
			</p>

			<p>				
				<?php echo $form->textField($model,'list_tpl', array('class' => 'small' )); ?>.php
				<?php echo $form->labelEx($model,'list_tpl', array('class' => 'normal' )); ?>
				<?php echo $form->error($model,'list_tpl'); ?>
			</p>

			<p>				
				<?php echo $form->textField($model,'single_tpl', array('class' => 'small' )); ?>.php
				<?php echo $form->labelEx($model,'single_tpl', array('class' => 'normal' )); ?>
				<?php echo $form->error($model,'single_tpl'); ?>
			</p>
		</td>
	</tr>

	<tr>
		<th><?php echo $form->labelEx($model,'content_type'); ?></th>
		<td>			
			<?php echo $form->hiddenField($model,'parent_leaf_id') ?>	
			<?php 
				if ( isset( $model->content_types ) ) {
					echo $form->listbox($model, 'parent_leaf_id', $model->content_types, array( 'size' => 1)  ) ;
				}
			?>				
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