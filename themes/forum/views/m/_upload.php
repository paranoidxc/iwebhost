<script type="text/javascript">
	var swfu;		
	var settings = {		
		flash_url : "<?php echo API::get_theme_baseurl(); ?>/swfupload/swfupload.swf",
    upload_url: "/admin/attachment/upload?&user_id=<?php echo User()->id; ?>category_id=",    
    button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
		post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
    file_size_limit : "1 MB",
    file_types : "*.jpg;*.gif,*.png",
		custom_settings : {
				progressTarget : "fsUploadProgress",
				cancelButtonId : "btnCancel"
			},
		debug: false,
		// Button settings
		button_image_url: "/default_image/XPButtonUploadText_61x22.png",				
		button_width: "61",
		button_height: "22",
		button_placeholder_id: "spanButtonPlaceHolder",
		// The event handler functions are defined in handlers.js
    file_queued_handler : fileQueued,
    file_queue_error_handler : fileQueueError,
		upload_start_handler : uploadStart,
		file_dialog_complete_handler : fileDialogComplete,			
		upload_success_handler : pickatt_uploadSuccess,			
    upload_error_handler : uploadError,
    upload_complete_handler : uploadComplete,
	};
	swfu = new SWFUpload(settings);	  
</script>
<div id="attachment_form" >
  <form id="form1" action="index.php" method="post" enctype="multipart/form-data">		  
    <div class='lh20P'>
      <span id="spanButtonPlaceHolder">Upload Attachment</span>      
      <span class='swfloadstatus dN fwB'>Uploading...</span>
      <input id="btnCancel" 
            type="button"
            value="Cancel All Uploads" onclick="swfu.cancelQueue();"
  	        disabled="disabled"
  	        style="display: none; margin-left: 2px; font-size: 8pt; height: 29px; " />
  	  <span class="ele_refresh flR csP radius4"><?php echo Yii::t('cp','Refresh') ?></span>
    </div>
    <div id="divStatus" class='dN' >0 Files Uploaded</div>
    <div class="fieldset flash dN" id="fsUploadProgress">
      <span class="legend">Upload Queue</span>
    </div>
  </form>  
</div>
