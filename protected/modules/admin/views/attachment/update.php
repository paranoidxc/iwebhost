<?php
  if( !$is_update ) {
?>
<div class='mac_panel_wrap w600P'>
<?php  
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=> Yii::t('cp','Edit').' <span class="filter radius4">'.$model->id.'</span> '.cnSubstr($model->screen_name,0,10)) );
  }
?>
  <div class='iform'>
  	<?php if(Yii::app()->user->hasFlash('success')) {?>
      <div class="flash_suc">
        <?php echo Yii::app()->user->getFlash('success'); ?>
      </div>
    <?php } ?>
  
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'article-form',
    	'enableAjaxValidation'=>false,
    	'htmlOptions' => array(
    		'class' => 'article_ajax_form'
    	)
    )); ?>
    
    <?php echo $form->errorSummary($model); ?>	
  
    <div class="ml20P pt10P">
  	  <a data="field_normal" class="form_tab form_tab_selected">
  	    <span><?php echo Yii::t('cp','Normal Field')?></span>
  	  </a>
  	  <a data="extra_link_wrap" class="form_tab">
  	    <span><?php echo Yii::t('cp','Extra Link')?></span>
  	  </a>
  	</div>
  	
  	<div class="form_field_wrap field_normal">
  	<table class='itable'>
    	<tbody>
    	  <tr>
    	    <td colspan="2">  	      
    	      <img src='<?php echo $model->thumb ?>' class='flL image_border' />
    	      <div class="flL w100p ml20P bcBlue p5p zoom ofA h150p" >
    	        <ul>
    	        <?php
    	          //echo str_replace(',','<br/>',$model->tips);
    	          $tips = explode(',',$model->tips);
    	          foreach( $tips as $tip ){
    	            echo '<li>';
    	            echo $tip;
    	            echo '</li>';
    	          }
    	        ?>
    	        </ul>
    	      </div>  	      
    	      <div class="flL w200p ml20P bcBlue p5p">
    	        <ul>
    	          <li>
    	            <?php echo Yii::t('cp','Width') ?>*<?php echo Yii::t('cp','Height')?>    	            
    	            <span class="new_resize csP" title="<?php echo Yii::t('cp','Add') ?>" >+</span>
    	          </li>        	      
    	          <li>
    	            <input type="text" size="4" name="resize_w[]" class="image_resize_input" autocomplete="off" />
    	            *
    	            <input type="text" size="4" name="resize_h[]" class="image_resize_input" autocomplete="off" />
        	      </li>
    	        </ul>  	        
    	      </div>
    	    </td>  	    
    	  </tr>
    	  <tr>
    	    <th class='alt leftborder'><?php echo $form->labelEx($model,'memo'); ?></td>
    	    <td>
      	    <?php echo $form->textArea($model,'memo',array('rows'=>4, 'cols'=>20)); ?>
    	    </td>
    	  </tr>
    	  <tr>
  		    <th class='alt leftborder'><?php echo $form->labelEx($model,'screen_name'); ?></td>
      		<td>
      		  <?php echo $form->textField($model,'screen_name',array('size'=>60,'maxlength'=>100)); ?>
      		  <?php echo $form->error($model,'screen_name'); ?>
      		</td>
  	    </tr>
  	
    	  <tr>
    	    <th class='alt leftborder'><?php echo $form->labelEx($model,'w'); ?></td>
    	    <td>
    	      <?php echo $model->w ?>
    	      <?php //echo $form->textField($model,'w',array('size'=>60,'maxlength'=>100)); ?>
    	      <?php //echo $form->error($model,'w'); ?>
    	    </td>
    	  </tr>
    	  
    	  <tr>
    	    <th><?php echo $form->labelEx($model,'h'); ?></th>
  		    <td>
  		      <?php echo $model->h ?>
  		      <?php //echo $form->textField($model,'h',array('size'=>60,'maxlength'=>100)); ?>
  		      <?php //echo $form->error($model,'h'); ?>
  		    </td>
  		  </tr>
  		  
    	</tbody>
    </table>
	</div>
  	
    
  	
  	
  	<!-- extra_link_wrap -->
    <div class="dN form_field_wrap extra_link_wrap">
      <ul class="w200P ml20P bcBlue p5P">
  	    <?php
  	      $size_list = explode(',',$model->tips);	      
  	      foreach($size_list as $item){
  	        if( strlen($item) > 0 ){
  	          $item = str_replace('_','', $item);
    	        list($w,$h) = explode('*',$item);
    	        $link_outer =  Yii::app()->request->baseUrl.UPFILES_DIR.'/'.$model->path.'_'.$w.'_'.$h.'.'.$model->extension;
      	      $link_inner = UPFILES_DIR.'/'.$model->path.'_'.$w.'_'.$h.'.'.$model->extension;
      	      echo '<li class="csP extra_link_ele" link_outer="'.$link_outer.'" link_inner="'.$link_inner.'">';
      	      echo $item;
      	      echo '</li>';
  	        }
  	      }
  	    ?>
  	  </ul>
  	  
  	  <div>
  	    <textarea class="extra_link_area_outer"><?php echo Yii::t('cp','Outer Link') ?></textarea>
  	    <textarea class="extra_link_area_inner"><?php echo Yii::t('cp','Inter Link') ?></textarea>
  	  </div>
      <div class="clB"></div>
    </div><!--extra_link_wrap end-->
  	
    <div class="taR h30P lh30P pr10P pt5P">
    	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('cp','Create') : Yii::t('cp','Save'), array( 'class' => 'ibtn blue')); ?>
    </div>
    <?php $this->endWidget(); ?>
  </div>  
<?php
  if( !$is_update ) {
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
<div class="ajax_overlay" ></div>
</div>
  <?php
  }
?>