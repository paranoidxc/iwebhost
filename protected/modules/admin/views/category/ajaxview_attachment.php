<div id="article_drag_ele">
<table>
  <tr>
    <td>
    
<ul class='atm_photos' >
<?php
  
  foreach($model->attachments as $t){
      echo '<li>';
      echo "<a class='lightbox' href='$t->image' >";
      echo '<img src="'.$t->thumb.'"  /> ';
      echo '</a>';
      echo '<p>';
      echo '<input type="checkbox" class="cb_article" rel_id="'.$t->id.'"  >';
      echo '<span class="crP atts"
              data = "'.$t->id.'"
              rel_url="'.CController::createurl('attachment/update',array( 'ajax' => 'ajax' , 'id' => $t->id ) ).'" 
              rel_id="'.$t->id.'" title="'.$t->screen_name.'">Edit</span>';
      echo '</p>';
  }
?>

</ul>
    </td>    
    <td style="width: 35%" id="attachment_form_wrap">        
    <script type="text/javascript">
		var swfu;
		//window.onload = function() {
			var settings = {
				flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/swfupload/swfupload.swf",
        upload_url: "<?php echo CController::createurl('attachment/upload',array( 'category_id' => $model->id ) ) ?>",
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_size_limit : "100 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "/images/TestImageNoText_65x29.png",				
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Hello</span>',
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
    
    
    
    
      <div id="attachment_form" >
        <form id="form1" action="index.php" method="post" enctype="multipart/form-data">		  
          <div>
			      <span id="spanButtonPlaceHolder">Upload Attachment</span>
			      <input id="btnCancel" 
			            type="button"
			            value="Cancel All Uploads" onclick="swfu.cancelQueue();"
			  	        disabled="disabled"
			  	        style="margin-left: 2px; font-size: 8pt; height: 29px;" />
		      </div>
		      <div id="divStatus">0 Files Uploaded</div>
		      <div class="fieldset flash" id="fsUploadProgress">
			      <span class="legend">Upload Queue</span>
		      </div>
	      </form>  
      </div>
    </td>
  </tr>
</table>
</div>
 