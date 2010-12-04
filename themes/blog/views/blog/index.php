<div id="article_wrap">
  <?php
    echo '<h1 class="title"><span>♥'.$article->title.'</span></h1>';
    echo '<p id="post_time">';
    echo '<span ></span>';
    echo Time::timeAgoInWords($article->create_datetime);
    echo '</p>';    
  ?>
  <div id="article">
    <?php             
        if( $article->prev ){
          echo '<p id="prev">';
          echo '<a href="'.CController::createUrl('blog/article', array( 'id'=>$article->prev->id) ).' " title="'.$article->prev->title.'" >';
          echo '&laquo;';
          echo '</a>';
          echo '</p>';  
        }
        if( $article->next ) { 
          echo '<p id="next">';
          echo '<a href="'.CController::createUrl('blog/article', array( 'id'=>$article->next->id) ).' " title="'.$article->next->title.'" >';
          echo '&raquo;';
          echo '</a>';
          echo '</p>';        
        }      
        echo ereg_replace('<script.*>.*</script>', '', Markdown( $article->content ));
        //echo Markdown( $article->content );
        
    ?>
  </div>
</div>
  <p id="map">
    <a href="<?php echo CController::createUrl('blog/map')?>" title="map articles"  >map</a>
  </p>
  <div class="dN" id="map_wrap">  
  </div>