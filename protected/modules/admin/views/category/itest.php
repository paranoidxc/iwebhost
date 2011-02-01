<?php
  $return_model_type = $top_leaf->model_type == '' ? 'model_type' : $top_leaf->model_type;
  echo "<div class='mac_panel_wrap w800P' id='panel_$return_model_type' >";
  $panel_title = 'Name:'.$top_leaf->name.' - ID:'.$top_leaf->id;
  $this->beginWidget('application.extensions.Smacpanel',array('title'=>$panel_title) );
  
  echo '<table>';
    echo '<tr>';
      echo '<td style="width: 42px ; vertical-align: top;background: #E9E9E9;border-right: 1px solid #B8B8B8">';          
        echo '<ul class="leaf-sidebar" >';
          echo '<li>
          <a  href="'.CController::createUrl('category/create').'"
	            title="create new leaf inside current leaf" 
	            class="ele_create_category active"></a>';
	        echo '</li>';	        
          echo '<li>
          <a href="'.CController::createUrl('category/update').'"
 	           title="update the current leaf" 
 	           class="ele_update_leaf"></a>';
          echo '</li>';
          
          echo '<li>
            <a href="'.CController::createUrl('category/move').'"
 	             title="move the current leaf to another" 
 	             class="ele_move_leaf"></a>';
 	       echo '</li>';
 	       
          echo '<li>
            <a href="'.CController::createUrl('category/delete').'"
   	        title="delete current leaf" 
     	      class="ele_del_leaf"></a>';
          echo '</li>';
        echo '</ul>';        
      echo '</td>';
    echo '<td>';
  
    echo "<div class='icategory_tree'>";
      $this->renderPartial('_test_node',array( 'nodes' => $leafs,'return_id' => 'xxx' ) );
    echo "</div>";  
    echo '</td>';
    echo '<td>';
  // top actions 
?>



<input type="hidden" name='top_leaf_id' value="<?php echo $top_leaf->id; ?>"  id="top_leaf_id"/>
<input type="hidden" name='cur_leaf_id' value="<?php echo $top_leaf->id; ?>"  id="cur_leaf_id"/>


<input type="hidden" name='leaf_id'      value="<?php echo $top_leaf->id; ?>"           id="leaf_id"  />
<input type="hidden" name='model_type'   value="<?php echo $top_leaf->model_type == '' ? 'model_type' : $top_leaf->model_type; ?>"   id="model_type" class="model_type" />

<input type="hidden" class='ele_refresh_url' value="<?php echo CController::createUrl('category/view', array('ajax' => 'ajax')) ?>" />

<input type="hidden" value="<?php echo CController::createUrl('category/view', array('ajax' => 'ajax') ) ?>" id="leaf_content_view_url" />
<input type="hidden"  value="<?php echo CController::createUrl('category/part_leafs',array('top_leaf_id' => $top_leaf->id)) ?>"   id="leaf_render_url"/>
<input type="hidden"  value="<?php echo CController::createUrl('article/sortarticle') ?>"   id="sort_content_url"/>
<input type="hidden"  value="<?php echo CController::createUrl('category/sort', array('ajax'=>'ajax')) ?>"   id="sort_leaf_url"/>

<input type="hidden"  value="<?php echo CController::createUrl('article/stared', array('ajax'=>'ajax')) ?>"   class="artiles_stared_url"/>
<input type="hidden"  value="<?php echo CController::createUrl('article/unstared', array('ajax'=>'ajax')) ?>"   class="artiles_unstared_url"/>

<?php 
  if( $top_leaf->model_type == 'attachment' ) {
    ?>
    <input type="hidden"  value="<?php echo CController::createUrl('attachment/move') ?>"   id="leaf_content_move_url"/>
    <input type="hidden"  value="<?php echo CController::createUrl('attachment/delete') ?>" id="leaf_content_del_url"/>
    <?php
  }
  else{
    ?>
    <input type="hidden"  value="<?php echo CController::createUrl('article/move') ?>"    id="leaf_content_move_url"/>
    <input type="hidden"  value="<?php echo CController::createUrl('article/delete') ?>"  id="leaf_content_del_url"/>
    <?
  }
?>


<div id="leaf_articles_wrap"  class="osX">

<ul class="actions"> 	
 
 	
 	<!-- c_s_m     content_select_more 
 	     c_s_m_d   content_select_more_dialog
 	-->
 	
 	<li>
	  <span class="c_s_m">
  	  <input type="checkbox" id="cb_all" class="ele_list_all" /><span class="more"></span>
	  </span>
	  <ul class='dN c_s_m_d'>
	    <li class="c_s_m_d_a">All</li>
	    <li class="c_s_m_d_n">None</li>
	  </ul>
	</li>
	
	<li class="hover">
		<a  href="<?php echo CController::createUrl('article/create') ?>"
	      title="Create Article" class="ele_create">new</a>
 	</li>	
 	
	<!-- c_m_a     content_more_actions
 	     c_m_a_d   content_more_actions_dialog
 	-->
	<li>	  
	  <span class="c_m_a">
	    More Actions<span class="more"></span>
	  </span>
	  <ul class='dN c_m_a_d'>
	    <li id="artiles_stared" title="Stared Articles" class="c_m_a_d_batch">Stared</li>      
	    <li id="artiles_unstared" title="Unstared Articles" class="c_m_a_d_batch">Unstared</li>
      <li id="artiles_move" title="Move Articles" class="c_m_a_d_batch ele_content_move">move</li> 
      <li href="<?php echo CController::createUrl('article/delete') ?>" id="ele_delete_articles" title="Delete Articles" class="c_m_a_d_batch">delete</li>
      <?php
	    if( $top_leaf->model_type == 'attachment' ) {
      ?>
      <li href="<?php echo CController::createUrl('attachment/batchedit') ?>" id="ele_update_atts" title="Update Attachments" class="c_m_a_d_batch">
			  Update
		  </li>
      <?php
      }
      ?>
      <?php
	    if( $top_leaf->model_type != 'attachment' ) {
      ?>
	    <li href="<?php echo CController::createUrl('article/copy') ?>" id="artiles_copy" title="Move Articles" class="c_m_a_d_batch">
			  copy
		  </li>    
	    <?php
      }
      ?>
      <li class="c_m_a_d_tip dN">Pls Select C</li>
    </ul>  	  
	</li>
	
	<li class="">
	  <span class="ele_refresh flR csP mt5P radius4">Refresh</span>
	</li>
	<!--
	<li class="list_symbol">
	  <a href="#" title="#" class=""></a>
 	</li>
 	
 	<li class="thumb_symbol">
	  <a href="#" title="#" class=""></a>
 	</li>
  -->
</ul>

<?php
  echo '<div id="leaf_articles" class="leaf_content">';
  
  $this->renderPartial('ajaxview_attachment', array() , false, true);
  
  echo '</div>';      
  
  echo '</td>';
  echo '</tr>';
  echo '</table>';
  echo '<div class="ajax_overlay" />';
  $this->endWidget('application.extensions.Smacpanel');	  
  echo "</div>";
?>