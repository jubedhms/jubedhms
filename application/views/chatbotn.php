<?=$header;?>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
<!--	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"> discription about page</p>
		</div>
		<div class="page-title-right d-none d-sm-inline-flex">
			<span>

			</span>
		</div>
	</div>-->
            <div class="widget-list">
                <div class="row no-gutters">
                    <div class="col-md-12 widget-holder widget-full-content border-all mb-3">
                        <div class="widget-bg">
                            <div class="widget-body clearfix">
                                <div class="chatbox row no-gutters" style="height: 90vh">
                                    <div class="chatbox-user-list col-sm-4 border-right bw-r-0-rtl border-left-rtl">
                                        <div class="chatbox-header">
                                            <div class="icon-box icon-box-side icon-box-circle icon-box-outline icon-box-lg align-items-center">
                                                <header><a href="#" class="bw-1"><i class="feather feather-user fs-20"></i></a>
                                                </header>
                                                <section>
                                                    <h6 class="icon-box-title mb-1">Chat List</h6>
                                                    <!--<p class="text-muted heading-font-family">376 Conversions</p>-->
                                                    <span class="chatbotPatient"></span>
                                                </section>
                                            </div>
                                            <!-- /.icon-box -->
                                        </div>
                                        <!-- /.chatbox-header -->
                                        <div class="chatbox-search px-3 mt-4">
                                            <form>
                                                <div class="form-group"><i class="feather feather-search pos-absolute pos-right vertical-center pr-4"></i> 
                                                    <input type="search" placeholder="Search for friends.." class="form-control form-control-rounded heading-font-family fs-12 pr-5 pl-3 searchPatientN">
                                                </div>
                                                <!-- /.form-group -->
                                            </form>
                                        </div>
                                        <!-- /.chatbox-search -->
                                        <div class="chatbox-body scrollbar-enabled pr-0">
                                            <div class="user-list all_userList">
                                                <div class="user-list-single">
                                                    <div class="row">
                                                        <div class="media align-items-center col-8">
                                                            <figure class="thumb-xs2 mr-3 mr-0-rtl ml-3-rtl user--online">
                                                                <img src="http://localhost/hms/data/user-profile-image/2019/12/19121112122434_1024.jpg" class="rounded-circle" alt="User 1">
                                                            </figure>
                                                            <div class="media-body overflow-hidden">
                                                                <p class="user-name mb-0 heading-font-family fw-400">Nick Lampard</p><small class="text-nowrap heading-font-family fw-400">Hi, I am going to Scotland something that we don't understand</small>
                                                            </div>
                                                            <a href="#" class="pos-absolute pos-0 zi-1"></a>
                                                        </div>
                                                        <!-- /.col-8 -->
                                                        <div class="col-4">
                                                            <div class="d-flex flex-column">
                                                                <div class="text-right text-left-rtl"><span class="badge bg-success-contrast color-success">3</span>
                                                                    <div class="dropdown d-inline-block">
                                                                        <button class="btn btn-link btn-link dropdown-toggle p-0 color-content-color d-inline-block" data-toggle="dropdown"><i class="feather feather-more-horizontal"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a>  <a class="dropdown-item" href="#">Another Action</a>  <a class="dropdown-item" href="#">Something else here</a>
                                                                        </div>
                                                                        <!-- /.dropdown-menu -->
                                                                    </div>
                                                                    <!-- /.dropdown -->
                                                                </div><small class="heading-font-family fs-10 text-right text-left-rtl">5 min</small>
                                                            </div>
                                                            <!-- /.d-flex -->
                                                        </div>
                                                        <!-- /.col-4 -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                
                                                
                                            </div>
                                            <!-- /.user-list -->
                                        </div>
                                        <!-- /.chatbox-body -->
                                    </div>
                                    <!-- /.col-sm-4 -->
                                    <div class="chatbox-chat-area col-sm-8">
                                        <div class="chatbox-header d-flex align-items-center px-4 border-bottom">
                                            <div class="media align-items-center mr-tb-30 flex-1" style="display:none;">
                                                <figure class="thumb-xs2 mr-3 mr-0-rtl ml-3-rtl"><!-- user--online -->
                                                    <a href="#">
                                                        <img class="rounded-circle imageChange" src="<?=base_url(); ?>data/patient-profile-image/patient_default.png" alt="user Image">
                                                    </a>
                                                </figure>
                                                <div class="media-body">
                                                    <h6 class="mt-0 mb-1 user-nameN">User</h6>
                                                    <!--<p class="text-muted heading-font-family mb-0">Online</p>-->
                                                </div>
                                                <!-- /.media-body -->
                                            </div>
                                            
                                         <!--    <div class="dropdown"><a href="#" class="btn btn-circle btn-outline-default fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Action</a>  <a href="#" class="dropdown-item">Another Action</a>  <a href="#" class="dropdown-item">Something else here</a>
                                                </div>
											</div>-->
                                        <!-- /.dropdown -->
                                    </div>
                                    <!-- /.chatbox-header -->
                                    <div class="chatbox-body scrollbar-enabled scroll-to-bottom" id="messagesDivN" style="max-height: 100%">
                                        <div class="chatbox-messages">
                                           
                                        </div>
                                    </div>
                                    <form class="chatbox-form p-3 border-top d-flex align-items-center pos-relative hidden" action="#" method="post">
