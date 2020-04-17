// Open user list for chat
$(".right-sidebar-toggle").on("click",function(e) {
    $.post(BASE_URL+'chat/getAllPatient',function(data){
    if(data){
       var pdt=JSON.parse(data);
       var htmlPatient='';
       for(var i=0;i<pdt.patients.length;i++){
           var notification=(pdt.patients[i].notification)?parseInt(pdt.patients[i].notification):'';
           var style=(notification)?'style="border-radius: 100%;border: 1px solid #f00;color: #ffffff;background-color: #f00;"':'';
           var is_online=(pdt.patients[i].minute<=2)?'user--online':'user--offline';
           
        htmlPatient +='<a href="javascript:void(0)" class="list-group-item patientChat" data-name="'+pdt.patients[i].first_name+" "+pdt.patients[i].middle_name+" "+pdt.patients[i].last_name+'" data-username="'+pdt.patients[i].username+'" data-patientid="'+pdt.patients[i].ID+'" data-chat-user="'+pdt.patients[i].first_name+" "+pdt.patients[i].middle_name+" "+pdt.patients[i].last_name+'"><figure class="thumb-xs '+is_online+' mr-3 mr-0-rtl ml-3-rtl"><img src="<?=base_url()?>assets/demo/users/user2.jpg" class="rounded-circle" alt=""></figure><span><span class="name">'+pdt.patients[i].first_name+" "+pdt.patients[i].middle_name+" "+pdt.patients[i].last_name+' &nbsp;<span '+style+'> '+notification+'</span></span>  <span class="username">@'+pdt.patients[i].username+'</span> </span></a>';
    }
            $('.all_parient').html('');
            $('.all_parient').html(htmlPatient);
    }
   });
});
// end


        
        
//Chat for each patient.
$(document).on('click','.patientChat',function(){
    $('.chat-panel').removeAttr('hidden');
    $('.patient_id').val($(this).data('patientid'));
    $('.user-name').text($(this).data('name'));
    $('.patient_username').val($(this).data('username'));
    $.post(BASE_URL+'chat/openChat',{username:$(this).data('username')},function(data){
        $('.messages').html('');
        $('.messages').html(data);
        var objDiv2=document.getElementById("messagesDiv");
        objDiv2.scrollTop=objDiv2.scrollHeight;
    });
    
});
//End

//Reply to patient
$(document).on('click','.replyChat',function(){
    if(!$('.replymessage').val()){
        $('.replymessage').focus();
    }else{
    //alert($(this).data('patientid'));
    //alert($('.replymessage').val());
    var msg=$('.replymessage').val();
    $.post(BASE_URL+'chat/revert_from_support',{message:msg,name:$('.patient_name').val(),username:$('.patient_username').val()},function(data){
        $('.messages').html('');
        $('.messages').html(data);
        $('.replymessage').val('');
        var objDiv=document.getElementById("messagesDiv");
        objDiv.scrollTop=objDiv.scrollHeight;
        $(".right-sidebar-toggle").trigger('click');
        $(".right-sidebar-toggle").trigger('click');
    });
    if(msg=='Yes'){
//                    $.post(BASE_URL+'chat/getquestion',{ID:$('.patient_id').val(),message:msg,name:$('.patient_name').val()},function(data){
//                    $('.messages').html('');
//                    $('.messages').html(data);
//                    $('.replymessage').val('');
//                });
    }else if(msg=='No'){
//                    $.post(BASE_URL+'chat/replyChat',{ID:$('.patient_id').val(),message:msg,name:$('.patient_name').val()},function(data){
//                    $('.messages').html('');
//                    $('.messages').html(data);
//                    $('.replymessage').val('');
//                });
    }

}
$('.messages').scrollTop();
})
//End

//return true only for the enter button click
document.onkeydown = function (evt) {
var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
if (keyCode == 13) {
$('.replyChat').trigger('click');
}};
//End


//Search the patient in the chat bot
$(document).ready(function(){
    $(".searchPatient").keyup(function(){
        var filter = $(this).val();
        $(".all_parient a").each(function(){
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
            }
        });
    });
});
//End