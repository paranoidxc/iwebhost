<?php  
?>
<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp pt20P">
        <a href="#" class="radius2" title="<?php echo $inst->author->username ?>" >
          <img src="/default_image/<?php echo $inst->author->gravatar ?>" alt="<?php echo $inst->author->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow t_ar_arrow">&nbsp;</td>
      <td class="boxshadow ar_content_wrap newest-node">
        <div class="radius5top">
	        <h1 class="raidus5top panel-title">	          
	          <a href="/" class="radius2"><?php echo Yii::app()->name ?></a>
	          &raquo;&nbsp;
	          <a href="<?php echo CController::createUrl('f/index', array('id' => $inst->leaf->id) )?>"
	             class="radius2"><?php echo $inst->leaf->name ?></a>
	          <?php if( !Yii::app()->user->isGuest ) {?>
	          <a href="<?php echo CController::createUrl('t/create', array('f'=> $inst->leaf->id ) ) ?>"
	            class='flR radius2 new-ar'>新主题</a>
  	        <?php }?>
	        </h1>
	      </div>
        <div class='iline'></div>        
	      
	      <div class='p10P' >
  		    <span class="fs16P lh130S ar_title" >
  		      <?php echo CHtml::encode($inst->title) ?>
  		    </span>
          <div class="clB h2P"></div>
          <span class="ar_extra">
            <strong>By <a href="#" class="radius2"><?php echo $inst->author->username ?></a></strong>
            &nbsp;•&nbsp;          
            <span title="<?php echo $inst->create_time ?>" class="timeago" ><?php echo $inst->create_time ?></span>
            &nbsp;•&nbsp; 
            <?php echo $inst->pv ?>次点击 
            &nbsp;•&nbsp; 
            <a href="#" class="radius2"><?php echo count($inst->posts); ?>次回复</a>
          </span>
          <div class="clB mt10P ar_content">
            <?php echo $inst->scontent ?>
          </div>
        <div>
	    </td>
    </tr>  
    
     <tr>
      <td></td>
      <td></td>
      <td>
      <div class="radius5 mt20P boxshadow newest-node reply_wrap">
        <div class="raidus5top panel-title">
  	      <h1 class="raidus5top"><?php echo count($inst->posts)?> 回复</h1>
  	    </div>
      <?php
        foreach( $inst->posts as $post ){
      ?>   
        <div class="p10P">
          <p>            
            <img width="32" src='/default_image/<?php echo CHtml::encode($post->auther->gravatar) ?> ' alt='<?php echo CHtml::encode($post->auther->username) ?> ' />
            <?php echo CHtml::encode($post->auther->username) ?> 
            <span class='timeago' title='<?php echo CHtml::encode($post->c_time) ?>'><?php echo CHtml::encode($post->c_time) ?></span>
          </p>
          <?php echo CHtml::encode($post->content) ?>
        </div>      
        <div class='iline'></div>
      <?php
        }
      ?>
      </div>
      </td>
    </tr>
<?php
  if( !Yii::app()->user->isGuest ){
?>      
    <tr>
      <td></td>
      <td></td>
      <td >  
        <div class="radius5 mt20P boxshadow newest-node reply_wrap">
          <div class="raidus5top panel-title">
  	        <h1 class="raidus5top">添加你的回复</h1>
  	      </div>
    	    <div class='iline'></div>  	    
    	    <div class='p10P'>
      	    <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'post-form',	
            	'action' => array('t/reply')
            )); ?>	
              <table class='itable iform_table_wrap w100S'>
                <tbody>
                  <tr>    		  
              		  <td>                  	  
                  		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
                  		<?php echo $form->error($model,'content'); ?>
              		  </td>
              		</tr>   
              	<tfoot>    
                  <tr>    		  
              		  <td>    		    
              	    	<?php echo CHtml::submitButton(Yii::t('cp','Create'), array('class'=>'ibtn blue') ); ?>
              		  </td>
              		</tr>  	  		
                </tfoot> 		
              </table>
          	  <?php echo $form->hiddenField($model,'article_id'); ?>
            <?php $this->endWidget(); ?>
    	    </div>
    	  </div>
      </td>
    </tr> 
    
<?php
  }
?>
  </table>
</div>

