<div class="iform radius5 boxshadow newest-node " >
<?php $form=$this->beginWidget('CActiveForm', array(		
)); ?>
  
  <h1 class='raidus5top panel-title' >
    <a href="/" ><?php echo Yii::app()->name ?></a>&raquo;&nbsp;重置密码
  </h1>
  <div class="p10P">
  	<p class="note"><?php echo Yii::t('cp','Fields with * are required.')?></p>
    <?php echo $form->hiddenField($model,'token', array('class' => 'itext') ); ?>
    
    <table class='itable iform_table_wrap w100S'>
      <tbody>
    	  <tr>
    		  <th><?php echo $form->labelEx($model,'password'); ?></th>
    		  <td>
    		    <?php echo $form->passwordField($model,'password', array('class' => 'itext') ); ?>
  		      <?php echo $form->error($model,'password'); ?>
    		  </td>
    		</tr>
    		
    		<tr>
    		  <th><?php echo $form->labelEx($model,'rpassword'); ?></th>
    		  <td>
    		    <?php echo $form->passwordField($model,'rpassword',array('class' => 'itext') ); ?>
  		      <?php echo $form->error($model,'rpassword'); ?>		
    		  </td>
    		</tr>  		  		
      </tbody>
      <tfoot>    
        <tr>
    		  <th></th>
    		  <td>
    	    	<?php echo CHtml::submitButton('重置密码', array('class'=>'ibtn blue') ); ?>
    		  </td>
    		</tr>  	  		
      </tfoot>
    </table>
  </div>   
<?php $this->endWidget(); ?>
</div>