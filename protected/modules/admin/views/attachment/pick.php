<?php
$atts = Attachment::model()->findAll();
foreach($atts as $t){	     
?>
<p>
  dd<img src="<?php echo $t->thumb; ?>" alt="<?php echo $t->screen_name;?>" />
  ID: <?php echo $t->id ?> --
  Name: <?php echo $t->screen_name ?>
  ---- <span  class='rpick'
        return_id="<?php echo $return_id;?>"
        rel_id="<?php echo $t->id; ?>"
        rel_screen_name="<?php echo $t->screen_name; ?>"
        rel_path="<?php echo $t->path; ?>"
       >return Pick</span>
</p>
<?
}
?>
