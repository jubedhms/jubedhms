<?=$header;?>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
		  <div class="page-title-right d-none d-sm-inline-flex">
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
			<!--<a href="<?php //base_url('doctor/addedit_doctor');?>" class="btn btn-info btn-sm"><?php //echo 'New Doctor'; ?></a>-->
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<!--<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?= base_url('doctor/deleteData');?>" title="Delete selected rows">Delete Selected</a>-->
			<?php }?>
			</span>
		</div> 
	</div>
	<div class="widget-list">
	<div class="col-md-12 widget-holder">
            <div class="row m-0">
                <div class="col-xm-12 col-sm-12 col-md-1 col-lg-1">
                     <!--<label for="speciality"></label>
                     <div class="form-group" style="font-size: 18px;text-align: right;top: 11px;">Search:</div>-->
                </div>
                <div class="col-xm-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="speciality">Select Specialty</label>
                        <select class="form-control specialty" id="speciality" name="speciality">
						<option value="">All</option>
                                <?php 
                                if($doctor_specialization && count($doctor_specialization)>0){
                                    foreach($doctor_specialization as $specialty){
                                ?>
                                <option value="<?=$specialty->code;?>"><?=$specialty->name;?></option>
                                <?php } }?>
                        </select>
                    </div>
                </div>
                <div class="col-xm-12 col-sm-12 col-md-2 col-lg-2">
                </div>
                <div class="col-xm-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="view_type">Select View Type</label>
                        <select class="form-control select2" name="view_type">
                                <option value="1">List View</option>
                                <option value="2">Grid View</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
            <div class="loaderajax" style="text-align: center;display: none;">
                    <img src="<?php base_url(); ?>assets/img/Ajax-loader.gif" style="width: 150px;">
            </div>
            <!-- <div class="row gridSearch" style="display:none;">
            <div class="col-lg-8">
                     <div class="form-group" style="font-size: 18px;text-align: right;"></div>
            </div>
            <div class="col-lg-4">
                        <div class="form-input-icon"><i class="material-icons list-icon">search</i> 
                            <input class="form-control gridviewSearch" placeholder="Searching..." type="text">
                        </div>
            </div>
            </div> -->
            <div class="row gridSearch">
                <div class="col-lg-1">
                </div>
            <div class="col-lg-9">
                <div class="form-input-icon"><i class="material-icons list-icon">search</i> 
                            <input class="form-control gridviewSearch" placeholder="Searching..." type="text">
                </div>
                     
            </div>
            <div class="col-lg-2">
                <button class="btn btn-sm btn-info gridviewSearchbtn" style="height: 40px;width: 90px;">Search</button>
                        <div class="form-group" style="font-size: 18px;text-align: right;"></div>
            </div>
            </div>
            <div class='view_doctor_data'>
                
            </div>
            
	</div>

</main>
<!-- /.main-wrappper -->	
<!-- end page-->		
<div class="modal fade" id="modal_page" data-keyboard='false' data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body modal_page_form"></div>
          </div>
        </div>
