<?php
	class Sidebarpanel extends CWidget {
		public function init() {
			$r=<<<EOT
			  <table class="mac_panel tree_mac_panel" id="content">
       <tr class="panel_middle">
         <td class="left">
          <div class="tree_div" >
EOT;
    echo $r;
		}	
		
		public function run() {
			$r = <<<EOT
			</div>
			</td>
      <td class="middle">
EOT;
			echo $r;
		}
		
	}