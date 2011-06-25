<div class="iform">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'article_ajax_form'
	)
)); ?>

	<p class="note"><?php echo Yii::t('cp','Fields with * are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

  <table class='itable w100S'>
    <tbody>
      <tr>
        <th><?php echo $form->labelEx($model,'username'); ?></th>
        <td>
          <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>100,'class' => 'itext' )); ?>
          <?php echo $form->error($model,'username'); ?>
        </td>
      </tr>
      
      <tr>
        <th><?php echo $form->labelEx($model,'password'); ?></th>
        <td>
          <?php echo $form->textField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'itext ipwd'  )); ?>
          <?php echo $form->error($model,'password'); ?>
        </td>
      </tr>
      
      <tr>
        <th><?php echo $form->labelEx($model,'email'); ?></th>
        <td>
          <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class' => 'itext')); ?>
          <?php echo $form->error($model,'email'); ?>
        </td>
      </tr>
      
      <?php
        if( !$model->isNewRecord ){
      ?>
      <tr>
        <th><?php echo $form->labelEx($model,'c_time'); ?></th>
        <td>
          <?php echo $model->c_time ?>          
        </td>
      </tr>
      
      <tr>
        <th><?php echo $form->labelEx($model,'current_login_time'); ?></th>
        <td>
          <?php echo $model->current_login_time ?>          
        </td>
      </tr>
      
      <tr>
        <th><?php echo $form->labelEx($model,'current_ip'); ?></th>
        <td>
          <?php echo $model->current_ip ?>          
        </td>
      </tr>
      
      <tr>
        <th><?php echo $form->labelEx($model,'last_logout_time'); ?></th>
        <td>
          <?php echo $model->last_logout_time ?>          
        </td>
      </tr>
      
      <tr>
        <th><?php echo $form->labelEx($model,'last_ip'); ?></th>
        <td>
          <?php echo $model->last_ip ?>          
        </td>
      </tr>
 
      <tr>
        <th><?php echo Yii::t('cp', 'Login Count');?></th>
        <td>
          <span class="filter radius4"><?php echo $model->login_count ?></span>
          <?php echo Yii::t('cp', 'Times Login System')?>
        </td>
      </tr>

      <?php
        }
      ?>
      
    </tbody>
    <tfoot>
    <tr>
      <th> </th>
      <td>
      	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('cp','Create') : Yii::t('cp','Save'), array( 'class' => 'ibtn')); ?>
      </td>
    <tr>
    </tfoot>
  </table>
<?php $this->endWidget(); ?>
</div><!-- form -->
