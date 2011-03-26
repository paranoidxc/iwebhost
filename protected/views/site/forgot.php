<div id="sign_in" class="iform w100S">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>
	<p class="note"><?php echo Yii::t('cp','Fields with * are required.')?></p>

  <table class='iform_table_wrap w100S'>
    <tbody>
  	  <tr>
  		  <th><?php echo $form->labelEx($model,'username'); ?></th>
  		  <td>
  		    <?php echo $form->textField($model,'username', array('class' => 'itext') ); ?>
		      <?php echo $form->error($model,'username'); ?>
  		  </td>
  		</tr>
  		
  		<tr>
  		  <th><?php echo $form->labelEx($model,'email'); ?></th>
  		  <td>
  		    <?php echo $form->textField($model,'email',array('class' => 'ipwd') ); ?>
		      <?php echo $form->error($model,'email'); ?>		
  		  </td>
  		</tr>  		
 		
    </tbody>
    <tfoot>    
      <tr>
  		  <th></th>
  		  <td>
  	    	<?php echo CHtml::submitButton('重新设置密码', array('class'=>'ibtn blue') ); ?>
  		  </td>
  		</tr>  	  		
    </tfoot>
  </table>


  <div class="taR h30P lh30P pr10P ">  
  	
  </div>   
<?php $this->endWidget(); ?>
</div>