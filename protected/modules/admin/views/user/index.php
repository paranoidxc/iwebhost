<div class='mac_panel_wrap'>
  <?php  
    $this->beginWidget('application.extensions.Smacpanel',array('title'=>'Admins') );
  ?>
  <div class="iform">
    <div class="feedback">
  	</div>  
	  <div class="dN form_field_wrap extra_link_wrap">	  
	    <div class="clB"></div>
	  </div>
    <div class="taR h30P pr10P">  	
    </div> 
    <table>
      <tr>
        <th>Sid</th>
        <th>Account</th>
        <th>Password</th>
        <th>Email</th>
      </tr>
      <?php
      $admins = User::model()->findAll();
      foreach( $admins as $admins ) {
      ?>
      <tr>
        <td><?php echo $admins->id; ?></td>
        <td><?php echo $admins->username; ?></td>
        <td><?php echo $admins->password; ?></td>        
        <td><?php echo $admins->email; ?></td>
      </tr>
      <?php
      }
      ?>
    </table>
  </div>
  <div class="ajax_overlay" />    
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>