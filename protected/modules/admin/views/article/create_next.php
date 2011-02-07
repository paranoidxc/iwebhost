<div class="feedback_suc">
	<p>create  suc On <?php echo Time::now();?> </p>
</div>
<input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />

<div class='step'>
  <h1><?php echo Yii::t('cp', 'Choose Next') ?>:</h1>
  <ul>
    <li><a href="<?php echo CController::createUrl('article/create') ?>" class='ele_create_continue ibtn blue' >Create Continue&nbsp;&raquo;</a></li>
    <li><a href="<?php echo CController::createUrl('article/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue ibtn blue'>Edit This&nbsp;&raquo;</a></li>
  </ul>
</div>