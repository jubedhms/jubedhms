<?=$header;?>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
            <div class="widget-list">
                <div class="row no-gutters">
                    <div class="col-md-12 widget-holder widget-full-content border-all mb-3">
                        <div class="widget-bg">
                            <div class="widget-body clearfix">
                                <div class="chatbox row no-gutters" style="height: 90vh">
                                    
                                    <div class="chatbox-chat-area col-sm-12">
                                        <div class="chatbox-header d-flex align-items-center px-4 border-bottom">
                                            <div class="media align-items-center mr-tb-30 flex-1">
                                                <span class="openChat"></span>
                                                <figure class="thumb-xs2 mr-3 mr-0-rtl ml-3-rtl"><!-- user--online -->
                                                    <a href="#">
                                                        <img class="rounded-circle imageChange" src="<?=base_url(); ?>data/patient-profile-image/patient_default.png" alt="user Image">
                                                    </a>
                                                </figure>
                                                <div class="media-body">
                                                    <h6 class="mt-0 mb-1 user-nameN"><?php echo $details->first_name. ' '.$details->last_name; ?></h6>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="chatbox-body scrollbar-enabled scroll-to-bottom" id="messagesDivN" style="max-height: 100%">
                                        <div class="chatbox-messages">
                                           
                                        </div>
                                    </div>
                                    <form class="chatbox-form p-3 border-top d-flex align-items-center pos-relative" action="#" method="post">
<!--                                    <button type="button" class="btn btn-circle btn-outline-default bw-1"><i class="feather feather-plus"></i>
                                    </button>-->
                                    <div class="form-group flex-1 mb-0 ml-3">
                                        <input type="hidden" value="<?php echo $details->ID; ?>" class="patient_idN">
                                        <input type="hidden" value="<?php echo $details->first_name. ' '.$details->last_name; ?>" class="patient_nameN">
                                        <input type="hidden" value="<?php echo $details->username; ?>" class="patient_usernameN">
                                        <textarea class="form-control form-control-rounded pd-r-90 replymessageN hidden" rows="1" style="resize: none" placeholder="Type your message here"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-rounded btn-primary pos-absolute pos-right vertical-center border-hidden mr-3 replyChatN hidden"><i class="feather feather-arrow-right list-icon fs-26 text-success"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
    </main>
<script>
    //Yes and no option type check_mark action
    $(document).on('click','.check_mark',function(){
        var subparent=($('.subparent').data('subparent'))?$('.subparent').data('subparent'):'';
        if($(this).val()){
            $.post(BASE_URL+'chat_patientn/chatBotOption',{message:$(this).val(),question:$('.subparent').data('question'),subparent:subparent,name:$('.patient_nameN').val(),username:$('.patient_usernameN').val()},function(data){
                if(data){
                    $(".openChat").trigger('click');
                }else{
                }
            });
        }
    })
//Chat for each patient.
$(document).on('click','.openChat',function(){
    $.post(BASE_URL+'chat_patientn/openChat',{username:$(".patient_usernameN").val()},function(data){
        $('.chatbox-messages').html('');
         var window_height=$(window.top).height();
        if(window_height!=''){
            var replydiv_height=parseInt(window_height-105);
            $('.chatbox-chat-area').css('max-height',replydiv_height+"px");
        }
        $('.chatbox-messages').html(data);
        $('.replyChatN, .replymessageN').removeClass('hidden');
        
        $('.chatbox-form').removeClass('hidden');
        var objDivN2=document.getElementById("messagesDivN");
        objDivN2.scrollTop=objDivN2.scrollHeight;
    });
});
//end
//Reply to patient
$(document).on('click','.replyChatN',function(){
    var subparent=($('.subparent').data('subparent'))?$('.subparent').data('subparent'):'';
    var question=($('.subparent').data('question'))?$('.subparent').data('question'):'';
	var datetime_question=($('.subparent').data('datetime_question'))?$('.subparent').data('datetime_question'):'';
    if(!$('.replymessageN').val()){
        $('.replymessageN').focus();
    }else{
    var msg=$('.replymessageN').val();
    if(msg.length >0){
    $.post(BASE_URL+'chat_patientn/revert_from_patient',{message:msg,datetime_question:datetime_question,subparent:subparent,question:question,name:$('.patient_nameN').val(),username:$('.patient_usernameN').val()},function(data){
        $('.replymessageN').val('');
        $('.chatbox-messages').html('');
        $('.chatbox-messages').html(data);
        
        $('.replymessageN').focus();
        var objDivN=document.getElementById("messagesDivN");
        objDivN.scrollTop=objDivN.scrollHeight;
    });
    }
}
$('.messages').scrollTop();
})
//End
    
  
//return true only for the enter button click
document.onkeydown = function (evt) {
    var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
    if (keyCode == 13) {
    $('.replyChatN').trigger('click');
}};
//End  

//Search the patient in the chat bot
$(document).ready(function(){
    $(".searchPatientN").keyup(function(){
    var filter = $(this).val();
    $(".all_userList").find('p').each(function(){
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).closest('.row').fadeOut();
        } else {
            $(this).closest('.row').show();
        }
    });
});
});
//End

$(function(){
    $(".openChat").trigger('click');
    setInterval(function(){
        if($('.updatemessage').val()!=''){
        $(".openChat").trigger('click');
    }
    },2000);
    $('.chatbotPatient').trigger('click');
    
    setInterval(function(){location.reload();},600000);
});
</script>
<!--Start footer-->
<?=$footer;?>
<!--End footer-->