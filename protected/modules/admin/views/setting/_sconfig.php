  
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
    
    <table class='itable w100s'>
      <tbody>
        <tr>
          <th>
            <?php echo $form->labelEx($sconfig,'sitename'); ?>
          </th>
          <td>
            <?php echo $form->textField($sconfig,'sitename', array('class' => 'itext') ); ?>
  	  	    <?php echo $form->error($sconfig,'sitename'); ?>
          </td>
        </tr>
        <tr>
    	  	<th><?php echo $form->labelEx($sconfig,'description'); ?></th>
    		  <td>
    		    <?php echo $form->textArea($sconfig,'description',array('rows'=>20, 'cols'=>100)); ?>
    	  	  <?php echo $form->error($sconfig,'description'); ?>
    	  	</td>
    	  </tr>
    	  
    	  <tr>
    	  	<th><?php echo $form->labelEx($sconfig,'keyword'); ?></th>
    		  <td>    		    
    		    <?php echo $form->textArea($sconfig,'keyword',array('rows'=>20, 'cols'=>100)); ?>
    	  	  <?php echo $form->error($sconfig,'keywords'); ?>
    	  	</td>
    	  </tr>
    	  
    	  <tr>
	  	    <th><?php echo $form->labelEx($sconfig,'is_oops'); ?></th>
	  	    <td>
	  	      <?php echo $form->checkbox($sconfig,'is_oops'); ?>
	  	      <?php echo $form->error($sconfig,'is_oops'); ?>
	        </td>
	      </tr>
	      
	      <tr>
	        <th><?php echo $form->labelEx($sconfig,'oops_tips'); ?></th>
	        <td>
	          <?php echo $form->textArea($sconfig,'oops_tips',array('rows'=>20, 'cols'=>100)); ?>
    	  	  <?php echo $form->error($sconfig,'oops_tips'); ?>
    	  	</td>
	      </tr>	  
      </tbody>
    </table>
    <div class="taR h30P pr10P">
		  <?php echo CHtml::submitButton('Save', array('class'=>'ibtn') ); ?>
	  </div>
  <?php $this->endWidget(); ?>