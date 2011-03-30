<?php  
?>
<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp pt20P">
        <a href="#">
          <img src="<?php echo $user->gravatar ?>" alt="<?php echo $user->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow t_ar_arrow">&nbsp;</td>
      <td class="boxshadow ar_content_wrap newest-node">
        <div class="radius5top">
	        <h1 class="raidus5top panel-title">	          
	          <a href="/" class="radius2"><?php echo Yii::app()->name ?></a>
	          &raquo;&nbsp;
            设置资料
	        </h1>
	      </div>
        <div class='iline'></div>        
    <?php if(Yii::app()->user->hasFlash('success')) {?>
      <div class="note mb10P">
        <?php echo Yii::app()->user->getFlash('success'); ?>
      </div>
    <?php } ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
    'class' => 'mb20P'
	)
)); ?>  
  	<?php //echo $form->errorSummary($m); ?>

  <table class='itable iform_table_wrap w100S mt10P'>
     <tbody>
        <tr>
          <th class='w100P'><?php echo $form->labelEx($user,'username'); ?></th>
          <td>
            <?php echo $user->username ?>
          </td>
        </tr>
        <tr>
          <th class=''><?php echo $form->labelEx($user,'sign'); ?></th>
          <td>
            <?php echo $form->textArea($m,'sign',array('rows'=>5, 'cols'=>100, 'class'=>'sign' ) ) ?>
            <?php echo $form->error($m,'sign'); ?>		
          </td>
        </tr>

        <tr>
          <td colspan="2">不修改密码,下面2个字段不需要填写!</td>
        </tr>
      
        <tr>
          <th class=''><?php echo $form->labelEx($m,'password'); ?></th>
          <td>
            <?php echo $m->password ?>
            <?php echo $form->passwordField($m,'password'); ?>		
            <?php echo $form->error($m,'password'); ?>		
          </td>
        </tr>
      
        <tr>
          <th class=''><?php echo $form->labelEx($m,'rpassword'); ?></th>
          <td>
            <?php echo $form->passwordField($m,'rpassword'); ?>		
            <?php echo $form->error($m,'rpassword'); ?>		
          </td>
        </tr>





         <tr>
          <th></th>
          <td>
            <?php echo CHtml::submitButton('保存设置', array( 'class' => 'ibtn blue')); ?>
          </td>
        </tr>

    </tbody>
  </table>

<?php $this->endWidget(); ?>
	    </td>
    </tr>
  </table>
</div>
