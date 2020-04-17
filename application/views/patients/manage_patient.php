<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->
<style>
.btn-success {
    background-color: #00b1f3 !important;
    border-color: #00b1f3 !important;
}    
</style>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
<!-- Page Title Area -->
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>

		<!-- /.page-title-left -->
		<div class="page-title-right d-none d-sm-inline-flex">
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
				<!-- <a href="<?=base_url('patient/addedit_patient');?>" class="btn btn-info btn-sm"> New</a>-->
			<?php } if(checkModulePermission($MODULEID,'print_btn')){ ?>
				<a href="javascript:void(0);" title="Patient excel report download" class="btn btn-info btn-sm patient_exceldnld">Download Report</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<!-- <a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?=base_url('patient/deleteData');?>" title="Delete selected">Delete</a> -->
			<?php }?>
			</span>
		</div>
	<!-- /.page-title-right -->
	</div>
<!-- /.page-title -->
<!-- =================================== -->
<!-- Different data widgets ============ -->
<!-- =================================== -->

	<div class="widget-list">
	<div class="row">
		<div class="col-md-12 widget-holder hidden">
		<form class="MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
						 
		<div class="widget-bg">
		<div class="widget-heading clearfix">
		<h5>  </h5>
		</div>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">

		</div>
		<!-- /.media-body -->
		</div>
		</form>
		<!-- /.counter-w-info -->
		</div>

		<div class="col-md-12 widget-holder">
		<div class="widget-bg">
		<div class="widget-heading clearfix">
		<h5>  </h5>
		</div>
                    <?php //print_r($details); ?>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">
			<div class="overflow">
			<table class="table table-striped table-responsive table-bordered" id="myTable">
			<thead>
				<tr>
					<!-- <?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<th class="th-no-sort" data-sortable="false">
						<input type="checkbox" class="checkAllRows" id="checkAllRows" />
					</th>
					<?php }?>	 -->
					<th>Created Date</th>
					<th>PRN</th>
					<th>Username</th>
					<th>Patient name</th>
					<th>Contact No.</th>
                    <?= (checkModulePermission($MODULEID,'status_btn'))?'<th>Active</th>':'';?>
					<th class="th-action">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$i=0;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr>
					<!-- <?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<td>
						<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
					</td>
					<?php }?> -->
					<td><?=DateTime($data->maker_date,"d-m-Y");?></td>
					<td>
						<?= ($data->prn!='')?$data->prn:'<a href="javascript:void(0)" data-patientuid="'.$data->ID.'" class="btn btn-success btn-xs btn-block AssignPRN---">Assign PRN</a>';	
						?>
					</td>
					<td><?=$data->username;?></td>
					<td><?= $data->title.' '.$data->first_name.' '.$data->middle_name.' '.$data->last_name;?></td>
					<td><?=$data->contact_number;?></td>
					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td>
					<div class="togglebutton" title="Active/Inactive"><label>
					<input type="checkbox" class="status" name="status[]" value="<?=tblprefix("patient").'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<td>
                   <div class="dropdown">
							<a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height:33px;">
								<i class="fa fa-ellipsis-v" style="font-size:24px"></i>
							</a>
							<?php if($data->prn==''){?>
							<div class="dropdown-menu dropdown-menu-left action-dropdown">
							<?php if(checkModulePermission($MODULEID,'view_btn')){?>	
								<a  href="patient/view_patient/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info btn-xs btn-block action-btn min-btn">View</a>
							<?php }?>
							</div>
							<?php }else{?>
							<div class="dropdown-menu  dropdown-menu-left">
							<?php if(checkModulePermission("37",'view_btn')){ ?>
								<a href="doctor_appointment?prn=<?=MD5($data->prn);?>" class="dropdown-item btn btn-info btn-xs btn-block action-btn">View Doctor Appointment</a>
							<?php } if(checkModulePermission("38",'view_btn')){ ?>
								<a href="vaccine_appointment?prn=<?=MD5($data->prn);?>" class="dropdown-item btn btn-info btn-xs btn-block action-btn">View Vaccine Appointment</a>	
							<?php } if(checkModulePermission($MODULEID,'view_btn')){ ?>	
								<a  href="patient/view_patient/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info btn-xs btn-block action-btn">View Patient</a>
							<?php }}?>
							</div>
						</div>	
					</td>
				</tr>
				<?php $i++;}}?>	
			</tbody>
			</table>
	</div>
	</div>
	</div>
	</div>
	</div>
        
            
        <!-- PRN update modal-->    
        <div class="modal modal-info fade" id="UpdatePRN" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title">Update PRN</h5>
				</div>
				<form accept-charset="UTF-8" method="post" id="formp">
				<div class="modal-body">
					<input type="hidden" class="PID" id="PID" name="PID">
					<input   class="prn_update form-control" id="prn_update" name="prn_update" value="">
                                        <span id="error-msg"></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success btn-rounded ripple text-left savechange">Update</button>
					<button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Close this</button>
				</div>
				</form>
			</div>
		</div>
	</div>
