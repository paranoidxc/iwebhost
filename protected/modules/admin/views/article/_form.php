<div class="iform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'article_ajax_form'
	)
)); ?>	
  <p class="note">Fields with <span class="required">*</span> are required.</p>
  <?php if(Yii::app()->user->hasFlash('success')) {?>
    <div class="flash_suc">
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
  <?php } ?>
	
	<?php echo $form->errorSummary($model); ?>		  
	
	<div class="ml20P pt10P">
	  <a data="field_normal" class="form_tab form_tab_selected"><span>Normal Field</span></a>
	  <a data="field_content" class="form_tab"><span>Content Field</span></a>	  
	</div>	
	
	<div class="form_field_wrap field_normal">
  	<table class='itable'>
  	<tbody>
  	<tr>
  		<th>
  	  <span class='alt tdU pick'
  		    id="pick<?php echo time(); ?>"			        
  			  uri="<?php echo CController::createUrl('rel/pickatt', array('return_id'=>'pick'.time() ) ); ?>">
  			  Attachment
  	  </span>
  		</th>
  		<td>
  			<?php 
  			if( $model->attachment ) {
  				?>
  				<div class="orgin_thumbnail">
  					<img src="<?php echo $model->attachment->gavatar?>" title="<?php echo $model->attachment->screen_name?>" />  					
  					<span class="unlink_default" origin_value="0" title="删除">删除</span>
  					<span class="reset_default dN" rel_id="<?php echo $model->attachment_id?>"  rel_path="/upfiles/g<?php echo $model->attachment->path?>" title="撤销">撤销</span>
  				</div>  				
  			<?php
  			}
  			?>
  			
  			<div class="dest_thumbnail dN" >
  			  <img src="" alt="" />
  			  <span class="unlink_dest" title="删除">删除</span>
  			</div>
  			
  			<p class="clear">  			
  			  <?php echo $form->textField($model,'attachment_id',array( 'size'=>60,'maxlength'=>255, 'class' => 'dN small', 'origin_value' => 0 )); ?>
  			</p>
  			
  		</td>
  	</tr>
  
  	<tr>
  		<th class='alt'>  		  
  		  <span class="tdU pick" 
  			      id="gallery_pick<?php echo time(); ?>" 
  			      uri="<?php echo CController::createUrl('rel/picknode', array('return_id'=>'gallery_pick'.time() ) ); ?>" >Gallery
  			</span>
  		</th>
  		<td>
  			<?php 
  			if( $model->gallery ) {
  				?>
  				<div class="origin_collect">
  					<p><?php echo $model->gallery->id?>:<?php echo $model->gallery->name?></p>
  					<span class="unlink_default_collect" origin_value="0" title="删除">删除</span>
  					<span class="reset_default_collect dN" rel_id="<?php echo $model->gallery_id?>" title="撤销">撤销</span>  					
  				</div>  				
  			<?php
  			}
  			?>
  			
  			<div class="dest_collect dN" >
  			  <span class="dest_collect_name">555</span>
  			  <span class="unlink_collect" title="删除">删除</span>
  			</div>
  			
  			<p class="clear">  			  
  			  <?php echo $form->textField($model,'gallery_id',array('size'=>60,'maxlength'=>255, 'class' => 'dN small' )); ?>		
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
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'link'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
  			<?php echo $form->error($model,'link'); ?>
  		</td>
  	</tr>	
  
  	<tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'is_star'); ?></th>
  		<td>
  			<?php echo $form->checkbox($model,'is_star'); ?>
  			<?php echo $form->error($model,'is_star'); ?>
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
	    <span class="dN replace">insert " Foo " text </span>
	    <span class='alt tdU pick'
  		  id="link_pick<?php echo time(); ?>"
  		  rtype="article_link_image"
  			uri="<?php echo CController::createUrl('rel/pickatt', array('return_id'=>'link_pick'.time() ) ); ?>">
  			Link Images
  	  </span>
  	  
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
  		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'ibtn blue bigrounded')); ?>
  </div> 
<?php $this->endWidget(); ?>
  <div class="ajax_overlay" />
</div>

<!-- form -->
