<?php
	class Siderbarmain extends CWidget {
		public function init() {
			$r=<<<EOT
  <td class="middle">         	

         	<table style="width: 100%;">             
         		<tr>
         			<td>
EOT;
    echo $r;
		}	
		
		public function run() {
			$r = <<<EOT
			     			</td>
         		</tr>
         	</table>         	
         </td>
         <td class="right"></td>
       </tr>
      </table>
EOT;
			echo $r;
		}
		
	}