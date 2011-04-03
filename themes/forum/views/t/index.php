<?php  
?>
<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp pt20P">       
        <a href="<?php echo url('m/index', array('id' => $inst->auther->username) )?> "
           class="radius2" title="<?php echo $inst->auther->username ?>" >
          <img src="<?php echo $inst->auther->gravatar ?>" alt="<?php echo $inst->auther->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow t_ar_arrow">&nbsp;</td>
      <td class="boxshadow ar_content_wrap newest-node">
        <div class="radius5top">
	        <h1 class="raidus5top panel-title">	          
	          <a href="/" class="radius2"><?php echo Yii::app()->name ?></a>
            <?php if($inst->allow_reply) {
              ?>
	            &raquo;&nbsp;
	            <a href="<?php echo CController::createUrl('f/index', array('id' => $inst->leaf->id) )?>"
	             class="radius2"><?php echo $inst->leaf->name ?></a>
              <?php
            }
            ?>
	          <?php if( !Yii::app()->user->isGuest && $inst->allow_reply ) {?>
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
            <strong>By <a href=" <?php echo url('m/index', array('id' => $inst->auther->username) )?>"
            class="radius2"><?php echo $inst->auther->username ?></a></strong>
            &nbsp;•&nbsp;          
            <span title="<?php echo $inst->create_time ?>" class="timeago" ><?php echo $inst->create_time ?></span>
            &nbsp;•&nbsp; 
            <?php echo $inst->pv ?>次点击 
            <?php if( $inst->allow_reply) {
              ?>
              &nbsp;•&nbsp; 
              <a href="#" class="radius2"><?php echo count($inst->posts); ?>次回复</a>
              <?php
            }?>
          </span>
          <div class="clB mt10P ar_content">
            <?php echo $inst->scontent ?>
          </div>
        <div>
	    </td>
    </tr>
    <?php if( $inst->reply_count ) {?>
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
      <table class=''>
          <tr>
            <th class='vaT p10P reply_gravatar'>
              <a href="<?php echo url('m/index', array('id' => $post->auther->username) )?> "
                title="<?php echo CHtml::encode($post->auther->username) ?>">
                <img width="40" src='<?php echo CHtml::encode($post->auther->gravatar) ?> ' 
                  alt='<?php echo CHtml::encode($post->auther->username) ?> ' />
              </a>
            </th>
            <td class='vaT pt10P'>
              <p class='ar_extra'>
                <strong>
                  <a href="<?php echo url('m/index', array( 'id' => $post->auther->username) ) ?>" 
                  class="radius2"><?php echo $post->auther->username?></a>
                </strong>      
                &nbsp;•&nbsp;         
                <span class='timeago' title='<?php echo CHtml::encode($post->c_time) ?>'>
                  <?php echo CHtml::encode($post->c_time) ?>
                </span>
              </p>
              <div class="clB ar_content pl5P">
                <?php echo $post->scontent ?>
              </div>
            </td>
          </tr>        
        </table>
        
        <div class='iline'></div>
      <?php
        }
      ?>
      </div>
      </td>
    </tr>    
<?php
  }
  if( !Yii::app()->user->isGuest && $inst->allow_reply ){
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
              		    
                  		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50,'class' => 'widgEditor')); ?>
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

