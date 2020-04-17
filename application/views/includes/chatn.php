<?php if(!empty($msgg)){ foreach($msgg as $row){ if($row->is_support){ ?>
            <div class="message media">
                <div class="message-body media-body">
                    <p><?=$row->message; ?><br><span style="color: #c6ddff;"><?=isset($row->date)?$row->date.' '.$row->time:''; ?></span></p>
                </div>
            </div>
<?php }else{ ?>
            <div class="message media reply">
            <div class="message-body media-body">
                    <p><?=$row->message; ?><br><span style="color: #3988ff;"><?=isset($row->date)?$row->date.' '.$row->time:''; ?></span></p>
            </div>
            </div>
<?php } } }else{ ?>
            <div class="message media">
<!--                <div class="message-body media-body">
                    <p><?php //$question->question_english; ?></p>
                </div>-->
            </div>
  <?php }  ?>