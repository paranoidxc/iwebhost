<p>create category suc On <?php echo $model->create_time; ?></p>
<div>
  <h1>Next</h1>
  <ul>
    <li><a href="<?php echo CController::createUrl('article/create') ?>" class='create_article_continue' >Create Continue</a></li>
    <li><a href="<?php echo CController::createUrl('category/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue'>Edit This Article</a></li>
  </ul>
</div>