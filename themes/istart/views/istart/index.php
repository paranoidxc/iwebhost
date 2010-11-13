<div style="width: 80%; margin: auto">
  <?php
  $istart = API::INODE(array(
    'ident_label' => 'istart'
  ));
  echo '<div id="istart_form_tab_wrap" >';
  foreach( $istart as $o ){
    ?>
      <a href="#" data="form_<?php echo $o->id?>" class="form_tab">  
        <span><?php echo $o->name ?></span>
      </a>	      
    <?php
  }
  echo '</div>';
  ?>
    
  <?php
  foreach( $istart as $o ){
    ?>
    <div id="form_<?php echo $o->id?>" class="istart_form_field_wrap form_field_wrap field_normal">
      <?php        
        echo '<ul>';
        foreach( $o->articles as $article ){
        echo '<li>';        
        //$icon = '<img class="gfavorite" src="'.FetchFavIcon::fetch($article->subtitle).'" > ';
        echo CHtml::link(
				$icon.cnSubstr($article->title,0,14), 
				$article->subtitle, 
				array( 'title' => $article->subtitle, 'target' => '_blank','style' => 'color: '.colorfulV().';'  ));        
        echo '</li>';
        }
      ?>
    </div>
    <?php
    echo '</ul>';
  }
  ?>
</div>
