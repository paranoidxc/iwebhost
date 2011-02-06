<?php
  $return_model_type = $top_leaf->model_type == '' ? 'model_type' : $top_leaf->model_type;
  echo "<div class='mac_panel_wrap w800P' id='panel_$return_model_type' >";
  $panel_title = '<span class="filter radius4">'.$top_leaf->id."</span> ".$top_leaf->name;
  $this->beginWidget('application.extensions.Smacpanel',array('title'=>$panel_title) );
  
  echo '<table style="height: 100%; width: 100%;">';
    echo '<tr>';
      echo '<td style="height: 100%; width: 42px ; vertical-align: top;background: #E9E9E9;border-right: 1px solid #B8B8B8">';          
        echo '<ul class="leaf-sidebar" >';
          echo '<li>
          <a  href="'.CController::createUrl('category/create').'"
	            title="'.Yii::t('cp','Create Node').'" 
	            class="ele_create_category active"></a>';
	        echo '</li>';	        
          echo '<li>
          <a href="'.CController::createUrl('category/update').'"
 	           title="'.Yii::t('cp','Upload Node').'" 
 	           class="ele_update_leaf"></a>';
          echo '</li>';
          
          echo '<li>
            <a href="'.CController::createUrl('category/move').'"
 	             title="'.Yii::t('cp','Move Node').'" 
 	             class="ele_move_leaf"></a>';
 	       echo '</li>';
 	       
          echo '<li>
            <a href="'.CController::createUrl('category/delete').'"
   	        title="'.Yii::t('cp','Delete Node').'" 
     	      class="ele_del_leaf"></a>';
          echo '</li>';
        echo '</ul>';        
      echo '</td>';
    echo '<td style="height: 100%">';
  
    echo "<div class='icategory_tree'>";
      $this->renderPartial('_test_node',array( 'nodes' => $leafs,'return_id' => 'xxx' ) );
    echo "</div>";  
    echo '</td>';
    echo '<td style="height: 100%; width: 100%;">';
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
	    <li class="c_s_m_d_a"><?php echo Yii::t('cp','Select All') ?></li>
	    <li class="c_s_m_d_n"><?php echo Yii::t('cp','Select None') ?></li>
	  </ul>
	</li>
	
	<li class="hover">
		<a  href="<?php echo CController::createUrl('article/create') ?>"
	      title="<?php echo  Yii::t('cp','new')?>" class="ele_create"><?php echo Yii::t('cp','new')?></a>
 	</li>	
 	
<!--
  c_m_a     content_more_actions
	c_m_a_d   content_more_actions_dialog
-->

	<li>	  
	  <span class="c_m_a">
	    <?php echo Yii::t('cp','More Actions')?> <span class="more"></span>
	  </span>
	  <ul class='dN c_m_a_d'>
	    <li id="artiles_stared" title="Stared Articles" class="c_m_a_d_batch"><?php echo Yii::t('cp','Stared')?></li>      
	    <li id="artiles_unstared" title="Unstared Articles" class="c_m_a_d_batch"><?php echo Yii::t('cp','Unstared')?></li>
      <li id="artiles_move" title="Move Articles" class="c_m_a_d_batch ele_content_move">
        <?php echo Yii::t('cp','Move Content')?>
      </li> 
      <li href="<?php echo CController::createUrl('article/delete') ?>" id="ele_delete_articles" class="c_m_a_d_batch">
        <?php echo Yii::t('cp','Delete Content') ?>
      </li>
      <?php
	    if( $top_leaf->model_type == 'attachment' ) {
      ?>
      <li href="<?php echo CController::createUrl('attachment/batchedit') ?>" id="ele_update_atts" class="c_m_a_d_batch">
			  <?php echo Yii::t('cp','Update Content') ?>
		  </li>
      <?php
      }
      ?>
      <?php
	    if( $top_leaf->model_type != 'attachment' ) {
      ?>
	    <li href="<?php echo CController::createUrl('article/copy') ?>" id="artiles_copy" class="c_m_a_d_batch">
			  <?php echo Yii::t('cp','Copy Content') ?>
		  </li>    
	    <?php
      }
      ?>
      <li class="c_m_a_d_tip dN"><?php echo Yii::t('cp','No Selected') ?></li>
    </ul>  	  
	</li>
	
	<li class="">
	  <span class="ele_refresh flR csP mt5P radius4 mr5P"><?php echo Yii::t('cp','Refresh') ?></span>
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