<?php
  if( !$is_update ) {
  ?>
<div class='mac_panel_wrap w600p'>
<?php
echo $is_update;
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>'Edit '.$model->id.' - '.cnSubstr($model->screen_name,0,10)) )
?>
  <?php
  }
?>


<div class="iform">
  
	<?php if(Yii::app()->user->hasFlash('success')) {?>
    <div class="flash_suc">
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
  <?php } ?>
  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'atts_ajax_form'
	)
)); ?>
  <?php echo $form->errorSummary($model); ?>	

  <div class="ml20P pt10P">
	  <a data="field_normal" class="form_tab form_tab_selected"><span>Normal Field</span></a>
	  <a data="extra_link_wrap" class="form_tab"><span>Extra Link</span></a>
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
    	          echo str_replace(',','<br/>',$model->tips);
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
    	            width*height <span class="new_resize csP" >+</span>
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
    	      <?php echo $model->h ?>
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

	<div class="dN form_field_wrap extra_link_wrap">	  
	  <ul class="flL w200p ml20P bcBlue p5p">
	    <?php
	      $size_list = explode(',',$model->tips);
	      //print_r( Yii::app() );
	      foreach($size_list as $item){
	        if( strlen($item) > 0 ){
	          $item = str_replace('_','', $item);
  	        list($w,$h) = explode('*',$item);
  	        $link_outer =  Yii::app()->request->baseUrl.UPFILES_DIR.'/'.$model->path.'_'.$w.'_'.$h.'.'.$model->extension;
    	      $link_inner = UPFILES_DIR.'/'.$model->path.'_'.$w.'_'.$h.'.'.$model->extension;
  	        echo '<li class="csP extra_link_ele" link_outer="'.$link_outer.'"  link_inner="'.$link_inner.'">';
  	        echo $item;
  	        echo '</li>';
	        }
	      }
	    ?>
	  </ul>
	  <div>
	    <textarea class="extra_link_area_outer">link outer</textarea>
	    <textarea class="extra_link_area_inner">link inner</textarea>
	  </div>
	  <div class="clB"></div>
	</div>
	
  
  
  <div class="taR h30P pr10P">
  	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array( 'class' => 'ibtn')); ?>
  </div> 
  
  <?php $this->endWidget(); ?>
    <div class="ajax_overlay" />    
  </div>
  

  <?php
  if( !$is_update ) {
  ?>  
  <?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>
  <?php
  }
?>