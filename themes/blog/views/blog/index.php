<div id="article_wrap">
  <?php
    echo '<h1 class="title"><span>♥'.$article->title.'</span>';
    
    echo '<p id="post_time">';
    echo '<span ></span>';
    echo Time::timeAgoInWords($article->create_time);
    echo '</p>';    
    echo '</h1>';
  ?>
  <?php             
      if( $article->getPrev($blog->id) ){
        echo '<p id="prev">';
        echo '<a href="'.CController::createUrl('blog/article', array( 'id'=>$article->getPrev($blog->id)->id) ).' " title="'.$article->getPrev($blog->id)->title.'" >';
        //echo '&laquo;';
        echo '{';
        echo '</a>';
        echo '</p>';  
      }
      if( $article->getNext($blog->id)) { 
        echo '<p id="next">';
        echo '<a href="'.CController::createUrl('blog/article', array( 'id'=>$article->getNext($blog->id)->id) ).' " title="'.$article->getNext($blog->id)->title.'" >';
        //echo '&raquo;';
        echo '}';
        echo '</a>';
        echo '</p>';        
      }            
  ?>
  <div id="article">
    <?php              
      echo ereg_replace('<script.*>.*</script>', '', Markdown( $article->content ));
        //echo Markdown( $article->content );      
    ?>
  </div>
</div>
<span id="afk">Keyboard shortcuts available</span>

<div id="facebox" style="display: none">
  <div class="bg">
  </div>
  <div class="popup">
    <a href="#" class="close"><img src="/images/closelabel.png" title="close" class="close_image"></a>
  
    <div class="shortcuts">
      <h2>Keyboard Shortcuts</h2>
        
      <div class="threecols">
        <div class="column first">
          <h3>Site wide shortcuts</h3>
          <!--<dl class="keyboard-mappings">
            <dt>s</dt>
            <dd>Focus site search</dd>
          </dl>-->
          <dl class="keyboard-mappings">
            <dt>?</dt>
            <dd>Bring up this help dialog</dd>
          </dl>
        </div>    
      
        
        
        <div class="column middle">
          <h3>Commit list</h3>
          <dl class="keyboard-mappings">
            <dt>j</dt>
            <dd>Prev Esaay</dd>
          </dl>
          <dl class="keyboard-mappings">
            <dt>k</dt>
            <dd>Next Esaay</dd>
          </dl>
          <dl class="keyboard-mappings">
            <dt>M</dt>
            <dd>Esaay List</dd>
          </dl>
          <!--
          <dl class="keyboard-mappings">
            <dt>t</dt>
            <dd>Open tree</dd>
          </dl>
          <dl class="keyboard-mappings">
            <dt>p</dt>
            <dd>Open parent</dd>
          </dl>
          <dl class="keyboard-mappings">
            <dt>c <em>or</em> o <em>or</em> enter</dt>
            <dd>Open commit</dd>
          </dl>
          -->
        </div>
    
      </div>

    </div>
  </div>
</div>

  <p id="map" class="dN">
    <a href="<?php echo CController::createUrl('blog/map')?>" title="map articles"  >map</a>
  </p>
  <div class="dN" id="map_wrap">  
  </div>