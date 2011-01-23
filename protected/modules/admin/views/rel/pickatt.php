<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Pick Attachment") )
?>
<input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('rel/pickAtt', array('keyword' => '')) ?>" />

<div style="padding: 5px">
  <form action="<?php echo CController::createUrl('rel/pickAtt') ?>" method="get" class="search_form">    
    <input type="text" name="keyword" class="radius7 search_input keyword" />
  </form>
</div>

<input type="hidden" class="return_id" value="<?php echo $return_id;?>" />
<style>
  .att_pick_ul {    
    text-aling: center;     
    width: 546px;
    margin: auto;
  }
  .atm_photos .att_pick_li div {    
    height: 118px;  
    margin-bottom: 1px;
  }
  
  .att_pick_li span {
    width: 130px;
    height: 16px;
    display: block;
    margin: auto;    
    overflow: hidden;
  }
</style>
<div style="height: 400px; overflow: auto; background: #FFF;" class="search_result_wrap">
  <?php $this->renderPartial('_att',array( 'atts' => $atts,'pagination' => $pagination, 'select_pagination' => $select_pagination) ); ?>
</div>

<div class="bgTips p5p">
<?php $this->renderPartial('_upload'); ?>
</div>

<div class="taR h50P pr10P pt10P " style="line-height: 50p">
  <img src="" alt="" class="dN vaM image_border rel_gavatar" />
  <input type="hidden" class="rel_id" value="" size="5" />
  <input type="hidden" class="rel_screen_name" value="" size="40"/>
  <input type="hidden" class="rel_path" value="" />
  <input type="hidden" class="rel_extension" value="" />  
  <input type="hidden" class="upfiles_dir" value="<?php echo  UPFILES_DIR; ?>/" />  
  <select class="dN rel_imagerange">
  </select>
  <input type="hidden" class="rtype" value="<?php echo $rtype; ?>" />
  <?php echo CHtml::submitButton('OK', array( 'class' => 'ibtn att_return_submit')); ?>
</div>   
<div class="ajax_overlay" ></div>
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>