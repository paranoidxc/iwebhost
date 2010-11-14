<div class='mac_panel_wrap w600p' >
<?php
  $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>"Pick Attachment") )
?>
<div style="padding: 5px">
  <form>
  <input type="text" style="border: 1px solid #ccc ; height: 20px; padding: 2px; width: 300px" /> 
  <input type="submit" value="search" class='ibtn' />
  </form>
</div>

<input type="hidden" class="return_id" value="<?php echo $return_id;?>" />

<div style="height: 200px; overflow: auto">
  <table style="width: 100%">
  <?php
  $atts = Attachment::model()->findAll();
  foreach($atts as $t){	     
  ?>
  <tr>
    <td style="padding: 5px; width: 48px; border-bottom: 1px solid #ccc;">
      <img src='/upfiles/g<?php echo $t->path?>' />
    </td>  
    <td style="vertical-align: top; border-bottom: 1px solid #ccc;">  
    ID: <?php echo $t->id ?> -
    Name: <span class='rpick'
          rel_id="<?php echo $t->id; ?>"
          rel_screen_name="<?php echo $t->screen_name; ?>"
          rel_path="<?php echo $t->path; ?>"
         ><?php echo $t->screen_name ?></span>
    </td>
  </tr>
  <?
  }
  ?>
  </table>
</div>

<div class="taR h30P pr10P pt10P">
  <input type="text" class="rel_id" value="" size="5" />
  <input type="text" class="rel_screen_name" value="" size="40"/>
  <input type="hidden" class="rel_path" value="" />  
  <?php echo CHtml::submitButton('OK', array( 'class' => 'ibtn rpick_submit')); ?>
</div>   
<?php
  $this->endWidget('application.extensions.Flatmacpanel');	 
?>
</div>