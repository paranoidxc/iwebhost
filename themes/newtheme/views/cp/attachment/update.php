<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>
<div id="w_middle">
  <div id="w_left">
    <?php echo $this->renderPartial( '_left',array('leaf_tree' => $leaf_tree),false,true) ?>
  </div>

  <div id="w_right">
    <div></div>
  
    <div id="w_location"> 
      Console<?php echo API::rchart() ;?><a href="<?php echo url('cp/attachment/index') ?>" >Attachment</a><?php echo API::rchart();?>Index
    </div>

<?php if(Yii::app()->user->hasFlash('success')) {?>
    <div class="flash_suc">
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php } ?>
<?php if(Yii::app()->user->hasFlash('error')) {?>
    <div class="error">
      <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
 <?php } ?>

 
 
<div id="w_content">

  
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
  	<table class='itable w100S mt10P'>
    	<tbody>
    	  <tr>
          <th></th>
    	    <td colspan="">
    	      <img src='<?php echo $model->thumb ?>' class='flL image_border p2P' />
    	      <div class="flL w100p ml20P p5p zoom ofA h150p" >
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
    	      <div class="flL w200p ml20P  p5p">
    	        <ul>
    	          <li>
    	            <span class="new_resize csP" title="<?php echo Yii::t('cp','Add') ?>" > 新尺寸(宽*高) + </span>
    	          </li>        	      
    	          <li>
    	            <input type="text" size="4" name="resize_w[]"
                    class="image_resize_input itext w100P" autocomplete="off" /> *
    	            <input type="text" size="4" name="resize_h[]"
                    class="image_resize_input itext w100P" autocomplete="off" />
        	      </li>
    	        </ul>  	        
    	      </div>
    	    </td>  	    
    	  </tr>
    	  <tr>
    	    <th class='alt leftborder'><?php echo $form->labelEx($model,'memo'); ?></td>
    	    <td>
      	    <?php echo $form->textArea($model,'memo',
                array('rows'=>4, 'cols'=>20,'class' => 'itext' )); ?>
    	    </td>
    	  </tr>
    	  <tr>
  		    <th class='alt leftborder'><?php echo $form->labelEx($model,'screen_name'); ?></td>
      		<td>
      		  <?php echo $form->textField($model,'screen_name',
                array('size'=>60,'maxlength'=>100,'class' => 'itext' )); ?>
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
  		  
 	
        <tr>
          <th></th>
          <td>
            <ul class="w200P">
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
 
          </td>
        </tr>

        <tr>
          <th></th>
          <td>
  	        <textarea class="extra_link_area_outer itext"><?php echo Yii::t('cp','Outer Link') ?></textarea>
            <br/>
  	        <textarea class="extra_link_area_inner itext"><?php echo Yii::t('cp','Inter Link') ?></textarea>
          </td>
        </tr>
     	
      </tbody>

      <tfoot>
        <tr>
          <th></th>
          <td>
    	      <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('cp','Create') : Yii::t('cp','Save'), array( 'class' => 'ibtn blue')); ?>
          </td>
        </tr>
      </tfoot>
    </table>
	</div>
  	
    <?php $this->endWidget(); ?>
    </div>    
  </div>    
</div>
