<div class='mac_panel_wrap w600p' >
<div style="height: 400px; overflow: auto; background: #FFF;">
<?php
  $this->renderPartial('_multiple_node',array( 'nodes' => $nodes,'return_id' => $return_id ) );
?>
</div>  	
<input type="hidden" class="return_id" value="<?php echo $return_id;?>" />
<?php echo CHtml::submitButton( Yii::t('cp','Submit'), array( 'class' => 'ibtn blue mtl_return_submit' )); ?>
</div>
