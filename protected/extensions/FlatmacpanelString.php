<?php
	class FlatmacpanelString {
	  public static $title="Untitled";
	  public static $close;
	  public static $min;
	  public static $max;
	  
		public static function header() {
	  self::$close  = Yii::t('cp', 'Close');
	  self::$min    = Yii::t('cp', 'Min');
	  self::$max    = Yii::t('cp', 'Max');	
	  $that = new FlatmacpanelString;
		$r=<<<EOT
    <table class="mac_panel">
       <tr class="panel_top">
        <td class="left"></td> 
        <td class="middle drag_handle">
          <span class="title">$that->title</span>
        </td>
        <td class="left_ct" >
          <span class="ct close" title="$that->close"></span>
          <!--<span class="ct min" title="$that->min"></span>-->
          <span class="ct max" title="$that->max"></span>
        </td>
        <td class="right"></td>
      </tr>
    </table>
    	<!-- mac panel middle start -->
     <table class="mac_panel" id="content">
       <tr class="panel_middle">
         <td class="left"></td>
         <td class="middle">        
EOT;
    return $r;
	}	

	public static function footer() {
	$r = <<<EOT
	  </td>
      <td class="right"></td>
    </tr>
  </table>      
  <!-- mac panel bottom start -->
<table class="mac_panel">
  <tr class="flat_panel_bottom">
    <td class="left"></td>
    <td class="middle">&nbsp;</td>
    <td class="right"></td>
  </tr>
</table>
<!-- mac panel bottom end -->
EOT;
			return $r;
	}
}
?>