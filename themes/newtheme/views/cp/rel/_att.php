<div style="height: 400px; overflow: auto; background: #FFF;">
  <ul class='atm_photos'>
    <?php  
    foreach($atts as $t){
    ?>
      <li class="att_pick_li rpick csP" 
        rel_id="<?php echo $t->id; ?>"
        rel_screen_name="<?php echo $t->screen_name; ?>"          
        rel_path="<?php echo $t->path; ?>"
        rel_gavatar="<?php echo $t->gavatar; ?>"
        rel_extension="<?php echo $t->extension; ?>"  >
        <?php echo $t->imageRange; ?>
        <div>        
          <img href="<?php echo $t->image; ?>" class="zoom_photo" src='<?php echo $t->thumb; ?>' alt='<?php echo $t->screen_name; ?>' />
        </div>
        <span><?php echo $t->screen_name ?></span>
      </li>
    <?php
    }
    ?>
  </ul>  
</div>

<div class="clear ipagination taR pr10P">
  <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
</div>
