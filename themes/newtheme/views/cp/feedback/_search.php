<div id="w_search" >
  <div class='w_left'>ihost console logo</div>
  <form action="<?php echo CController::createUrl('feedback/index') ?>" method="get" class="search_form">
    <input type="hidden" id="is_hide_adv" name="is_hide_adv" value="<?php echo $this->tpl_params['is_hide_adv']; ?>" />   
    <input type="hidden" name="is_answer" value="<?php echo $this->tpl_params['is_answer']; ?>" />
    <input type="text" name="keyword" class=" search_input keyword"  value="<?php echo $keyword?>"/> 
    <input type="submit" value="submit" class='search_submit'/>
    <span class='csP toggle_w_adv_search'>高级</span>
      <div class='mt5P ml240P dN w_adv_search'>
        <table class='w100S'>
          <tr>
            <th class='w100P taL'>序号:</th>
            <td>
            <input type="text" class='itext w100P' name='id_start'
              value="<?php echo $this->tpl_params['id_start'] ?>" />
            -
            <input type="text" class='itext w100P' name="id_end"  
              value="<?php echo $this->tpl_params['id_end']?>"/> </td>
          </tr>
          <tr>
            <th class='taL'>反馈时间:</th>
            <td><input type="text" class='itext w100P' /> - <input type="text" class='itext w100P' /> </td>
          </tr>
          <tr>
            <th class='taL'>回复时间:</th>
            <td><input type="text" class='itext w100P' /> - <input type="text" class='itext w100P' /> </td>
          </tr>
 
        </table>
      </div>

  </form>
</div>
