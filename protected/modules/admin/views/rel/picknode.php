<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>Yii::t('cp',"Pick Attachment Gallery")) )
?>
 <?php
		$nodes  = Category::model()->ileafs(
      array( 'ident' => 'attachment','include' => true )
	  );
	  ?>
	  <div style="height: 400px; overflow: auto; background: #FFF;">
	  <?php
		$this->renderPartial('_node',array( 'nodes' => $nodes,'return_id' => $return_id ) );
    ?>
	  </div>  	
  <input type="hidden" class="return_id" value="<?php echo $return_id;?>" />
  <div class="taR h30P pr10P">    
    <input type="text" name="category_id"  class="move_category_id node_id hidden_like_span" readonly="true" /> - 
    <input type="text" name="category_name" class="move_category_name node_name hidden_like_span" readonly="true" />  
    <?php echo CHtml::submitButton( Yii::t('cp','Submit'), array( 'class' => 'ibtn blue collect_return_submit' )); ?>
  </div>  
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>