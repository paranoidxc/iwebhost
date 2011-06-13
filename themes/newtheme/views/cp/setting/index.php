<div id="w_search" class="h30P">
</div>

<div id="w_middle">

  <div id="w_left"> 
    <?php echo $this->renderPartial( '_left' ) ?>
  </div>

  <div id="w_right">
    <div></div>
    <div id="w_location"></div>

    <?php if(Yii::app()->user->hasFlash('success')) {?>
    <div class="flash_suc">
      <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php } ?>
    <?php if(Yii::app()->user->hasFlash('error')) {?>
    <div class="error">
      <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
    <?php } ?>

    <?php echo $this->renderPartial('_sconfig', array('sconfig'=>$sconfig)); ?>

   </div>
</div>