<script>
    $(document).on('click','.AssignPRN',function(){
        if($(this).data('patientuid')!=''){
            var today = new Date();
            var year=today.getFullYear();
            year = year.toString().substr(-2);
            var month=(today.getMonth()+1);
            var date=today.getDate();
          
            var new_prn='P-'+year+month+date+$(this).data('patientuid');
            
            $("#PID").val($(this).data('patientuid'));
            
            $("#prn_update").val(new_prn);
            $('.savechange').removeAttr('disabled');
            $('#error-msg').text('')
            
        }
            $('#UpdatePRN').modal('show');
    });
    
    $(document).ready(function(){
            $('#dfdfformp').validate({
            rules: {
                prn_update: {
                    required:true,
                    remote: {
                        url: BASE_URL+'patient/checkprnExist',
                        type: "post",
                        data: {
                          prn_update: function() {
                            return $( ".prn_update" ).val();
                          }
                        }
                      }               
                }
            },
            messages:{
                prn_update: {
                    remote: "This PRN already exit"
                }
            },
          submitHandler: function () {
                $.post(BASE_URL+'patient/updatePRN', $('#formp').serialize(), function(data){
                if(data){
                    var dt=JSON.parse(data);
                    if(dt.status>0){
                        alert(dt.msg);
                        location.reload();
                    }else{
                        alert(dt.msg);
                    }
                }
            });
            }
        });
        });
</script>
<script>
    $(document).on('keyup','.prn_update',function(){
        $.post(BASE_URL+'patient/checkprnExist',$('#formp').serialize(),function(data){
            if(data){
                    var dt=JSON.parse(data);
                    if(dt.status>0){
                        $('#error-msg').text(dt.msg).css('color','red');
                        $('.savechange').attr('disabled','true');
                    }else{
                        $('#error-msg').text('')
                        $('.savechange').removeAttr('disabled');
                    }
                }
    });
    })
</script>
<script>
    $(document).on('click','.savechange',function(){
        var prnno=parseInt($('.prn_update').val());
        if(prnno!=''){
            $.post(BASE_URL+'patient/updatePRN', $('#formp').serialize(), function(data){
                        if(data){
                            var dt=JSON.parse(data);
                            if(dt.status>0){
                                alert(dt.msg);
                                location.reload();
                            }else{
                                alert(dt.msg);
                            }
                        }
                    });
                }
            });
</script>
<script>
            $(document).on('click', ".patient_exceldnld", function(){
                if(confirm('Are you sure to donwnload excel report.')){
                $.post("<?php echo base_url();?>dashboard/patient_export_list", function (data) {
                    var $a = $("<a>");
                    $a.attr("href",data);
                    $("body").append($a);
                    $a.attr("download","<?php  echo 'Patient Report';?>");
                    $a[0].click();
                    $a.remove();
                });
                }
        });
          
</script>
</main>
<?=$footer;?>