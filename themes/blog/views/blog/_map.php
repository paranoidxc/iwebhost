<?php
  $articles = $blog->essay(array( 'include' => true) );  
  if( count($articles) > 0 ) {
    echo '<ul>';
    foreach( $articles as $a ){
      echo '<li>';
      echo '<a href="'.CController::createUrl('blog/article', array('id' => $a->id) ).'" >';
      echo $a->title.'&nbsp;'. Time::timeAgoInWords($a->update_time);
      echo '</a>';
      echo '</li>';
    }
    echo '</ul>';
  }
?>