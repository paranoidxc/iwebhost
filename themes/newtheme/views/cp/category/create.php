<div id="m_middle">
  <table class='w100S'>
    <tr>
      <td class='w100S'>
<div id="w_con">
<div class="iform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,	
	'htmlOptions' => array(
		'class' => 'article_ajax_form'
	)
	)); ?>

	<?php echo $form->errorSummary($model); ?>	

	<p class="note"><?php echo Yii::t('cp','Fields with * are required.') ?></p>
  
  <table class='w100S'>
    <thead>
      <tr>
        <td colspan="2" class="pl8P" style="border: none">
  		      <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('cp','Create') : Yii::t('cp','Save'),
                array( 'class' => 'isubmit')); ?>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        
        <td class='vaT' style='width: 60%'>
          <table class='w100S'>
            <tr>
              <td class='pl10P'>
	              <?php echo $form->textArea($model,'memo',array('rows'=>20, 'cols'=>40, 'class' =>
                      'itext w100S')); ?>
                <?php echo $form->error($model,'memo'); ?>		
              </td>
            </tr>
          </table>
        </td>

        <td class='vaT' style='width:40%'>
          <table class='itable w100S'>
           <tr>
            <td class='pl10P'>
              <?php
              if( $model->parent_leaf->id != 1 ) {
              ?>
              <p class="tdU pick" id="gallery_pick<?php echo time(); ?>" 
                  uri="<?php echo url('/cp/rel/picknode', array('top_leaf_id' => $top_leaf->id,'return_id'=>'gallery_pick'.time() ) ); ?>" >
                  <?php echo Yii::t('cp','parent_leaf_id') ?>
              </p>
              <?php 
              }
              if( $model->parent_leaf ) {
              ?>
              <div class="origin_collect">
                <span><?php echo $model->parent_leaf->id?>:<?php echo $model->parent_leaf->name?></span>
                <span class="unlink_default_collect" origin_value="0" title="<?php echo Yii::t('cp','delete')?>">
                <?php echo $model->parent_leaf->id !=1 ? Yii::t('cp','delete') : '' ?></span>
                <span class="reset_default_collect dN" rel_id="<?php echo $model->parent_leaf_id?>" title="<?php echo Yii::t('cp','reset')?>">
                  <?php echo Yii::t('cp','reset')?>
                </span>  					
              </div>  				
              <?php
              }
              ?>
              <div class="dest_collect dN" >
                <span class="dest_collect_name"></span>
                <span class="unlink_collect" title="<?php echo Yii::t('cp','delete')?>"><?php echo Yii::t('cp','delete')?></span>
              </div>
              <p class="clear">  			  
                <?php echo
                $form->textField($model,'parent_leaf_id',array('size'=>60,'maxlength'=>255, 'class' => 'dN small' )); ?>		
              </p>
            </td>
          </tr>
     

          <tr>
              <td class='pl10P'>
          			<?php echo $form->labelEx($model,'parent_leaf_id'); ?>
            	  <span class="filter radius4"><?php echo $model->parent_leaf->id; ?></span>
          			<?php echo $model->parent_leaf->name; ?>
          			<?php echo $form->hiddenField($model,'parent_leaf_id') ?>	
              </td>
            </tr>

            <tr>
              <td class='pl10P'>
          		  <p><?php echo $form->labelEx($model,'name'); ?></p>
            		<p>
    		      	<?php echo
                $form->textField($model,'name',array('size'=>20,'maxlength'=>250,'class'=>'itext')); ?>
    			      <?php echo $form->error($model,'name'); ?>
    		        </p>
            	</td>
          	</tr>
      
            <tr>
              <td class='pl10P'>
                <p><?php echo $form->labelEx($model,'ident_label'); ?></p>
                <p>
                  <?php echo $form->textField($model,'ident_label',array('size'=>20,'maxlength'=>250,'class' => 'itext')); ?>
                  <?php echo $form->error($model,'ident_label'); ?>
                </p>
              </td>
            </tr>	
   
            <tr>
              <td class='pl10P'>
                <p>
                  <?php echo $form->labelEx($model,'partial'); ?>
                  <?php echo $form->checkbox($model,'partial'); ?>
                </p>
                <?php echo $form->error($model,'partial'); ?>
              </td>
            </tr>
          
            <tr>
              <td class='pl10P'>
                <p>				
                  <?php echo $form->labelEx($model,Yii::t('cp','album_tpl'), array('class' => 'normal' )); ?>
                  <?php echo $form->textField($model,'album_tpl', array('class' => 'itext w100P' )); ?>.php 
                </p>
                  <?php echo $form->error($model,'album_tpl'); ?>
          
                <p>				
                  <?php echo $form->labelEx($model,Yii::t('cp','list_tpl'), array('class' => 'normal' )); ?>
                  <?php echo $form->textField($model,'list_tpl', array('class' => 'itext w100P' )); ?>.php
                </p>
                  <?php echo $form->error($model,'list_tpl'); ?>
          
                <p>				
                  <?php echo $form->labelEx($model,Yii::t('cp','topic_tpl'), array('class' => 'normal' )); ?>
                  <?php echo $form->textField($model,'topic_tpl', array('class' => 'itext w100P' )); ?>.php
                </p>
                  <?php echo $form->error($model,'topic_tpl'); ?>
              </td>
            </tr>
          
            <tr class='dN'>
        		  <td class='pl10P dN'>
              <?php echo $form->labelEx($model,'content_type'); ?></th>
        			<?php echo $form->hiddenField($model,'content_type') ?>	
         			<?php 
    				    if ( isset( $model->content_types ) ) {
    					    echo $form->listbox($model, 'content_type', $model->content_types, array( 'size' => 1, 'class' => 'cct_pick' , 'id'=> 'cct'.time() )  ) ;
    				    }
    			    ?>
        			<div class="uri <?php echo $model->content_type==6 ? '' : 'dN'?>"  >
      			  <p>
      			    <?php echo $form->labelEx($model,'uri', array('class' => 'normal' )); ?> (http://www.google.com)<br/>
      			    <?php echo $form->textField($model,'uri'); ?>				
      			  </p>
        			</div>
              <div  class="oct <?php echo  $model->content_type==3 ? '' : 'dN'?>" >
                <p>
                  <span class="pick"
                        id = "<?php echo 'oct_pick'.time(); ?>" 
                        uri="<?php echo CController::createUrl('category/pick', array('return_id'=>'oct_pick'.time() ) ); ?>"			             
                  >Pick OutSide Category Topics</span>			    
                  <?php echo $form->textField($model,'oct_id',array('size'=>60,'maxlength'=>255, 'class' => 'small' )); ?>		
                </p>
              </div>
              <div class="ost <?php echo $model->content_type==5 ? '' : 'dN'?>" >			
                <p>
                  <span class="pick"
                        id = "<?php echo 'ost_pick'.time(); ?>" 
                        uri="<?php echo CController::createUrl('category/pick', array('return_id'=>'ost_pick'.time() ) ); ?>"			             
                  >Pick OutSide Single Topics</span>			    
                  <?php echo $form->textField($model,'ost_id',array('size'=>60,'maxlength'=>255, 'class' => 'small' )); ?>		
                </p>
              </div>
              
            </td>
          </tr>
 
 
          </table>
        </td>

      </tr>
    </tbody>
  </table>

	
  <div class="form_field_wrap field_normal">
  	<table class='itable'>
    	<tbody>
    	
   	</tbody>
    </table>
  </div>
  
<?php $this->endWidget(); ?>

</div><!-- form -->




    </div>
  </div>
</div>
