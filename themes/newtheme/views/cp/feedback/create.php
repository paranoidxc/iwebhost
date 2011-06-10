<div id="w_search" >
  <div class='w_left'>ihost console logo</div>
  <form action="<?php echo CController::createUrl('/cp/feedback/index') ?>" method="get" class="search_form">
    <input type="text" name="keyword" class=" search_input keyword"  value="<?php echo $keyword?>"/><input type="submit" value="submit" class='search_submit'/>
  </form>
</div>

<div id="w_middle">

  <div id="w_left">
    <?php echo $this->renderPartial( '_left' ) ?>
  </div>

    
  <div id="w_right">
    <div></div><!-- clear ele for fuck ie -->
    <div id="w_location" >
    Console<?php echo API::rchart();?><a href="<?php echo url('/cp/feedback/index') ?>" >feedback</a><?php echo API::rchart();?>Create
    </div>
    
    <div id="w_content">
      <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>

  </div>
</div>
