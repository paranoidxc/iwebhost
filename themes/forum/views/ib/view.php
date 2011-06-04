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
	          <a href="<?php echo url('ib/index') ?>" class="radius2">私信</a>
	        </h1>
	      </div>
        <div class='iline mb5P'></div>
        <div class="p10P">
          <table>
            <tr>
              <th>
                <img src="<?php echo $model->source->gravatar ?>" /><br/>
                <?php echo $model->source->username ?>
              </th>
              <th>
                发给
              </th>
              <th>
                <img src="<?php echo $model->dest->gravatar ?>" /><br/>
                <?php echo $model->dest->username ?>
              </th>
            </tr>
          </table>
        </div>

<table class='itable iform_table_wrap w100S'>
  <tr>
    <th width="100">
      <img width="40" src="<?php echo $model->source->gravatar ?>" /><br/>
    </th>
    <td>
      <?php echo $model->source->username ?> - 
      <?php echo CHtml::encode( $model->c_time); ?><br/>
      <?php echo CHtml::encode( $model->memo); ?>
      <?php $temp_id = $model->source_id ?>
      <?php 
      if( $model->posts ) {
        foreach( $model->posts as $post ) {
          if( $post->source_id == $temp_id ) {
        ?>   
          <br/>
          <?php echo $post->source->username ?> - 
          <?php echo CHtml::encode( $post->c_time); ?><br/>
          <?php echo CHtml::encode( $post->memo); ?>
        <?php
          }else{
          ?>
            </td>
          </tr>
          <tr> 
            <th width="100">
              <img width="40" src="<?php echo $post->source->gravatar ?>" /><br/>
            </th>
            <td> 
              <?php echo $post->source->username ?> - 
              <?php echo CHtml::encode( $post->c_time); ?><br/>
              <?php echo CHtml::encode( $post->memo); ?>
          <?php
          }
          $temp_id = $post->source_id;
        }
      ?>
        </td>
      </tr>
      <?php
      }else{
      ?>
        </td>
      </tr>
      <?php
      }
      ?>

<!--reply form start -->
      <tr>
        <th><img width="40" src="<?php echo $m->gravatar ?>" alt="" title="" /></th>
        <td>
              <?php $form=$this->beginWidget('CActiveForm', array( 'action' => array('ib/r'))); ?>   
              <?php echo $form->hiddenField($nmodel,'dest_id'); ?>
              <?php echo $form->hiddenField($nmodel,'parent_id'); ?>
              <?php echo $form->textArea($nmodel,'memo',array('rows'=>10, 'cols'=>60,'class' => '' )); ?> 
              <?php echo $form->error($nmodel,'memo'); ?> 
              <br/>
              <?php echo CHtml::submitButton('发送') ?>
              <?php
                if( $model->source_id == User()->id ) {//自己是发送方
               ?>
               <a href="<?php echo url('ib/c',array('dest_id' => $model->dest_id) )?>">发给Ta新私信</a>
               <?php
               }else{
               //自己是接收方
               ?> 
               <a href="<?php echo url('ib/c',array('dest_id' => $model->source_id) )?>">发给Ta新私信</a>
               <?php
                }
              ?>  
              <?php $this->endWidget(); ?>
          </td>
        </tr>
<!--reply form end -->


</table>



       </div>
       <div class='mt10P'></div>
	    </td>
    </tr>
  </table>
</div>
