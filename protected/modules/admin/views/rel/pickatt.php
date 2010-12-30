<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Pick Attachment") )
?>
<div style="padding: 5px">
  <form action="<?php echo CController::createUrl('rel/pickAtt') ?>" method="get" class="pick_att_form">
    <input type="text" style="border: 1px solid #ccc ; height: 20px; padding: 2px; width: 556px;" name="screen_name" class="screen_name" />     
  </form>
</div>

<input type="hidden" class="return_id" value="<?php echo $return_id;?>" />
<style>
  .att_pick_ul {    
    text-aling: center;     
    width: 546px;
    margin: auto;
  }
  .att_pick_li {
    float: left;
    width: 160px;
    margin-right: 10px;
    margin-bottom: 10px;
    padding: 5px;
    height: 136px;    
    border: 1px solid #ccc;
    background: #FFF;
    text-align: center;
  }
  .att_pick_li div {
    width: 160px;
    height: 120px;
    margin-bottom: 3px;
  }
  .att_pick_li span {
    width: 160px;
    height: 16px;
    overflow: hidden;
  }
</style>
<div style="height: 400px; overflow: auto; background: #FFF;" class="att_pick_wrap">
  <?php  
  foreach($atts as $t){
  ?>
  <ul class='att_pick_ul'>
    <li class="att_pick_li">
      <div>
        <img src='<?php echo $t->thumb; ?>' alt='<?php echo $t->screen_name; ?>' />
      </div>
      <span class='rpick csP'
          rel_id="<?php echo $t->id; ?>"
          rel_screen_name="<?php echo $t->screen_name; ?>"          
          rel_path="<?php echo $t->gavatar; ?>"
         ><?php echo $t->screen_name ?></span></li>
  </ul>
  <?php
  }
  ?>  
</div>

<div class="taR h30P pr10P pt10P">
  <img src="" alt="" class="rel_gavatar" />
  <input type="text" class="rel_id" value="" size="5" />
  <input type="text" class="rel_screen_name" value="" size="40"/>
  <input type="hidden" class="rel_path" value="" />  
  <?php echo CHtml::submitButton('OK', array( 'class' => 'ibtn att_return_submit')); ?>
</div>   
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>