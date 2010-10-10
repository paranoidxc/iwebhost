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
	<tbody>
	<tr>
		<th class='alt '>Attachment</th>
		<td>
			<?php 
			if( $model->attachment ) {
				?>
				<div>
					<img src="/upfiles/s<?php echo $model->attachment->path?>" />
					<p><?php echo $model->attachment->screen_name?></p>
				</div>
			<?php
			}
			?>			
			<span class="pick" id="pick<?php echo time(); ?>" uri="<?php echo CController::createUrl('attachment/pick', array('return_id'=>'pick'.time() ) ); ?>" >Pick</span>
			<?php echo $form->textField($model,'attachment_id',array('size'=>60,'maxlength'=>255)); ?>
		</td>
	</tr>

	<tr>
		<th class='alt '>Gallery</th>
		<td>
			<?php 
			if( $model->gallery ) {
				?>
				<div>					
					<p><?php echo $model->gallery->id?>:<?php echo $model->gallery->name?></p>
				</div>
			<?php
			}
			?>

			<span class="pick" id="gallery_pick<?php echo time(); ?>" 
			uri="<?php echo CController::createUrl('category/pick', array('return_id'=>'gallery_pick'.time() ) ); ?>" >Gallery Pick</span>
			<?php echo $form->textField($model,'gallery_id',array('size'=>60,'maxlength'=>255)); ?>		
		</td>
	</tr>

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
		<th class='alt leftborder'><?php echo $form->labelEx($model,'content'); ?></th>
		<td>
			<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'content'); ?>
		</td>
	</tr>	

	<tr>
		<th class='alt leftborder'><?php echo $form->labelEx($model,'category_id'); ?></th>
		<td>
			<?php echo $form->hiddenField($model,'category_id'); ?>	
			Name:<?php echo $leaf->name ?>
			ID:<?php echo $leaf->id ?>
			<?php //echo $form->textField($model,'category_id'); ?>
			<?php //echo $form->listbox($model, 'category_id', $leafs, array( 'size' => 1)  ) ?>
			<?php //echo $form->error($model,'category_id'); ?>
		</td>
	</tr>

	<tr>
		<th class='leftborder alt'></th>
		<td>
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'button')); ?>
		</td>
	</tr>
	</tbody>
	</table>
<?php $this->endWidget(); ?>

</tr><!-- form -->