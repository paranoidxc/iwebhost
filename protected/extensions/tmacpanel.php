<?php
	class Tmacpanel extends CWidget {
		public function init() {
			$r=<<<EOT
	<div class='mac_panel_wrap'>
     <table class="mac_panel tree_mac_panel">
       <tr class="panel_top">
         <td class="left"></td>
         <td class="left_ct" >
           <span class="ct close">close</span>
           <span class="ct min">min</span>
           <span class="ct max">max</span>
           <span class="ct inactive">inactive</span>
         </td>
         <td class="middle drag_handle">
           <span class="title">xiaochuan Huang's vCard</span>
         </td>
         <td class="right_ct">
         		<span class="ct mb">panel</span>
         </td>
         <td class="right"></td>
       </tr>
      </table> 
EOT;
    echo $r;
		}	
		
		public function run() {
			$r = <<<EOT
    <table class="mac_panel tree_mac_panel">
       <tr class="panel_bottom">
         <td class="left"></td>
         <td class="middle">
           <span class="title">&copy; xiaochuang Huang 1985-‘10 </span>
         </td>
         <td class="right"></td>
       </tr>
      </table>
     </div>
EOT;
			echo $r;
		}
		
	}