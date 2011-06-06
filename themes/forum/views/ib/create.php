<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp pt20P">
        <a href="#">
          <img src="<?php echo $m->gravatar ?>" alt="<?php echo $m->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow t_ar_arrow">&nbsp;</td>
      <td class="boxshadow ar_content_wrap newest-node">
        <div class="radius5top">
	        <h1 class="raidus5top panel-title">	          
	          <a href="/" class="radius2"><?php echo Yii::app()->name ?></a>
	          &raquo;&nbsp;
	          <a href="<?php echo CController::createUrl('ib/index') ?>" class="radius2">私信</a>
	          &raquo;&nbsp;
            写私信
	        </h1>
	      </div>
        <div class='iline'></div>        
	      <div class="p10P fs14P">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',	
)); ?>
                <?php echo $form->hiddenField($model,'dest_id'); ?>
          <table class=' w100S'>
            <tr>
              <th class='w100P vaT taR p10P '>写给Ta</th>
              <td>
                <div class="taC w100P" >
                <a class="big_author_wrap" 
                href="<?php echo url('m/index',array('id' => $dest_user->username ) )?>" ><img src="<?php echo $dest_user->gravatar?>" 
                  alt="<?php echo $dest_user->username?>" 
                   title="<?php echo $dest_user->username?>"  /></a>
                <?php echo $dest_user->username; ?>
                </div>
              </td>
            </tr>
            <tr>
              <th class='vaT taR p10P ' >私信内容</th>
              <td>
                <?php echo $form->textArea($model,'memo',array('rows'=>10, 'cols'=>60,'class' => 'inbox_field' )); ?> 
                <?php echo $form->error($model,'memo'); ?> 
              </td>
            </tr>
            <tfoot>    
              <tr>    		  
          		  <th></th>
          		  <td>
    	    	      &nbsp;<?php echo CHtml::submitButton('发送') ?>
    		        </td>
    		      </tr>  	  		
            </tfoot>
          </table>
	      </div>
        <div class='mt10P'></div>
	    </td>
    </tr>
  </table>
<?php $this->endWidget(); ?>
</div>
