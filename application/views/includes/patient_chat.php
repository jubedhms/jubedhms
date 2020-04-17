<style>
/* The container */
.container2 {
    background-color: #2196f3;
    color: #fff;
    display: block;
    position: relative;
    padding-left: 35px;
    padding-right: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 15px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.container2 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #2196f3;
  border-radius: 50%;
}
.container2:hover input ~ .checkmark {
  /*background-color: #ccc;*/
}
.container2 input:checked ~ .checkmark {
  background-color: #2196F3;
}
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}
.container2 input:checked ~ .checkmark:after {
  display: block;
}
.container2 .checkmark:after {
 	top: 5px;
	left: 9px;
	width: 15px;
	height: 15px;
	border-radius: 50%;
	background: white;
}
.chatbox-messages .message p {
    max-width: 84% !important;
}
</style>
<?php if(!empty($msgg)){ foreach($msgg as $row){ if($row->is_support==0){ ?>
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
<?php } } if(!empty($question)){ ?>

<div class="message media reply">
                <div class="message-body media-body">
                    <p class="subparent" data-question="<?php echo $question->question_english; ?> <?php echo (isset($question2) && !empty($question2) )?$question2->question_english:'';  ?>" data-subparent="<?php echo $question->sub_parent; ?>" style="background-color: #713cff;border-radius: 4%;color: #fff;"><?php echo $question->question_english; ?></p>
                    <?php if(!empty($question2)){ ?>
                    <p  style="background-color: #713cff;border-radius: 4%;color: #fff;"><?php echo $question2->question_english; ?></p>
                    <?php } ?>
                        <?php if(!empty($option)){ ?>
                    <div class="col-md-8 option" style="display: inline-flex;">
                    <?php foreach($option as $row){ ?>
                        <label class="container2"><?php echo $row->question_english;  ?>
                        <input type="radio" name="radio" value="<?php echo $row->question_english;  ?>" class="check_mark">
                        <span class="checkmark"></span>
                        </label>&nbsp;&nbsp;
                        
                    <?php } } ?>
                    </div>

                </div>
                <div class="message-body media-body">
                    
                </div>
</div>
<?php } ?>

<?php  }else{ ?>
            <div class="message media reply">
                <div class="message-body media-body">
                    <p class="subparent" data-question="<?php echo $question->question_english; ?>" data-subparent="<?php echo $question->sub_parent; ?>"><?php echo $question->question_english; ?></p>
                    <div class="col-md-8 option" style="display: inline-flex;">
                        <label class="container2">Yes
                        <input type="radio" name="radio" value="Yes" class="check_mark">
                        <span class="checkmark"></span>
                        </label>&nbsp;&nbsp;
                        <label class="container2">No
                        <input type="radio" name="radio" value="No" class="check_mark">
                        <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="message-body media-body">
                    
                </div>
            </div>
  <?php }  ?>