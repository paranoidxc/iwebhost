<ul class='atm_photos'>
  <?php  
  foreach($atts as $t){
  ?>
    <li class="att_pick_li rpick csP" 
      rel_id="<?php echo $t->id; ?>"
      rel_screen_name="<?php echo $t->screen_name; ?>"          
      rel_path="<?php echo $t->gavatar; ?>" >
      <div>
        <img src='<?php echo $t->thumb; ?>' alt='<?php echo $t->screen_name; ?>' />
      </div>
      <span><?php echo $t->screen_name ?></span>
    </li>
  <?php
  }
  ?>  
</ul>