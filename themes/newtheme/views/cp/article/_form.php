<div class="iform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'article_ajax_form'
	)
)); ?>	
  <p class="note"><?php echo Yii::t('cp','Fields with * are required.')?></p>
  <?php if(Yii::app()->user->hasFlash('success')) {?>
    <div class="flash_suc">
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
  <?php } ?>
	
	<?php echo $form->errorSummary($model); ?>		  
	
  <table class='itable w100S'>
    <tfoot>
      <tr>
       <th></th>
       <td>
  		      <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('cp','Create') : Yii::t('cp','Save'),
                array( 'class' => 'ibtn blue')); ?>
       </td>
     </tr>
    </tfoot>
  	<tbody>

  <!--内容字段 start-->
  <tr>
    <td colspan="2" class='pl10P'>
      <input type="hidden" class="widgEditor_id" value="#article_content<?php echo time()?>" /> 
  		<?php echo $form->textArea($model,'content',
          array('rows'=>40, 'cols'=>40, 'id'=>'article_content'.time(), 'class' => 'tinymce mceEditor' )); ?>
  		<?php echo $form->error($model,'content'); ?>		
    </td>
  </tr>

  	<tr>
  		<th>
  	  <span class='alt tdU pick'
  		    id="pick<?php echo time(); ?>"			        
  			  uri="<?php echo CController::createUrl('rel/pickatt', array('return_id'=>'pick'.time() ) ); ?>">
  			  <?php echo Yii::t('cp','Link Attachment') ?>
  	  </span>
  		</th>
  		<td>
  			<?php 
  			if( $model->attachment ) {
  				?>
  				<div class="orgin_thumbnail">
  					<img src="<?php echo $model->attachment->gavatar?>" title="<?php echo $model->attachment->screen_name?>" />  					
  					<span class="unlink_default" origin_value="0" title="<?php echo Yii::t('cp','delete')?>"><?php echo Yii::t('cp','delete')?></span>
  					<span class="reset_default dN" rel_id="<?php echo $model->attachment_id?>"  
  					  rel_path="/upfiles/g<?php echo $model->attachment->path?>" title="<?php echo Yii::t('cp','reset')?>">
  					  <?php echo Yii::t('cp','reset')?>
  					</span>
  				</div>  				
  			<?php
  			}
  			?>
  			
  			<div class="dest_thumbnail dN" >
  			  <img src="" alt="" />
  			  <span class="unlink_dest" title="删除">删除</span>
  			</div>
  			
  			<p class="clear">  			
  			  <?php echo $form->textField($model,'attachment_id',array( 'size'=>60,'maxlength'=>255, 'class' => 'dN small', 'origin_value' => 0 )); ?>
  			</p>
  			
  		</td>
  	</tr>
  
  	<tr>
  		<th class='alt'>  		  
  		  <span class="tdU pick" 
  			      id="gallery_pick<?php echo time(); ?>" 
  			      uri="<?php echo CController::createUrl('rel/picknode', array('return_id'=>'gallery_pick'.time() ) ); ?>" >
  			      <?php echo Yii::t('cp','Link Gallery') ?>
  			</span>
  		</th>
  		<td>
  			<?php 
  			if( $model->gallery ) {
  				?>
  				<div class="origin_collect">
  					<span><?php echo $model->gallery->id?>:<?php echo $model->gallery->name?></span>
  					<span class="unlink_default_collect" origin_value="0" title="<?php echo Yii::t('cp','delete')?>"><?php echo Yii::t('cp','delete')?></span>
  					<span class="reset_default_collect dN" rel_id="<?php echo $model->gallery_id?>" title="<?php echo Yii::t('cp','reset')?>">
  					  <?php echo Yii::t('cp','reset')?>
  					</span>  					
  				</div>  				
  			<?php
  			}
  			?>
  			
  			<div class="dest_collect dN" >
  			  <span class="dest_collect_name">555</span>
  			  <span class="unlink_collect" title="<?php echo Yii::t('cp','delete')?>"><?php echo Yii::t('cp','delete')?></span>
  			</div>
  			
  			<p class="clear">  			  
  			  <?php echo $form->textField($model,'gallery_id',array('size'=>60,'maxlength'=>255, 'class' => 'dN small' )); ?>		
  			</p>
  		</td>
  	</tr>
  
  	<tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'title'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100,'class'=>'itext')); ?>
  			<?php echo $form->error($model,'title'); ?>
  		</td>
  	</tr>
 
    <tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'ident_label'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'ident_label',
            array('size'=>60,'maxlength'=>100,'class' => 'itext')); ?>
  			<?php echo $form->error($model,'ident_label'); ?>
  		</td>
  	</tr>
  
  	<tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'link'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'link',
            array('size'=>60,'maxlength'=>255,'class' => 'itext' )); ?>
  			<?php echo $form->error($model,'link'); ?>
  		</td>
  	</tr>	
  
  	<tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'is_star'); ?></th>
  		<td>
  			<?php echo $form->checkbox($model,'is_star'); ?>
  			<?php echo $form->error($model,'is_star'); ?>
  		</td>
  	</tr>	
  	
  	<tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'tpl'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'tpl',
            array('size'=>60,'maxlength'=>255,'class' => 'itext' )); ?>
  			<?php echo $form->error($model,'tpl'); ?>
  		</td>
  	</tr>	
  	
  	<tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'pv'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'pv',
            array('size'=>60,'maxlength'=>255,'class' => 'itext' )); ?>
  			<?php echo $form->error($model,'pv'); ?>
  		</td>
  	</tr>	
  	
  	<tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'sort_id'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'sort_id',
            array('size'=>60,'maxlength'=>255,'class' => 'itext' )); ?>
  			<?php echo $form->error($model,'sort_id'); ?>
  		</td>
  	</tr>	
 
    <tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'user_id'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'user_id',
            array('size'=>60,'maxlength'=>255,'class' => 'itext' )); ?>
  			<?php echo $form->error($model,'user_id'); ?>
  		</td>
  	</tr>	
 
    <tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'allow_reply'); ?></th>
  		<td>
  			<?php echo $form->textField($model,'allow_reply',
            array('size'=>60,'maxlength'=>255,'class' => 'itext' )); ?>
  			<?php echo $form->error($model,'allow_reply'); ?>
  		</td>
  	</tr>	
  	
  	<tr>
  		<th class='alt leftborder'><?php echo $form->labelEx($model,'category_id'); ?></th>
  		<td>
  			<?php echo $form->hiddenField($model,'category_id'); ?>	  			
  			<span class="filter radius4"><?php echo $leaf->id ?></span>
  		  <?php echo $leaf->name ?>
  		</td>
  	</tr>
  	
  	</tbody>
  	</table>
  </div>
	
 
  <div class="dN form_field_wrap field_seo">
	  <table class='itable'>
  	  <tbody>
  	    <tr>
  	      <th class='alt leftborder'><?php echo $form->labelEx($model,'seo_keywords'); ?></th>
    		  <td>
    			  <?php echo $form->textField($model,'seo_keywords'); ?>
    		    <br/>
    			  <?php echo Yii::t('cp', 'At Most 3 Words,Words separate by comma(,)') ?>
    			  <?php echo $form->error($model,'seo_keywords'); ?>
    		  </td>
  	    </tr>
  	    <tr>
  	      <th class='alt leftborder'><?php echo $form->labelEx($model,'seo_description'); ?></th>
    		  <td>
    			  <?php echo $form->textArea($model,'seo_description', array('rows' => '10','cols'=> 100) ); ?>
    			  <br/>
    			  <?php echo Yii::t('cp', 'At Most 100 Words') ?>
    			  <?php echo $form->error($model,'seo_description'); ?>
    		  </td>
  	    </tr>
  	  </tbody>
 	</table>
		
<?php $this->endWidget(); ?>
</div>
<!-- form -->
