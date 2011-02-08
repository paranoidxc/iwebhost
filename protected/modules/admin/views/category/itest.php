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
	            class="ele_create_leaf active ioverpanel"></a>';
	        echo '</li>';	        
          echo '<li>
          <a href="'.CController::createUrl('category/update').'"
 	           title="'.Yii::t('cp','Upload Node').'" 
 	           class="ele_update_leaf ioverpanel"></a>';
          echo '</li>';
          
          echo '<li>
            <a href="'.CController::createUrl('category/move').'"
 	             title="'.Yii::t('cp','Move Node').'" 
 	             class="ele_move_leaf ioverpanel"></a>';
 	       echo '</li>';
 	       
          echo '<li>
            <a href="'.CController::createUrl('category/delete').'"
   	        title="'.Yii::t('cp','Delete Node').'" 
     	      class="ele_del_leaf ioverpanel"></a>';
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
  
  if( $top_leaf->model_type == 'attachment' ) {
    $url_content_move =  CController::createUrl('attachment/move');
    $url_content_del  = CController::createUrl('attachment/delete');
  }else{
    $url_content_move = CController::createUrl('article/move');
    $url_content_del  = CController::createUrl('article/delete');
    $url_content_copy = CController::createUrl('article/copy');
    
    $url_sort_content = CController::createUrl('article/sortarticle');
  }
?>



<input type="hidden" name='top_leaf_id' value="<?php echo $top_leaf->id; ?>"  id="top_leaf_id" class="top_leaf_id"/>
<input type="hidden" name='cur_leaf_id' value="<?php echo $top_leaf->id; ?>"  id="cur_leaf_id" class="cur_leaf_id"/>


<input type="hidden" name='leaf_id'      value="<?php echo $top_leaf->id; ?>"           id="leaf_id"  />
<input type="hidden" name='model_type'   value="<?php echo $top_leaf->model_type == '' ? 'model_type' : $top_leaf->model_type; ?>" class="model_type" />
<input type="hidden" value="<?php echo CController::createUrl('category/view', array('ajax' => 'ajax')) ?>" class='ele_refresh_url' />
<input type="hidden" value="<?php echo CController::createUrl('category/iclass')?>" class="url_leaf_set_class" />
<input type="hidden" value="<?php echo CController::createUrl('category/part_leafs',array('top_leaf_id' => $top_leaf->id)) ?>" class="leaf_render_url"/>
<input type="hidden" value="<?php echo $url_sort_content; ?>"   class="sort_content_url"/>
<input type="hidden" value="<?php echo CController::createUrl('category/sort', array('ajax'=>'ajax')) ?>"   class="url_sort_leaf"/>

<div class=" leaf_content_wrap osX">

<ul class="actions"> 	
 
 	
 	<!-- c_s_m     content_select_more 
 	     c_s_m_d   content_select_more_dialog
 	-->
 	
 	<li>
	  <span class="c_s_m">
  	  <input type="checkbox" class="ele_list_all" /><span class="more"></span>
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
      <li href="<?php echo $url_content_move; ?>" title="<?php echo Yii::t('cp','Move Content')?>" class="c_m_a_d_batch ele_content_move">
        <?php echo Yii::t('cp','Move Content')?>
      </li> 
      <li href="<?php echo $url_content_del; ?>" class="ele_delete c_m_a_d_batch">
        <?php echo Yii::t('cp','Delete Content') ?>
      </li>
      <?php
	    if( $top_leaf->model_type == 'attachment' ) {
      ?>
      <li href="<?php echo CController::createUrl('attachment/batchedit') ?>" class="ele_update_atts c_m_a_d_batch">
			  <?php echo Yii::t('cp','Update Content') ?>
		  </li>
      <?php
      }
      ?>
      <?php
	    if( $top_leaf->model_type != 'attachment' ) {
      ?>
      <li href="<?php echo CController::createUrl('article/stared', array('ajax'=>'ajax')) ?>"
	      class="c_m_a_d_batch ele_stared"   title="Stared Articles" class="c_m_a_d_batch"><?php echo Yii::t('cp','Stared')?></li>      
	    <li href="<?php echo CController::createUrl('article/unstared', array('ajax'=>'ajax')) ?>"
	      class="c_m_a_d_batch ele_unstared" title="Unstared Articles" class="c_m_a_d_batch"><?php echo Yii::t('cp','Unstared')?></li>
	    <li href="<?php echo $url_content_copy; ?>" class="ele_copy c_m_a_d_batch">
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