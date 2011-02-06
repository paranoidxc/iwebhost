<?php if(Yii::app()->user->hasFlash('success')) {?>
  <div class="flash_suc">
    <?php echo Yii::app()->user->getFlash('success'); ?>
  </div>
<?php } ?>
  
<div class='step'>
  <h1>Next</h1>
  <ul>
    <li>
      <a href="<?php echo CController::createUrl('category/create') ?>" class='create_article_continue ibtn blue' >
        <?php echo Yii::t('cp','Create Continue') ?>
      </a>
    </li>
    <li>
      <a href="<?php echo CController::createUrl('category/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue ibtn blue'>
        <?php echo Yii::t('cp','Edit This') ?>
      </a>
    </li>
  </ul>
</div>