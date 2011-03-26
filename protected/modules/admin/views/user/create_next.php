<?php if(Yii::app()->user->hasFlash('success')) {?>
  <div class="flash_suc">
    <?php echo Yii::app()->user->getFlash('success'); ?>
  </div>
<?php } ?>
<input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />
<div class='step'>
  <h1><?php echo Yii::t('cp', 'Choose Next') ?>:</h1>
  <ul>
    <li>
      <a href="<?php echo CController::createUrl('user/create') ?>" class='ele_create_continue ibtn blue' >    
      <?php echo Yii::t('cp','Create Continue') ?>
      </a>
    </li>
    <li>
      <a href="<?php echo CController::createUrl('user/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue ibtn blue'>
      <?php echo Yii::t('cp','Edit This') ?>
      </a>
    </li>
  </ul>
</div>