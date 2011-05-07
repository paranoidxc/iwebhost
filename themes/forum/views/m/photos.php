<?php $this->renderPartial('_photos', array('photos' => $photos, 
      'pagination'=>$pagination,'select_pagination' => $select_pagination) ); ?>

<div class="bgTips p5P">
  <?php $this->renderPartial('_upload'); ?>
</div>
<div class='clB'></div>
