<?php
 if($blog[0]->articles) {
    echo '<ul>';
    foreach( $blog[0]->articles as $a ){
      echo '<li>';
      echo '<a href="'.CController::createUrl('blog/article', array('id' => $a->id) ).'" >';
      echo $a->title.'&nbsp;'. Time::timeAgoInWords($a->create_datetime);
      echo '</a>';
      echo '</li>';
    }
    echo '</ul>';
 }
?>