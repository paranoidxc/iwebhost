<div class="iform radius5 boxshadow newest-node " id="signup_wrap">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',	
)); ?>
  <h1 class='raidus5top panel-title' >
    <a href="/" class="radius2" ><?php echo Yii::app()->name ?></a>&raquo;&nbsp;
    <a href="<?php echo CController::createUrl('f/index', array('id' => $node->id ) )?>" class="radius2"><?php echo $node->name ?></a>&raquo;&nbsp;
    新主题
  </h1>
  
  <div class='iline'></div>  
  
  <div class="node-memo"><?php echo nl2br($node->memo) ?></div>
  
  <div class='p10P'>  
  	<h1 class="note"><?php echo Yii::t('cp','Fields with * are required.')?></h1>
    <span class='dN' id='member-photos-url' href='<?php echo url('m/photos') ?>' >相册图片</span>
    <table class='itable iform_table_wrap w100S'>
      <tbody>
        <tr>    		  
    		  <td>
    		    <?php echo $form->labelEx($model,'title'); ?>
    		    <?php echo $form->textField($model,'title', array('class' => 'itext') ); ?>
  		      <?php echo $form->error($model,'title'); ?>
    		  </td>
    		</tr>    		
    		<tr>    		  
    		  <td>    		      
            <div class='member-photos-pick '></div>
    		    <?php echo $form->textArea($model,'content',array('rows'=>50, 'cols'=>140, 'id'=>'article_content', 
                  'class' => 'widgEditor' )); ?>
            <p class='widg-extra'>
              <span id="widg_add_height" class='csP' data='200'>增高几行</span>
              <span id="widg_dec_height" class='csP' data='200'>降低几行</span>
            </p>
  		      <?php echo $form->error($model,'content'); ?>  		      
    		  </td>
    		</tr>
      </tbody>
      <tfoot>    
        <tr>    		  
    		  <td>
    	    	&nbsp;<?php echo CHtml::submitButton(Yii::t('cp','发布主题'), array('class'=>'ibtn blue') ); ?>
    		  </td>
    		</tr>  	  		
      </tfoot>
    </table>
  </div>
<?php $this->endWidget(); ?>
</div>
