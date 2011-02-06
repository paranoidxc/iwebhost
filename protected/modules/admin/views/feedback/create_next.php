<div class="feedback_suc">
	<p>
	  <?php echo Yii::t('cp', 'Create') ?> 	
	  <?php echo Yii::t('cp', 'Feedback') ?> 
	  <?php echo Yii::t('cp', 'Suc') ?>  
	  <?php echo Yii::t('cp', 'On') ?> 
	  <?php echo Time::now();?>
	  <!--Panel Ident = <?php echo $panel_ident;?>-->
	</p>
</div>

<input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />

<div class='step'>
  <h1><?php echo Yii::t('cp', 'Choose Next') ?>:</h1>
  <ul>
    <li>
      <a href="<?php echo CController::createUrl('feedback/create') ?>" class='ele_create_continue ibtn blue' >  
        <?php echo Yii::t('cp','Create Continue'); ?>&nbsp;&raquo;
      </a>
    </li>
    <li>
      <a href="<?php echo CController::createUrl('feedback/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue ibtn blue'>          
        <?php echo Yii::t('cp','Edit This'); ?>&nbsp;&raquo;
      </a>
    </li>
  </ul>
</div>