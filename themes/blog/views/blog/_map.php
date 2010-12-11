<?php
 if($blog->articles) {
    echo '<ul>';
    foreach( $blog->articles as $a ){
      echo '<li>';
      echo '<a href="'.CController::createUrl('blog/article', array('id' => $a->id) ).'" >';
      echo $a->title.'&nbsp;'. Time::timeAgoInWords($a->update_time);
      echo '</a>';
      echo '</li>';
    }
    echo '</ul>';
 }
?>