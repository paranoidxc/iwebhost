<div class="iform radius5 boxshadow newest-node " id="signup_wrap">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>
  <h1 class='raidus5top panel-title' >
    <a href="/" ><?php echo Yii::app()->name ?></a>&raquo;&nbsp;signin
  </h1>
  
  <div class='iline'></div>  
  
  <div class='p10P'> 
    
    <?php if(Yii::app()->user->hasFlash('success')) {?>
      <div class="note mb10P">
        <?php echo Yii::app()->user->getFlash('success'); ?>
      </div>
    <?php } ?>
   
  	<h1 class="note"><?php echo Yii::t('cp','Fields with * are required.')?></h1>
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
    		  <th><?php echo $form->labelEx($model,'password'); ?></th>
    		  <td>
    		    <?php echo $form->passwordField($model,'password',array('class' => 'itext') ); ?>
  		      <?php echo $form->error($model,'password'); ?>		
    		  </td>
    		</tr>  		
    		<tr class='dN'>
    		  <th><?php echo $form->checkBox($model,'rememberMe'); ?></th>
    		  <td>
    	    	<?php echo $form->label($model,'rememberMe'); ?>
  		      <?php echo $form->error($model,'rememberMe'); ?>		
    		  </td>
    		</tr>  		
    		
    		<tr class=''>
    		  <th></th>
    		  <td>
    	    	<a href="<?php echo CController::createUrl('s/forgot') ?>">哎呀,忘记密码了?</a>  		      
    		  </td>
    		</tr>  	
    		
      </tbody>
      <tfoot>    
        <tr>
    		  <th></th>
    		  <td>
    	    	<?php echo CHtml::submitButton(Yii::t('cp','Login'), array('class'=>'ibtn blue') ); ?>
    		  </td>
    		</tr>  	  		
      </tfoot>
    </table>
  </div>   
<?php $this->endWidget(); ?>
</div>