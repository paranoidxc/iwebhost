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