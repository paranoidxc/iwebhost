<script type="text/javascript">
	var swfu;		
	var settings = {
		flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/swfupload/swfupload.swf",
    upload_url: "<?php echo CController::createurl('attachment/upload',array( 'category_id' => 30 ) ) ?>",    
    button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
		post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
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
		file_dialog_complete_handler : fileDialogComplete,			
		upload_success_handler : pickatt_uploadSuccess,			
	};
	swfu = new SWFUpload(settings);	  
</script>
<div id="attachment_form" >
  <form id="form1" action="index.php" method="post" enctype="multipart/form-data">		  
    <div>
      <span id="spanButtonPlaceHolder">Upload Attachment</span>
      <input id="btnCancel" 
            type="button"
            value="Cancel All Uploads" onclick="swfu.cancelQueue();"
  	        disabled="disabled"
  	        style="display: none; margin-left: 2px; font-size: 8pt; height: 29px;" />
    </div>
    <div id="divStatus" class='dN' >0 Files Uploaded</div>
    <div class="fieldset flash dN" id="fsUploadProgress">
      <span class="legend">Upload Queue</span>
    </div>
  </form>  
</div>