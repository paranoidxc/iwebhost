<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,	
	'htmlOptions' => array(
		'class' => 'ajax_form'
	)
	)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>	
	<?php echo $form->errorSummary($model); ?>		
	<table class='itable'>
	<tbody>
		<tr>
			<th><?php echo $form->labelEx($model,'parent_leaf_id'); ?>			
			</th>
			<td>
			id :<?php echo $model->parent_leaf->id; ?> - 
			name :<?php echo $model->parent_leaf->name; ?>
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
		<th><?php echo $form->labelEx($model,'ident_label'); ?></th>
		<td>
			<?php echo $form->textField($model,'ident_label',array('size'=>20,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'ident_label'); ?>
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
				<?php echo $form->textField($model,'album_tpl', array('class' => 'small' )); ?>.php
				<?php echo $form->labelEx($model,'album_tpl', array('class' => 'normal' )); ?>
				<?php echo $form->error($model,'album_tpl'); ?>
			</p>

			<p>				
				<?php echo $form->textField($model,'list_tpl', array('class' => 'small' )); ?>.php
				<?php echo $form->labelEx($model,'list_tpl', array('class' => 'normal' )); ?>
				<?php echo $form->error($model,'list_tpl'); ?>
			</p>

			<p>				
				<?php echo $form->textField($model,'topic_tpl', array('class' => 'small' )); ?>.php
				<?php echo $form->labelEx($model,'topic_tpl', array('class' => 'normal' )); ?>
				<?php echo $form->error($model,'topic_tpl'); ?>
			</p>
		</td>
	</tr>

	<tr>
		<th><?php echo $form->labelEx($model,'content_type'); ?></th>
		<td>			
			<?php echo $form->hiddenField($model,'content_type') ?>	
			<?php 
				if ( isset( $model->content_types ) ) {
					echo $form->listbox($model, 'content_type', $model->content_types, array( 'size' => 1, 'class' => 'cct_pick' , 'id'=> 'cct'.time() )  ) ;
				}
			?>
			<div class="uri <?php echo $model->content_type==6 ? '' : 'dN'?>"  >
			  <p>
			    <?php echo $form->labelEx($model,'uri', array('class' => 'normal' )); ?>		
			    <?php echo $form->textField($model,'uri'); ?>				
			  </p>
			</div>
							
			<div  class="oct <?php echo  $model->content_type==3 ? '' : 'dN'?>" >
			  <p>
			    <span class="pick"
			          id = "<?php echo 'oct_pick'.time(); ?>" 
			          uri="<?php echo CController::createUrl('category/pick', array('return_id'=>'oct_pick'.time() ) ); ?>"			             
			    >Pick OutSide Category Topics</span>			    
			    <?php echo $form->textField($model,'oct_id',array('size'=>60,'maxlength'=>255, 'class' => 'small' )); ?>		
			  </p>
			</div>
			
			<div class="ost <?php echo $model->content_type==5 ? '' : 'dN'?>" >			
			  <p>
			    <span class="pick"
			          id = "<?php echo 'ost_pick'.time(); ?>" 
			          uri="<?php echo CController::createUrl('category/pick', array('return_id'=>'ost_pick'.time() ) ); ?>"			             
			    >Pick OutSide Single Topics</span>			    
			    <?php echo $form->textField($model,'ost_id',array('size'=>60,'maxlength'=>255, 'class' => 'small' )); ?>		
			  </p>
			</div>
			
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