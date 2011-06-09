<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp',"Move to")) )
?>

<input type="hidden" class="return_panel" value="<?php echo $panel_ident;?>" />

<form action="<?php echo CController::createurl('article/move') ?>" method="post" class="ajax_move_form" id="article_ajax_move">

  <div style="height: 400px; overflow: auto; background: #FFF;">
  <?php
    $this->renderPartial('_node',array( 'nodes' => $leafs,'return_id' => $return_id ) );
  ?>  
  </div>
   <div class="taR h30P lh30P pt5P pr10P">    
    <input type="text" name="category_id"  class="move_category_id hidden_like_span" readonly = true /> - 
    <input type="text" name="category_name" class="move_category_name hidden_like_span" readonly = true />  
    <?php echo CHtml::submitButton( Yii::t('cp','Submit'), array( 'class' => 'ibtn blue')); ?>
  </div>  
  
</form>

<div class="ajax_overlay" />

<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>