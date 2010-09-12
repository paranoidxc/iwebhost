
<script type="text/javascript">
		var swfu;
		window.onload = function() {
			var settings = {
				flash_url : "/swfupload/swfupload.swf",
				upload_url: "/upload.php",
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
	     };
	</script>
	
<table width="100%">
  <tr>
    <td width="150" class="blue">remind for categorys</td>
    <td class="green"> remind for content </td>
    <td width="200" class="red">
      <form id="form1" action="index.php" method="post" enctype="multipart/form-data">		  
        <div>
				  <span id="spanButtonPlaceHolder">Upload Attachment</span>
			  	<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
			  </div>
			  <div id="divStatus">0 Files Uploaded</div>
			  <div class="fieldset flash" id="fsUploadProgress">
			    <span class="legend">Upload Queue</span>
			  </div>
	    </form>    
    </td>
  </tr>
</table>