<div class="iform">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,	
	'htmlOptions' => array(
		'class' => 'article_ajax_form'
	)
	)); ?>
	
	<div class="feedback">
	</div>
		
	<?php echo $form->errorSummary($model); ?>	
	
	<div class="ml20P pt10P">
	  <a data="field_normal" class="form_tab form_tab_selected"><span>Normal Field</span></a>
	  <a data="field_content" class="form_tab"><span>Content Field</span></a>
	</div>
	
	
	<div class="dN form_field_wrap field_content">  

	  <div style="margin-bottom: 5px">
	    <span data="write" class="inner_tab inner_tab_selected" > Write </span>
	    <span data="preview" class="inner_tab" url=<?php echo CController::createUrl('article/preview') ?> > Preview </span>
	  </div>
	  
	  <div class="inner_wrap write">
  		<?php echo $form->textArea($model,'memo',array('rows'=>20, 'cols'=>100)); ?>
		</div>
		
		<div class="dN inner_wrap preview">
		  preview
  	</div>
  </div>
  
  
  
	<div class="form_field_wrap field_normal">
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
    	<?php
    	if( $model_type != 'attachment') {
    	?>
    	
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
      <?php
    	}
    	?>
    	
    	<?php
    	  if( $model_type != 'attachment') {
    	?>
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
      <?php
      }
      ?>
    	</tbody>
    </table>
  </div>
  
 
	<div class="taR h30P pr10P">
  		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'ibtn')); ?>
  </div> 
  
<?php $this->endWidget(); ?>
<div class="ajax_overlay" />

</div><!-- form -->