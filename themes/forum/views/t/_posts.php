 <?php
        foreach($posts as $post ){
      ?>
      <table class='reply_table w100S'>
          <tr class='w100S'>
            <th class='vaT p10P w20P'>
              <a href="<?php echo url('m/index', array('id' => $post->auther->username) )?> "
                title="<?php echo CHtml::encode($post->auther->username) ?>">
                <img width="40" src='<?php echo CHtml::encode($post->auther->gravatar) ?> ' 
                  alt='<?php echo CHtml::encode($post->auther->username) ?> ' />
              </a>
            </th>
            <td class='vaT pt10P'>
              <p class='ar_extra'>
                <strong>
                  <a href="<?php echo url('m/index', array( 'id' => $post->auther->username) ) ?>" 
                  class="radius2"><?php echo $post->auther->username?></a>
                </strong>      
                &nbsp;•&nbsp;         
                <span class='timeago' title='<?php echo CHtml::encode($post->c_time) ?>'>
                  <?php echo CHtml::encode($post->c_time) ?>
                </span>
                
              </p>
              <div class="clB ar_content pl5P">
                <?php echo $post->scontent ?>
              </div>
            </td>
          </tr>        
        </table>
        
        <div class='iline'></div>
      <?php
        }
      ?>

