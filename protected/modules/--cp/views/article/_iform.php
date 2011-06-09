<div class="iform">  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'ajax_form'
	)
)); ?>
	
  <div style="margin-left: 20px">
	  <a data="field_normal" class="form_tab form_tab_selected"><span>Normal Field</span></a>
	  <a data="field_content" class="form_tab"><span>Content Field</span></a>
	</div>
	
	
	<div class="form_field_wrap field_normal">
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
	
</div>