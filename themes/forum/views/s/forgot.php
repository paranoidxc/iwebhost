<div class="iform radius5 boxshadow newest-node " >
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
)); ?>
  
  <h1 class='raidus5top panel-title' >
    <a href="/" ><?php echo Yii::app()->name ?></a>&raquo;&nbsp;forgot
  </h1>
  
  <div class='iline'></div>  
  <div class='p10P'>  
  	<p class="note"><?php echo Yii::t('cp','Fields with * are required.')?></p>
    
    <table class='itable iform_table_wrap w100S'>
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
    	    	<?php echo CHtml::submitButton('发送重置密码邮件', array('class'=>'ibtn blue') ); ?>
    		  </td>
    		</tr>  	  		
      </tfoot>
    </table>
  </div>   
<?php $this->endWidget(); ?>
</div>