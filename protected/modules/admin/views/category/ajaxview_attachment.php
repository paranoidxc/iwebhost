<div id="article_drag_ele">
<table>
  <tr>
    <td>
    
<ul class='atm_photos' >
<?php
  if( $model ){
    foreach($model->attachments as $t){
      echo '<li>';
      if( $t->is_image() ){
      echo '<div class="thumb_wrap">';
      echo "<a class='lightbox' href='$t->image' >";
      echo '<img src="'.$t->thumb.'" alt=""  /> ';
      echo '</a>';
      echo '</div>';
      echo '<p >';
      echo "<p rel_href='".CController::createUrl('attachment/update',array( 'ajax' => 'ajax' , 'id' => $t->id ))."' >";
      echo '<input type="checkbox" class="cb_article" value="'.$t->id.'"  >';
      echo '<span class="crP atts content_item"
              data = "'.$t->id.'"
              rel_url="'.CController::createurl('attachment/update',array( 'ajax' => 'ajax' , 'id' => $t->id ) ).'" 
              rel_id="'.$t->id.'" title="'.$t->screen_name.'">Edit</span>';
      echo '</p>';
      }else{        
        echo '<img src="/default_image/unknown.png" alt="" /> ';        
        echo "<p rel_href='".CController::createUrl('attachment/update',array( 'ajax' => 'ajax' , 'id' => $t->id ))."' >"; 
        echo '<input type="checkbox" class="cb_article" value="'.$t->id.'"  >';
        echo '<span class="crP atts content_item"
              data = "'.$t->id.'"
              rel_url="'.CController::createurl('attachment/update',array( 'ajax' => 'ajax' , 'id' => $t->id ) ).'" 
              rel_id="'.$t->id.'" title="'.$t->screen_name.'">Edit</span>';
        echo '</p>';
      }
      echo '</li>';
    }
  }
?>

</ul>
    </td>    
    <td style="width: 35%" class="dN attachment_form_wrap">
      <div id="attachment_form" >
        <form id="form1" action="index.php" method="post" enctype="multipart/form-data">		  
          <div>
			      <span id="spanButtonPlaceHolder">Upload Attachment</span>
			      <input id="ibtnCancel" 
			            type="button"
			            value="Cancel All Uploads" onclick="swfu.cancelQueue();"
			  	        disabled="disabled"
			  	        class='ibtn blue'
			  	        style="margin-top: 6px;"/>
		      </div>
		      <div id="divStatus">0 Files Uploaded</div>
		      <p class="progress">Upload Queue</p>
		      <div class="fieldset flash" id="fsUploadProgress">
			      <span class="legend dN">Upload Queue</span>
		      </div>
	      </form>  
      </div>
      
      
      <script type="text/javascript">
		var swfu;
		//window.onload = function() {
			var settings = {
				flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/swfupload/swfupload.swf",				
				upload_url: "<?php echo CController::createurl('attachment/upload',array( 'category_id' => $model ? $model->id : '' ) ) ?>",
        //upload_url: "<?php echo CController::createurl('attachment/upload',array( 'category_id' => $model->id ) ) ?>",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_size_limit : "100 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "ibtnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "/default_image/XPButtonUploadText_61x22.png",				
				button_width: "61",
				button_height: "22",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont"></span>',
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	  //   };
	</script>
	
    </td>
  </tr>
</table>
</div>
 