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
	            <a href="<?php echo url('f/index', array('id' => $inst->leaf->id) )?>"
	             class="radius2"><?php echo $inst->leaf->name ?></a>
              <?php
            }
            ?>
	          <?php if( !Yii::app()->user->isGuest && $inst->allow_reply ) {?>
	          <a href="<?php echo url('t/create', array('f'=> $inst->leaf->id ) ) ?>"
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
              <?php echo count($inst->posts); ?>次回复
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
      <div class="radius5 mt20P boxshadow block_wrap reply_wrap">
        <div class="raidus5top panel-title">
  	      <h1 class="raidus5top">
            <span> <?php echo count($posts)?> 回复 </span>
            <?php if($_GET['s'] ) {?>
              <a href="<?php echo url('t/index', array('id' => $inst->id ) ) ?> " class="flR radius2" >显示全部</a>
            <?php }else{ ?>
              <a href="<?php echo url('t/index', array('id' => $inst->id,'s'=>'1' ) ) ?> " class="flR radius2" >只看楼主</a>
            <?php } ?>
          </h1>
  	    </div>
        <div class='iline'></div>
        
        <!--topic reply start -->
        <?php $this->renderPartial('_posts', array('posts' => $posts ) ) ?>
        <!--topic reply end -->

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
              <span class='dN' id='member-photos-url' href='<?php echo url('m/photos') ?>' >相册图片</span>
              <table class='itable iform_table_wrap w100S'>
                <tbody>
                  <tr>    		  
              		  <td>                  	  
                      <div class='member-photos-pick '></div>
                  		<?php echo $form->textArea($model,'content',array('rows'=>6,
                            'cols'=>50,'class' => 'widgEditor', 'id' => 'id_widgEditor')); ?>
                      <p class='widg-extra'>     
                        <span id="widg_add_height" class='csP' data='200'>增高几行</span>
                        <span id="widg_dec_height" class='csP' data='200'>降低几行</span>
                      </p>
                  		<?php echo $form->error($model,'content'); ?>
              		  </td>
              		</tr>   
              	<tfoot>    
                  <tr>    		  
              		  <td>    		    
              	    	&nbsp;<?php echo CHtml::submitButton(Yii::t('cp','提交回复'), array('class'=>'') ); ?>
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

