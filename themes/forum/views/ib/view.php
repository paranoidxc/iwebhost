<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp pt20P">
        <a href="#"><img src="<?php echo $m->gravatar ?>" alt="<?php echo $m->username ?>" /></a>
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
          <table style="width: 100%">
            <tr>
              <th style="width:30%;"></th>
              <th style="text-align: right; width:100px;">
                <div class="w100P taC">
                  <a class="big_author_wrap" href="<?php echo url('m/index', array( 'id' => $model->source->username) )?>" ><img src="<?php echo $model->source->gravatar ?>" /></a>
                  <br/>
                  <a href="<?php echo url('m/index', array( 'id' => $model->source->username) )?>" ><?php echo $model->source->username ?></a>
                </div>
              </th>
              <th class="text-align: center">VS.</th>
              <th style="text-align: left; width: 100px;">
                <div class="w100P taC">
                  <a class="big_author_wrap" href="<?php echo url('m/index', array( 'id' => $model->source->username)
                )?>"><img src="<?php echo $model->dest->gravatar ?>" /></a>
                  <br/>
                  <a href="<?php echo url('m/index', array( 'id' => $model->source->username) )?>" ><?php echo $model->dest->username ?></a>
                </div>
              </th>
              <th style="width:30%;"></th>
            </tr>
          </table>
        </div>

<table class='w100S'>
  <tr>
    <th class="w50P pl10P vaT">
      <img width="40" src="<?php echo $model->source->gravatar ?>" /><br/>
    </th>
    <td class='pl10P vaT' style='border-left: 5px solid #093; '>
      <p class=''><?php echo CHtml::encode( $model->c_time); ?></p>
      <div class="fs14P mt5P pl20P lh18P"><?php echo nl2br($model->memo); ?></div>
      <?php $temp_id = $model->source_id ; $temp_color = "#093"; ?>
      <?php 
      if( $model->posts ) {
        foreach( $model->posts as $post ) {
          if( $post->source_id == $temp_id ) {
        ?>   
          <div class="iline mt5P mb5P"></div>
          <p class=''><?php echo CHtml::encode( $post->c_time); ?></p>
          <div class="fs14P mt5P pl20P lh18P"><?php echo nl2br($post->memo); ?></div>
        <?php
          }else{
            $temp_color =  $temp_color == "#093" ? "#FF5900" : "#093";
          ?>
            <div class="h5P"></div>
            </td>
          </tr>
          <tr>
            <th class="w50P pl10P pt5P vaT">
              <img width="40" src="<?php echo $post->source->gravatar ?>" /><br/>
            </th>
            <td class="pl10P pt5P" style="border-top: 1px solid <?php echo $temp_color;?>;
                border-left: 5px solid <?php echo $temp_color; ?>"> 
              <p class=''><?php echo CHtml::encode( $post->c_time); ?></p>
              <div class="fs14P mt5P pl20P lh18P "><?php echo nl2br($post->memo); ?></div>
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
        <th class="w50P pl10P vaT pt5P"><img width="40" src="<?php echo $m->gravatar ?>" alt="" title="" /></th>
        <td class='vaT pt5P' style='border-left: 5px solid #FFF; '>

              <?php $form=$this->beginWidget('CActiveForm', array( 'action' => array('ib/r'))); ?>   
              <?php echo $form->hiddenField($nmodel,'dest_id'); ?>
              <?php echo $form->hiddenField($nmodel,'parent_id'); ?>
              <?php echo $form->textArea($nmodel,'memo',array('rows'=>10, 'cols'=>60,'class' => 'inbox_field' )); ?> 
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
