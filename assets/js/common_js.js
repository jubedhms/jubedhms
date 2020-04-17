function DateTime(str) {
        var month, day, year, hours, minutes, seconds;
        var date = new Date(str),
            month = ("0" + (date.getMonth() + 1)).slice(-2),
            day = ("0" + date.getDate()).slice(-2);
        hours = ("0" + date.getHours()).slice(-2);
        minutes = ("0" + date.getMinutes()).slice(-2);
        seconds = ("0" + date.getSeconds()).slice(-2);

        var mySQLDate = [date.getFullYear(), month, day].join("-");
        var mySQLTime = [hours, minutes, seconds].join(":");
        return [mySQLDate, mySQLTime].join(" ");
    }
	
$(".alert-dismissible").fadeTo(7000, 500).slideUp(1000, function(){
    $(".alert-dismissible").alert('close');
});
	
$(document).on('click', '.show_password', function(event) {
    var type = $('#password').attr('type');

    if (type === "password") {
        $('#password').attr('type','text');
		$('#confirm_password').attr('type','text');
    } else {
         $('#password').attr('type','password');
		 $('#confirm_password').attr('type','password');
    }
});

$(document).on('click', '#addRow', function(event) { 
	$('.pasteinDiv').append($(".copyDiv:last").clone());
    $('.pasteinDiv .copyDiv:last').find(".addIcon").html('');
	$('.pasteinDiv .copyDiv:last').find(".addIcon").html('<i class="fa fa-minus-circle fa-2x " aria-hidden="true" id="removeRow" title="Remove this row" style="color:#FF0000"></i>');  
	$(".copyDiv:last").find('input').val('');
	$(".copyDiv:last").find('select').val('');
	$(".copyDiv:last").find('textarea').val('');	
});

$(document).on('click','#removeRow',function(){
  if(confirm("Are you sure want to remove?")){
    var ql_id=$(this).attr('rel');
    $(this).parent().parent().remove(); 
  }
});

$(document).on('click', '.checkAllRows', function(event) {
    $( ".checkRows" ).not(this).prop('checked', this.checked); 
    $( ".checkRow" ).not(this).prop('checked', this.checked); 
   
    if($(this).is(':checked')== true){ 
        $(this).parent().find('.toggle').prop("title" ,"Deselect all");
        $('.check_rows').parent().find('.toggle').prop("title" ,"Deselect");
        $('.checkRow').parent().find('.toggle').prop("title" ,"Deselect");
    }else{ 
        $(this).parent().find('.toggle').prop("title" ,"Select all");
        $('.check_rows').parent().find('.toggle').prop("title" ,"Select");
        $('.checkRow').parent().find('.toggle').prop("title" ,"Select");
    }
});	

$(document).on('click', '.check_rows', function(event) { 
    if ($('.checkRows:checked').length !== $('.checkRows').length ){
        $("#checkAllRows")[0].checked = false;
        $('#checkAllRows').parent().find('.toggle').prop("title" ,"Select all");
    }else{
        $("#checkAllRows")[0].checked = true;
        $('#checkAllRows').parent().find('.toggle').prop("title" ,"Deselect all");
    }
    if($(this).is(':checked')== true){ 
        $(this).parent().find('.toggle').prop("title" ,"Deselect all");
        $('.checkRow').parent().find('.toggle').prop("title" ,"Deselect");
    }else{ 
        $(this).parent().find('.toggle').prop("title" ,"Select all");
        $('.checkRow').parent().find('.toggle').prop("title" ,"Select");
    }
});

$(document).on('click', '.checkRow', function(event) { 
    if ($('.checkRow:checked').length !== $('.checkRow').length ){
        $("#checkAllRows")[0].checked = false;
        $('#checkAllRows').parent().find('.toggle').prop("title" ,"Select all");
        $('.check_rows').parent().find('.toggle').prop("title" ,"Select all");
    }else{
        $("#checkAllRows")[0].checked = true;
        $('#checkAllRows').parent().find('.toggle').prop("title" ,"Deselect all");
        $('.check_rows').parent().find('.toggle').prop("title" ,"Deselect all");
    }
    if($(this).is(':checked')== true){ 
        $(this).parent().find('.toggle').prop("title" ,"Deselect");
    }else{ 
        $(this).parent().find('.toggle').prop("title" ,"Select");
    }
});

function copyToClipboard(element) {
  var $temp = $("<input>");
  var val=($(element).val()!='')?$(element).val():$(element).text();
  $("body").append($temp);
  $temp.val(val).select();
  document.execCommand("copy");
  $temp.remove();
}

// for all class in label 
$("input[required], select[required], textarea[required]").parent().find("label").addClass("required");
// end


//start open modal

$(document).on('click','.open_popup', function(){ 
   var data_url=$(this).data('url')?$(this).data('url'):'';
   var ths=$(this);
   if(data_url!=''){
        $.post(data_url,function(data){
        $('.modal_page_form').html('');
        $('.modal_page_form').html(data);
        });
        $("#modal_page").modal('show');
        if(ths.attr('is_view')=='1'){
            setTimeout(function(){$('input,select,textarea').attr('disabled',true);$('.submit').remove();},200);
        }
   }
})
//end

//bootbox.confirm 
var confirm_boot = function(title, message, callback) {
                            bootbox.confirm({
                                    title: title,
                                    message: message,
                                    buttons: {
                                        cancel: {
                                            label: '<i class="fa fa-times"></i> Cancel',
                                        },
                                        confirm: {
                                            label: '<i class="fa fa-check"></i> Confirm',
                                        }
                                    },
                                    callback: function(result) {
                                        callback(result);
                                    }
                                });

                            }       


