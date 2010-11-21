<div class="iform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
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
	
	<div class="form_field_wrap field_normal">
  	<table class='itable'>
  	<tbody>
  	<tr>
  		<th class='alt tdU pick'
  		    id="pick<?php echo time(); ?>"			        
  			  uri="<?php echo CController::createUrl('rel/pickatt', array('return_id'=>'pick'.time() ) ); ?>">Attachment</th>
  		<td>
  			<?php 
  			if( $model->attachment ) {
  				?>
  				<div class="orgin_thumbnail">
  					<img src="/upfiles/t<?php echo $model->attachment->path?>" />
  					<p><?php echo $model->attachment->screen_name?></p>
  				</div>
  				<span class="exchange_symbol"> >> </span>
  			<?php
  			}
  			?>
  			
  			<p class="clear">
  			<!--  <span class="pick"
  			        id="pick<?php echo time(); ?>"			        
  			        uri="<?php echo CController::createUrl('rel/pickatt', array('return_id'=>'pick'.time() ) ); ?>" >Pick
  			  </span>
  			  -->
  			  <?php echo $form->textField($model,'attachment_id',array('size'=>60,'maxlength'=>255, 'class' => 'small' )); ?>
  			</p>
  			
  		</td>
  	</tr>
  
  	<tr>
  		<th class='alt '>Gallery</th>
  		<td>
  			<?php 
  			if( $model->gallery ) {
  				?>
  				<div class="origin_gallery">
  					<p><?php echo $model->gallery->id?>:<?php echo $model->gallery->name?></p>
  				</div>
  				<span class="exchange_symbol"> >> </span>
  			<?php
  			}
  			?>
  			<p class="clear">
  			  <span class="pick" 
  			        id="gallery_pick<?php echo time(); ?>" 
  			        uri="<?php echo CController::createUrl('rel/picknode', array('return_id'=>'gallery_pick'.time() ) ); ?>" >Gallery Pick
  			  </span>
  			  <?php echo $form->textField($model,'gallery_id',array('size'=>60,'maxlength'=>255, 'class' => 'small' )); ?>		
  			</p>
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
  	</tbody>
  	</table>
  </div>
	
	<div class="dN form_field_wrap field_content">  
	  <div style="margin-bottom: 5px">
	    <span data="write" class="inner_tab inner_tab_selected" > Write </span>
	    <span data="preview" class="inner_tab" url=<?php echo CController::createUrl('article/preview') ?> > Preview </span>
	  </div>
	  
	  <div class="inner_wrap write">
  		<?php //echo $form->labelEx($model,'content'); ?>
  		<?php echo $form->textArea($model,'content',array('rows'=>20, 'cols'=>100)); ?>
  		<?php //echo $form->error($model,'content'); ?>		
		</div>
		
		<div class="dN inner_wrap preview">
		  preview
  	</div>
  </div>
  
  <div class="taR h30P pr10P">
  		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'ibtn')); ?>
  </div> 
<?php $this->endWidget(); ?>
  <div class="ajax_overlay" />
</div>

<!-- form -->
