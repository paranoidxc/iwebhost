<div class="feedback_suc">
  <p>create category suc On <?php echo $panel_ident; ?></p>
  <input type="hidden" class='return_panel' value="<?php echo $panel_ident; ?>" />
</div>

<div class='step'>
  <h1>Next</h1>
  <ul>
    <li><a href="<?php echo CController::createUrl('user/create') ?>" class='ele_create_continue ibtn' >Create Continue</a></li>
    <li><a href="<?php echo CController::createUrl('user/update',array('id'=>$model->id,'ajax'=>'ajax') )?>" class='edit_article_continue ibtn'>Edit This</a></li>
  </ul>
</div>