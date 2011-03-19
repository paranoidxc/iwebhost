<div class="iform radius5 boxshadow newest-node " >
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
)); ?>
  
  <h1 class='raidus5top panel-title' >
    <a href="/" ><?php echo Yii::app()->name ?></a>&raquo;&nbsp;重置密码邮件发送成功!
  </h1>
  
  <div class='iline'></div>  
  <div class='p10P'>      
  	<p class="note">重置用户 <?php echo $model->username ?> 密码邮件已发送至邮箱 <?php echo $model->email ?>, 请注意查收!</p>
  </div>   
<?php $this->endWidget(); ?>
</div>