<div class="feedback_suc">
	<p>create feedback suc On <?php echo Time::now();?> </p>
</div>

<div class='step'>
  <h1>Next:</h1>
  <ul>
    <li><a href="<?php echo CController::createUrl('article/create') ?>" class='ele_create_continue ibtn' >Create Continue&nbsp;&raquo;</a></li>
    <li><a href="<?php echo CController::createUrl('article/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue ibtn'>Edit This&nbsp;&raquo;</a></li>
  </ul>
</div>