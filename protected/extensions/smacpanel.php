<?php
	class Smacpanel extends CWidget {
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
           <span class="title">xiaochuan Huang's vCard</span></td>
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
 <!-- mac panel bottom start -->
     <table class="mac_panel">
       <tr class="panel_bottom">
         <td class="left"></td>
         <td class="middle">
           <span class="title">&copy; xiaochuang Huang 1985-‘10 </span>
         </td>
         <td class="right"></td>
       </tr>
      </table>
      <!-- mac panel bottom end -->
EOT;
			echo $r;
		}
		
	}