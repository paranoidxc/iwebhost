<?php
	class Flatmacpanel extends CWidget {
	  public $title="Untitled";
	  
		public function init() {
			$r=<<<EOT
     <table class="mac_panel">
       <tr class="panel_top">
         <td class="left"></td>
         <td class="left_ct" >
           <span class="ct close">close</span>
           <span class="ct min">min</span>
           <span class="ct max">max</span>
         </td>
         <td class="middle drag_handle">
           <span class="title">$this->title</span></td>
         <td class="right"></td>
       </tr>
      </table>
    	<!-- mac panel middle start -->
     <table class="mac_panel" id="content">
       <tr class="panel_middle">
         <td class="left"></td>
         <td class="middle">        
EOT;
    echo $r;
		}	
		
		public function run() {
			$r = <<<EOT
			         </td>
         <td class="right"></td>
       </tr>
      </table>      
 <!-- mac panel bot
 tom start -->
     <table class="mac_panel">
       <tr class="flat_panel_bottom">
         <td class="left"></td>
         <td class="middle">           
         </td>
         <td class="right"></td>
       </tr>
      </table>
      <!-- mac panel bottom end -->
EOT;
			echo $r;
		}
		
	}