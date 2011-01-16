<div class="iform">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feedback-form',
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
  
	<table class='itable w100s'>
    <tbody>
      <tr>
        <th>
          <?php echo $form->labelEx($model,'email'); ?>
        </th>
        <td>
          <?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
  		    <?php echo $form->error($model,'email'); ?>
        </td>
      </tr>
      <tr>
    	  <th>
    		  <?php echo $form->labelEx($model,'homepage'); ?>
    		</th>
    		<td>
    		  <?php echo $form->textField($model,'homepage',array('size'=>45,'maxlength'=>45)); ?>
    		  <?php echo $form->error($model,'homepage'); ?>
    		</td>
    	</tr>
	    <tr>
      	<th>
      		<?php echo $form->labelEx($model,'question'); ?>
      	</th>
      	<td>
      	  <?php echo $form->textArea($model,'question',array('rows'=>6, 'cols'=>50)); ?>
      		<?php echo $form->error($model,'question'); ?>
      	</td>	
      </tr>
      <tr>
      	<th>
      		<?php echo $form->labelEx($model,'answer'); ?>
      	</th>
      	<td>
      		<?php echo $form->textField($model,'answer',array('size'=>45,'maxlength'=>45)); ?>
      		<?php echo $form->error($model,'answer'); ?>
      	</td>
      </tr>
      <tr>
        <th>	
      		<?php echo $form->labelEx($model,'itype'); ?>
      	</th>
      	<td>
      	  <?php echo $form->textField($model,'itype',array('size'=>45,'maxlength'=>45)); ?>
      		<?php echo $form->error($model,'itype'); ?>
      	</td>
      </tr> 
    </tbody>
  </table>
  
  <div class="taR h30P pr10P">
  	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'ibtn')); ?>
  </div>

<?php $this->endWidget(); ?>
<div class="ajax_overlay" ></div>
</div><!-- form -->