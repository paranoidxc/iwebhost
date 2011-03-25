<div class="iform radius5 boxshadow newest-node " >
  <h1 class='raidus5top panel-title' >
    <a href="/" class="radius2" ><?php echo Yii::app()->name ?></a>&raquo;&nbsp;    
    哎呀,出错啦
  </h1>
  <div class='p10P note'>
    <h2>Error <?php echo $code; ?>: oh noes, there's nothing in here</h2>
    <div class="error mt5P">
      <?php echo CHtml::encode($message); ?>
    </div>
  </div>
</div>