</div>
<script>
$('body').on('hidden.bs.modal', '.modal', function () {
    $(this).find('form').trigger('reset');
});
$(document).on('click','.open_popup_avalability', function(){ 
    var doctor_name='';
    if($(this).closest('tr').find('.doctor_name').text()){
        doctor_name=$(this).closest('tr').find('.doctor_name').text();
    }else{
        doctor_name=$(this).closest('section').find('.doctor_name').text();
    }
   var data_url=$(this).data('url')?$(this).data('url'):'';
   var ths=$(this);
   if(data_url!=''){
        $.post(data_url,function(data){
        $('.modal_page_form').html('');
        $('.modal_page_form').html(data);
        $('.doctorName').text(doctor_name);
        });
        $("#modal_page").modal('show');
   }
})
</script>
<!--Start footer-->
<?=$footer;?>
<!--End footer-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $(document).on("blur",'.clockpicker',function(event){
        event.preventDefault();
        var savethis=$(this);
        var pickdate=$('input[name="date"]').val().split('-');
        var datepicked=pickdate[2]+'/'+pickdate[1]+'/'+pickdate[0];
        var d = new Date();
        var dd= d.getDate();
        var m= d.getMonth()+1;
        var y=d.getFullYear();
        var curdate=[y, m, dd].join('/');
        var datepickedn = new Date(datepicked);
        var curdaten = new Date(curdate);
        if(curdaten<=datepickedn){ //hide show or add time button
            $('.add_avalability_time').show();
            var availid=($(this).closest('tr').find('input[name="availableid"]').val())?$(this).closest('tr').find('input[name="availableid"]').val():'';
            var fromtime=$(this).closest('tr').find('input[name="from_time"]').val();
            var totime=$(this).closest('tr').find('input[name="to_time"]').val();
            var location=$(this).closest('tr').find('select[name="location"]').val();
            var doctorid=$('input[name="doctorid"]').val();
            var doctormcr=$('input[name="doctormcr"]').val();
            var date=$('input[name="date"]').val();
            if(location==''){
                $(this).closest('tr').find('select[name="location"]').focus();
            } else if(fromtime==''){
                $(this).closest('tr').find('input[name="from_time"]').focus();
                
            }else if(totime==''){
                $(this).closest('tr').find('input[name="to_time"]').focus();
            }else{
                if(new Date(datepicked +' '+ totime) >= new Date(datepicked +' '+ fromtime)){ //Fromtime to totime checking
                    $.post("<?=base_url(); ?>doctor/saveTime",{fromtime:fromtime,totime:totime,doctorid:doctorid,doctormcr:doctormcr,location:location,date:date,availid:availid},function(data){
                        if(data){
                        var dt=JSON.parse(data);
                        if(dt.status>0){
                            bootbox.alert({
                                        message: dt.msg,
                                        callback:function(){
                                        savethis.closest('tr').find('input[name="availableid"]').val(dt.avlid); 
                                        $('.save_time').hide(); 
                                        $('.add_avalability_time').show();
                                        $('.remove_time').show();
                                        setTimeout(function(){$('body').addClass('modal-open');},500);
                                        }
                            });
                        }else{
                             bootbox.alert({
                                        message: dt.msg,
                                        callback:function(){
                                        setTimeout(function(){$('body').addClass('modal-open');},500);
                                        }
                            });
                        }
                        }
                    });
        
                }else{
                bootbox.alert('From time is greater than To time. Please pick the correct time.');
                }
            }
        }else{
            $('.add_avalability_time').hide();
        }
    })

    function add_avalability_time(){
            var rcnt=$('.add_avalability_time').attr('value');
            $('.add_avalability_time').hide();
            var rowcnt='row'+rcnt;
            var html='';
            var doclocation=$('.doclocation').html();
            
            html ='<tr id="'+rowcnt+'"><td>'+doclocation+'</td><td><input name="availableid" type="hidden" value=""><input type="text" class="form-control clockpicker" name="from_time" value="" maxlength="10"></td><td><input type="text" class="form-control clockpicker" name="to_time"  value="" maxlength="10"></td><td><a href="javascript:void(0);" class="remove_time">Remove</a> </td></tr>';
            $('.append_row').append(html);
            //$(".select2").select2();   
            $('.add_avalability_time').attr('value',++rcnt);
            $('.clockpicker').clockpicker({
            autoclose: true
            });
            }
    
    //Remove data
    $(document).on("click",'.remove_time',function(){
            var avalableid= $(this).closest('tr').find('input[name="availableid"]').val();
            var ths=$(this);
            if(avalableid){
            title='Confirm before delete this record';
            message='Are You sure to delete this record!';
            confirm_boot(title,message,function(result) {
                if(result){
                    $.post(BASE_URL+"doctor/removeTime",{avalableid:avalableid},function(data){
                            if(data){
                            var dt=JSON.parse(data);
                            if(dt.status>0){
                                bootbox.alert({
                                            message: dt.msg,
                                            callback:function(){
                                            $('.add_avalability_time').show();
                                            ths.closest('tr').remove();
                                            setTimeout(function(){$('body').addClass('modal-open');},500);
                                            }
                                        });

                            }else{
                                 bootbox.alert({
                                            message: dt.msg,
                                            callback:function(){
                                                setTimeout(function(){$('body').addClass('modal-open');},500);
                                            }
                                        });
                            }
                            }
                    });
                }else{
                    setTimeout(function(){$('body').addClass('modal-open');},500);
                    }
            });
            }else{
                ths.closest('tr').remove();
                $('.add_avalability_time ').show();
            }
        })
        
    $(document).on("change",'.datefilter',function(){
            var pickdate=$(this).val().split('-');
            var datepicked=pickdate[2]+'/'+pickdate[1]+'/'+pickdate[0];
            var d = new Date();
            var dd= d.getDate();
            var m= d.getMonth()+1;
            var y=d.getFullYear();
            var curdate=[y, m, dd].join('/');
             datepicked = new Date(datepicked);
             curdate = new Date(curdate);
            if(curdate<=datepicked){ //hide show od add time button
                    $('.add_avalability_time ').show();
               }else{
                    $('.add_avalability_time ').hide();
            }
            var date=$('input[name="date"]').val();
            var docId=$('input[name="doctorid"]').val();
            var htmlavl='';
            $.post(BASE_URL+'doctor/avalability_filter',{docId:docId,date:date},function(data){
                if(data){
                    var avldata=JSON.parse(data);
                    for(var i=0;i<avldata.availability.length;i++){
                    var starttime=(avldata.availability[i].session_starttime).split(':');
                    var endtime=(avldata.availability[i].session_endtime).split(':');
                    var selectloc='<select name="location" class="form-control">';
                    for(let j=0;j<avldata.Doc_location.length; j++){
                        var locationselected=(avldata.Doc_location[j].ID==avldata.availability[i].hospital_location_id)?'selected':'';
                         selectloc +='<option value="">Select</option><option value="'+avldata.Doc_location[j].ID+'" '+locationselected+'>'+avldata.Doc_location[j].name+'</option>';
                        }
                        selectloc +='</select>';
                    htmlavl +='<tr><td>'+selectloc+'</td><td><input name="availableid" type="hidden" value="'+avldata.availability[i].ID+'"><input type="text" class="form-control clockpicker" name="from_time"  value="'+starttime[0]+':'+starttime[1]+'" maxlength="10"></td><td><input type="text" class="form-control clockpicker" name="to_time"  value="'+endtime[0]+':'+endtime[1]+'" maxlength="10"></td><td><a href="javascript:void(0);" class="remove_time">Remove</a></td></tr>';
                    starttime='';
                    endtime='';
                    }
                    $('.append_row').html('');
                    $('.append_row').html(htmlavl);
                    $('.clockpicker').clockpicker({
                            autoclose: true
                        });
                    }
            });
        });
        
    </script>
    <script>
     $(document).on('change','select[name="speciality"]',function(){
         $('select[name="view_type"]').trigger('change');
     });
     
	$(document).on('change','select[name="view_type"]',function(){
         var view_type=parseInt($('select[name="view_type"]').val());
         var limit=($('select[name="filter_no"]').val())?$('select[name="filter_no"]').val():10;
         var filter_no=parseInt(limit);
         //alert(filter_no);
         var speciality=$('select[name="speciality"]').val();
         var searchDoctor=$('.gridviewSearch').val();
         if(!searchDoctor){
         }
         if(view_type==1){
                $('.view_doctor_data').html('');
                $('.loaderajax').show();
                //$('.gridSearch').hide();
                $.post(BASE_URL+'doctor/doctorListView_pagination',{view_type:view_type,speciality:speciality,searchDoctor:searchDoctor,filter_no:filter_no},function(data){
                if(data){
                    $('.loaderajax').hide();
                    $('.view_doctor_data').html('');
                    $('.view_doctor_data').html(data);
                    $('.bulk_delete').show();
                }
                });
             
         }else{
                $('.view_doctor_data').html('');
                $('.loaderajax').show();
                $.post(BASE_URL+'doctor/doctorGridView',{view_type:view_type,speciality:speciality,searchDoctor:searchDoctor,filter_no:filter_no},function(data){
                if(data){
                    $('.loaderajax').hide();
                    //$('.gridSearch').show();
                    $('.view_doctor_data').html('');
                    $('.view_doctor_data').html(data);
                    $('.bulk_delete').hide();
                }
                });
            
         }
     })      
     $(function(){
         $('select[name="view_type"]').trigger('change');
         
     })
     
     //Pagination on the doctor grid view
     $(document).on('click','.pagination li a',function(e){
            e.preventDefault();
            
            var view_type=parseInt($('select[name="view_type"]').val());
            var speciality=$('select[name="speciality"]').val();
            var searchDoctor=$('.gridviewSearch').val();
            var limit=($('select[name="filter_no"]').val())?$('select[name="filter_no"]').val():10;
            var filter_no=parseInt(limit);
            
            if(!$(this).attr('data-ci-pagination-page')){
                return false;
            }else{
                $('.view_doctor_data').html('');
                $('.loaderajax').show();
                jQuery.ajax({
                type: "POST",
                url: jQuery(this).attr("href"),
                data:{view_type:view_type,speciality:speciality,searchDoctor:searchDoctor,filter_no:filter_no},
                success: function(data){
                                $('.loaderajax').hide();
                                $('.view_doctor_data').html('');
                                $('.view_doctor_data').html(data);
                                $('.bulk_delete').hide();
                }
                });
            }
            return false;
    });

//return true only for the enter button click
document.onkeydown = function (evt) {
    var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
    if (keyCode == 13) {
    $('.gridviewSearchbtn').trigger('click');
}};
//End
    </script>

