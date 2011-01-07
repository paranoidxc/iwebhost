<div class='w400p'>
  <?php
    $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>'Messages'));
    
  ?>  
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>

<div class='w400p'>
  <?php
    $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>'Page view'));
  ?>
  111
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>

<div class='w400p'>
  <?php
    $this->beginWidget('application.extensions.Flatmacpanel',array('title'=>'Environment info'));
  ?>
  <ul>
    <li>PHP version: <?php echo API::php_version(); ?></li>
    <li>server_info : <?php echo API::server_info(); ?></li>
    <li>server_info : <?php echo API::server_signature(); ?></li>
    
    
  </ul>
  <?php
    $this->endWidget('application.extensions.Flatmacpanel');	 
  ?>
</div>