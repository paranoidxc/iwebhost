<?php
  $articles = $blog->essays(array( 'include' => true) );  
  if( count($articles) > 0 ) {
    echo '<ul>';
    foreach( $articles as $a ){
      echo '<li>';
      echo '<a href="'.CController::createUrl('blog/article', array('id' => $a->id) ).'" >';
      echo $a->title.'&nbsp;'. Time::timeAgoInWords($a->create_time);
      echo '</a>';
      echo '</li>';
    }
    echo '</ul>';
  }
?>