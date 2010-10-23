<?php
$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Attachment', 'url'=>array('index')),
	array('label'=>'Create Attachment', 'url'=>array('create')),
	array('label'=>'View Attachment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Attachment', 'url'=>array('admin')),
);
?>

<h1>Update Attachment <?php echo $model->id; ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'class' => 'ajax_form'
	)
)); ?>

  <img src='/upfiles/s<?php echo $model->path; ?>' />

  <div class="row">
		<?php echo $form->labelEx($model,'screen_name'); ?>
		<?php echo $form->textField($model,'screen_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'screen_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'w'); ?>
		<?php echo $form->textField($model,'w',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'w'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'h'); ?>
		<?php echo $form->textField($model,'h',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'h'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>