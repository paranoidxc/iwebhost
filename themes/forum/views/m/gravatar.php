<div class="index_articles_wrap">  
  <table style="width: 100%">
    <tr>
      <td class="author_warp pt20P">
        <a href="#">
          <img src="<?php echo $user->gravatar ?>" alt="<?php echo $user->username ?>" />
        </a>
      </td>
      <td class="w20P ar_arrow t_ar_arrow">&nbsp;</td>
      <td class="boxshadow ar_content_wrap newest-node">
        <div class="radius5top">
          <h1 class="raidus5top panel-title">	  
            <a href="/" class="radius2"><?php echo Yii::app()->name ?></a>
	          &raquo;&nbsp;
            <a href="<?php echo url('m/setting')?>">资料设置</a>
	          &raquo;&nbsp;
            截取头像
          </h1>  
          <div class='iline'></div>    
          <?php
            if( $user->isUploadGravatar ) {
          ?>
            <div style="padding-left: 10px">
              <p class="mt10P mb5P fs16P fwB">头像原始图片</p>
              <p class="taC">
                <img src="<?php echo $user->sourcegravatar ?>" alt="" id="cropbox"/>
              </p>
              
              <p class="mt10P mb5P"><strong>80*80 缩略图</strong></p>
              <div style="width:80px;height:80px; overflow:hidden; ">
                <img src="<?php echo $user->sourcegravatar; ?>" id="cropbox_preview"
                style=""/>
		          </div>
              
              <form action="<?php echo url('m/gravatar') ?>" method="post" 
              onsubmit="return checkCoords();" class="mb10P">
                <input type="hidden" id="x" name="x" />
          			<input type="hidden" id="y" name="y" />
			          <input type="hidden" id="w" name="w" />
          			<input type="hidden" id="h" name="h" />
          			<input type="submit" value="截取图片" />
		          </form>

            </div>
          <?php
            }else{
          ?>
          <?php
            }
          ?>
          </div>
      </td>
    </tr>
  </table>
</div>
