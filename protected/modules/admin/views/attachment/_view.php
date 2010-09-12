<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('screen_name')); ?>:</b>
	<?php echo CHtml::encode($data->screen_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
	<?php echo CHtml::encode($data->path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('w')); ?>:</b>
	<?php echo CHtml::encode($data->w); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h')); ?>:</b>
	<?php echo CHtml::encode($data->h); ?>
	<br />


</div>