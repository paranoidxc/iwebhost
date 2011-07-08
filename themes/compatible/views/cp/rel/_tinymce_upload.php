<script type="text/javascript">
	var swfu;		
	var settings = {		
		flash_url : "<?php echo API::get_theme_baseurl(); ?>/swfupload/swfupload.swf",
    upload_url: "<?php echo CController::createurl('attachment/upload',array( 'category_id' => '30' ) ) ?>",
    button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
		custom_settings : {
				progressTarget : "fsUploadProgress",
				cancelButtonId : "ibtnCancel"
			},
		debug: false,
		// Button settings
		button_image_url: "/default_image/swf_upload_bg.jpg",				
		button_width: "110",
		button_height: "32",
		button_placeholder_id: "spanButtonPlaceHolder",
		// The event handler functions are defined in handlers.js
	  upload_start_handler : pickimage_uploadStart,
		upload_success_handler : uploadSuccess,			
    upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_complete_handler : uploadComplete,
    file_queued_handler : fileQueued,
    file_dialog_complete_handler : fileDialogComplete,			
	  file_queue_error_handler : fileQueueError,
    queue_complete_handler : pickimage_queueComplete,
	}
  swfu = new SWFUpload(settings);	  
</script>

<div id="" >
  <form id="form1" action="index.php" method="post" enctype="multipart/form-data">		  
    <div class='lh32P'>
      <span id="spanButtonPlaceHolder">本地上载</span>      
      <input id="ibtnCancel" 
            type="button"
            value="<?php echo Yii::t('cp','Cancel All Uploads') ?>" onclick="swfu.cancelQueue();"
            disabled="disabled" />
      <span class='swfloadstatus fwB dN'>上载中...</span>
  	  <span class="ele_refresh flR csP radius4"><?php echo Yii::t('cp','Refresh') ?></span>
    </div>
    <div id="divStatus" class='dN' >0 Files Uploaded</div>
    <div class="fieldset flash dN" id="fsUploadProgress">
      <span class="legend dN">Upload Queue</span>
    </div>
  </form>  
</div>
