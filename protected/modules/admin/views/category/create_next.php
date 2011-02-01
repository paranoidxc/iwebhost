<div class="feedback_suc">
  <p>create category suc On <?php echo $model->create_time; ?></p>
</div>

<div class='step'>
  <h1>Next</h1>
  <ul>
    <li><a href="<?php echo CController::createUrl('article/create') ?>" class='create_article_continue ibtn blue' >Create Continue</a></li>
    <li><a href="<?php echo CController::createUrl('category/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue ibtn blue'>Edit This Article</a></li>
  </ul>
</div>