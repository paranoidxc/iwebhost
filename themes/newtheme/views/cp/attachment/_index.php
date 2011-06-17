<ul class='atm_photos' >
<?php
  if( $list ){
    foreach($list as $t){
      echo '<li>';
      if( $t->is_image() ){
      echo '<div class="thumb_wrap">';
      echo "<a class='lightbox zoom_photo' href='$t->image' >";
      echo '<img src="'.$t->thumb.'" alt=""  /> ';
      echo '</a>';
      echo '</div>';
      echo '<p >';
      echo "<p>";
      echo '<input type="checkbox" class="item-sep" name="ids[]" value="'.$t->id.'"  >';
      echo '<span class="crP atts"
              data = "'.$t->id.'"
              href="'.url('/cp/attachment/update',array('id' => $t->id,'action' => action() ) ).'" 
              rel_id="'.$t->id.'" title="'.$t->screen_name.'">';
      echo '<a href="'.url('/cp/attachment/update',array('id' => $t->id, 'action' => action(),
           'top_leaf_id' => $top_leaf->id ) ).'" >'.Yii::t('cp','Edit').'</a>';
      echo '</span>';
      echo '</p>';
      }else{        
        echo '<img src="/default_image/unknown.png" alt="" /> ';        
        echo "<p rel_href='".CController::createUrl('attachment/update',array( 'ajax' => 'ajax' , 'id' => $t->id ))."' >"; 
        echo '<input type="checkbox" class="item-sep" name="ids[]" value="'.$t->id.'"  >';
        echo '<span class="crP atts content_item"
              data = "'.$t->id.'"
              rel_url="'.CController::createurl('attachment/update',array( 'ajax' => 'ajax' , 'id' => $t->id ) ).'" 
              rel_id="'.$t->id.'" title="'.$t->screen_name.'">'.Yii::t('cp','Edit').'</span>';
        echo '</p>';
      }
      echo '</li>';
    }
  }
?>
</ul>
