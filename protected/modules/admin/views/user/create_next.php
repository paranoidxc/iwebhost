<p>create category suc On <?php echo $panel_ident; ?></p>
<input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />
<div>
  <h1>Next</h1>
  <ul>
    <li><a href="<?php echo CController::createUrl('user/create') ?>" class='ele_create_continue' >Create Continue</a></li>
    <li><a href="<?php echo CController::createUrl('user/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue'>Edit This</a></li>
  </ul>
</div>