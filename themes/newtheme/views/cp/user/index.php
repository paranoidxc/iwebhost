<?php echo $this->renderPartial( '_search',array('keyword' => $keyword),false,true) ?>

<div id="w_middle">

  <div id="w_left">
    <?php echo $this->renderPartial( '_left' ) ?>
  </div>

  <div id="w_right">
    <div></div>
    <div id="w_location">
      Console<?php echo API::rchart() ;?><a href="<?php echo url('cp/user/index') ?>" >User</a><?php echo API::rchart();?>Index
     </div>

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


    <form action="<?php echo url('cp/user/batch') ?>" method="post" >
    <div id="w_action">
      <div class='pl20P pt3P' >
        <input type="submit" value="删除" name="delete" />
      </div>
      <div class='flR pr20P' style="margin-top: -28px;">
      <?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?>
      </div>
    </div>

    <div id="w_content">
      <table class='list'>
        <thead>
          <tr>
            <th class='vaM w20P taC pr2P pl2P'><input type='checkbox' class="item-all" /></th>
            <th class='w80P taC'><?php echo Yii::t('cp','Sid') ?></th>
            <th class='w160P taL'><span class="radius4 filter"><?php echo Yii::t('cp','Account') ?></span></th>
            <th class='w160P taL'><?php echo Yii::t('cp','Password') ?></th>
            <th class='taL' ><span class="radius4 filter"><?php echo Yii::t('cp','Email') ?></span></th>
          </tr>
        </thead>      

        <tbody class="">
        <?php  
          foreach( $list as $user ) {
        ?>
          <tr>
            <td class='vaM w20P taC pr2P pl2P'><input type='checkbox' name="ids[]" value="<?php echo $user->id; ?>" class="item-sep" /></td>
            <td class='w80P taC'><?php echo $user->id; ?></td>
            <td class="w160P vaM  content_item">
            <?php 
            if( $user->is_forever ) {
              echo '<span class="forever" title="can\'t be delete">*';        
              echo '</span>';
            }
            ?>
            <a href="<?php echo CController::createUrl('user/update', array('id'=> $user->id) );
            ?>"><?php echo $user->username;?></a>
            </td>
            <td class='w160P taL'><?php echo $user->password; ?></td>        
            <td class='taL' ><?php echo $user->email; ?></td>
          </tr>
        <?php
        }
        ?>
        </tbody> 
        <?php 
          if( $pagination ){
        ?>
        <tfoot>
          <tr class="hover_none">
            <td colspan="5" class='taR ipagination  p5P pr20P'><?php $pagination->run() ?>&nbsp;<?php $select_pagination->run() ?></td>
          </tr>
        </tfoot>
        <?php 
        }
        ?>
      </table>
    </div>

    </form>

  </div>
</div>