<!--                                    <button type="button" class="btn btn-circle btn-outline-default bw-1"><i class="feather feather-plus"></i>
                                    </button>-->
                                    <div class="form-group flex-1 mb-0 ml-3">
                                    <?php if(checkModulePermission($MODULEID,'add_btn') || checkModulePermission($MODULEID,'edit_btn')){ ?>
                                     <input type="hidden" value="" class="patient_idN">
                                     <input type="hidden" value="" class="updatemessage">
                                            <!--<input type="hidden" value="" class="patient_name">-->
                                            <input type="hidden" value="" class="patient_usernameN">
                                            <textarea class="form-control form-control-rounded pd-r-90 replymessageN" rows="1" style="resize: none" placeholder="Type your message here"></textarea>
                                    <?php } ?>
                                    </div>
                                    <!-- /.form-group -->
                                    <button type="button" class="btn btn-rounded btn-primary pos-absolute pos-right vertical-center border-hidden mr-3 replyChatN"><i class="feather feather-arrow-right list-icon fs-26 text-success"></i></button>
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
    
    //Reply to patient
$(document).on('click','.replyChatN',function(){
    if(!$('.replymessageN').val()){
        $('.replymessageN').focus();
    }else{
    var msg=$('.replymessageN').val();
    if(msg.length >0){
    $.post(BASE_URL+'chatn/revert_from_support',{message:msg,name:$('.patient_nameN').val(),username:$('.patient_usernameN').val()},function(data){
        $('.chatbox-messages').html('');
        $('.chatbox-messages').html(data);
        $('.replymessageN').val('');
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
    
    //Chat for each patient.
$(document).on('click','.patientChatN',function(){
    //alert($(this).attr('uniqueid'));
    $('.chatbox-header .media').show();
    $('.patient_idN').val($(this).data('patientidn'));
    $('.user-nameN').text($(this).data('namen'));
    $('.updatemessage').val($(this).attr('id'));
    $('.imageChange').attr('src','');
    $('.imageChange').attr('src',$(this).data('userimage'));
    $('.patient_usernameN').val($(this).data('usernamen'));
    $.post(BASE_URL+'chatn/openChat',{username:$(this).data('usernamen')},function(data){
        $('.chatbox-messages').html('');
         var window_height=$(window.top).height();
        if(window_height!=''){
            var replydiv_height=parseInt(window_height-105);
           
            $('.chatbox-chat-area').css('max-height',replydiv_height+"px");
        }
        
        $('.chatbox-messages').html(data);
        $('.chatbox-form').removeClass('hidden');
        var objDivN2=document.getElementById("messagesDivN");
        objDivN2.scrollTop=objDivN2.scrollHeight;
    });
    // To get the height of the window-100.The height of the this class
   
    // end
    
});
//end    
    
$(".chatbotPatient").on("click",function() {
    $.post(BASE_URL+'chatn/getAllPatient',function(data){
    if(data){
        var pdt=JSON.parse(data);
        var htmlPatient='';
        for(var i=0;i<pdt.patients.length;i++){
            var notification=(pdt.patients[i].notification)?parseInt(pdt.patients[i].notification):'';
            //var style=(notification)?'style="border-radius: 100%;border: 1px solid #f00;color: #ffffff;background-color: #f00;"':'';
            var is_online=(pdt.patients[i].minute<=2)?'user--online':'user--offline';
            var defaultIMG=(pdt.patients[i].image!='')?pdt.patients[i].image:'data/patient-profile-image/patient_default.png';
            //(pdt.patients[i].image=='')?defaultIMG:pdt.patients[i].image
        htmlPatient +='<div class="user-list-single patientChatN" id="patientuser'+i+'" data-userimage="<?=base_url() ?>'+defaultIMG+'" data-namen="'+pdt.patients[i].first_name+" "+pdt.patients[i].middle_name+" "+pdt.patients[i].last_name+'" data-usernamen="'+pdt.patients[i].username+'" data-patientidn="'+pdt.patients[i].ID+'" data-chat-usern="'+pdt.patients[i].first_name+" "+pdt.patients[i].middle_name+" "+pdt.patients[i].last_name+'"><div class="row"><div class="media align-items-center col-8"><figure class="thumb-xs2 mr-3 mr-0-rtl ml-3-rtl '+is_online+'"><img src="<?=base_url() ?>'+defaultIMG+'" class="rounded-circle" alt="User"></figure><div class="media-body overflow-hidden"><p class="user-name mb-0 heading-font-family fw-400">'+pdt.patients[i].first_name+" "+pdt.patients[i].middle_name+" "+pdt.patients[i].last_name+'</p><small class="text-nowrap heading-font-family fw-400">@'+pdt.patients[i].username+'</small></div><a href="javascript:void(0);" class="pos-absolute pos-0 zi-1"></a></div><div class="col-4"><div class="d-flex flex-column"><div class="text-right text-left-rtl"><span class="badge bg-success-contrast color-success">'+notification+'</span></div><small class="heading-font-family fs-10 text-right text-left-rtl"></small></div></div></div></div>';
    }
            $('.all_userList').html('');
            $('.all_userList').html(htmlPatient);
    }
   });
});


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
    setInterval(function(){
        $('.chatbotPatient').trigger('click');
        var userdynamicid=$('.updatemessage').val();
        if($('.updatemessage').val()!=''){
        //console.log(userdynamicid);
        $("#"+userdynamicid).trigger('click');
    }
        
    },2000);
    $('.chatbotPatient').trigger('click');
    
    setInterval(function(){location.reload();},600000);
});
</script>
<!--Start footer-->
<?=$footer;?>
<!--End footer-->