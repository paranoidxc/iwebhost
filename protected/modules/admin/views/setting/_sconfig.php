  
    <?php if(Yii::app()->user->hasFlash('fail')) {?>
    <div class="feedback">
      <?php echo Yii::app()->user->getFlash('fail'); ?>
    </div>
  <?php } ?>
  
  <?php $form=$this->beginWidget('CActiveForm', array(
        'action'  => CController::createUrl('setting/sconfig'),
        'htmlOptions' =>array( 'enctype' => 'multipart/form-data','class' => 'article_ajax_form')
        )
      ); 
    ?>
    
    <div class="row">
	  	<?php echo $form->labelEx($sconfig,'sitename'); ?>
		  <?php echo $form->textField($sconfig,'sitename', array('class' => 'itext') ); ?>
	  	<?php echo $form->error($sconfig,'sitename'); ?>
	  </div>
	
	  <div class="row">
	  	<?php echo $form->labelEx($sconfig,'description'); ?>
		  <?php echo $form->textField($sconfig,'description', array('class' => 'itext') ); ?>
	  	<?php echo $form->error($sconfig,'description'); ?>
	  </div>
	
	  <div class="row">
	  	<?php echo $form->labelEx($sconfig,'keyword'); ?>
		  <?php echo $form->textField($sconfig,'keyword', array('class' => 'itext') ); ?>
	  	<?php echo $form->error($sconfig,'keywords'); ?>
	  </div>
	  
	  <div class="row">
	  	<?php echo $form->labelEx($sconfig,'is_oops'); ?>
	  	<?php echo $form->checkbox($sconfig,'is_oops'); ?>		  
	  	<?php echo $form->error($sconfig,'is_oops'); ?>
	  </div>
	  <div class="row">
	  	<?php echo $form->labelEx($sconfig,'oops_tips'); ?>
		  <?php echo $form->textField($sconfig,'oops_tips', array('class' => 'itext') ); ?>
	  	<?php echo $form->error($sconfig,'oops_tips'); ?>
	  </div>
	  
    <div class="row buttons">
		  <?php echo CHtml::submitButton('Update', array('class'=>'ibtn') ); ?>
	  </div>
  <?php $this->endWidget(); ?>