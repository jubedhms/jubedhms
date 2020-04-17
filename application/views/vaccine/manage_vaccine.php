<!--Start header-->
<?=$header;?>
<!--End header-->
<style>
.action-dropdown {
    min-width: 120% !important;
}

.action-btn {
	width: 89px;
}
#myTable_filter{display:none;}
</style>
<!-- Start page-->

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
			<a href="<?=base_url('vaccine/addedit_vaccine');?>" class="btn btn-info btn-sm">Add New Vaccine</a>
			<?php } ?> <!-- <?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?=base_url('patient/deleteData');?>" title="Delete selected">Delete Selected</a>
			<?php }?>-->
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
                    
                <div class="row m-0">
                <div class="col-xm-12 col-sm-12 col-md-1 col-lg-1">
                     
                </div>
                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5">
                    <div class="form-group">
                            <label for="category" class="">Vaccine</label>
                            <select class="form-control vaccines" id="select-id"  name="vaccines" multiple>
                               <optgroup label="Select All">
                             <?php if($details && count($details)>0){
				foreach($details as $row){ ?>
                                <option value="<?php echo $row->ID; ?>"><?php echo $row->vaccine_name; ?> </option>
                             <?php } } ?>
                               </optgroup>
                            </select>
                    </div>
                </div>

                
                <div class="col-xm-12 col-sm-12 col-md-3 col-lg-2">
                    <div class="form-group">
                    <label for="vaccine_code" class="">Vaccine code</label>
                           <input type="text" name="vaccine_code" class="form-control" >
                    </div>
                </div>
                    
                <div class="col-xm-12 col-sm-12 col-md-3 col-lg-2">
                    <div class="form-group">
                    <label for="vaccine_status" class="">Status</label>
                            <select class="form-control vaccine_status" name="vaccine_status">
                                <option value=""> Select </option>
                                <option value="1">Available</option>
                                <option value="2">Unavailable</option>
                            </select>
                    </div>
                </div>
                
                
                <div class="col-xm-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="form-group" style=" top: 35px; ">
                            <label class=""></label>
                            <button  class="btn btn-xs btn-success search">Search</button>
                     </div>
                </div>
            </div>    
                    
                    <?php //print_r($details); ?>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">
                    <div class="loaderajax" style="text-align: center;display: none;">
                    <img src="<?php base_url(); ?>assets/img/Ajax-loader.gif" style="width: 150px;">
            </div>
			<div class="overflow vaccine_div">
			
	</div>
	</div>
	</div>
	</div>
	</div>
        
            

<script>

</script>
<script>
      $(document).ready(function() {   
        $(".vaccines").select2();   
      });     
    $(function(){
         $('.search').trigger('click');
     })
</script>
<script>
    $(document).on('click','.search',function(){
        var vaccine_id=$('.vaccines').val()?JSON.stringify($('.vaccines').val()):'';
        var vaccine_status=($('select[name="vaccine_status"]').val())?$('select[name="vaccine_status"]').val():'';
        var vaccine_code=($('input[name="vaccine_code"]').val())?$('input[name="vaccine_code"]').val():'';
                $('.vaccine_div').html('');
                $('.loaderajax').show();
                $(".vaccines").val('').change();
                $(".vaccine_status").val('').change();
                $('input[name="vaccine_code"]').val('');
                $.post(BASE_URL+'vaccine/vaccine_list',{status:vaccine_status,vaccine_code:vaccine_code,vaccine_id:vaccine_id},function(data){
                if(data){
                    $('.loaderajax').hide();
                    $('.vaccine_div').html('');
                    $('.vaccine_div').html(data);
                }
                });
     })
</script>
<script>
function RunSelect2(){
  $('#select-id').select2({
     placeholder: "Select",
     allowClear: true,
     closeOnSelect: false,
  }).on('select2:open', function() {  
    setTimeout(function() {
        $(".select2-results__option .select2-results__group").bind( "click", selectAlllickHandler ); 
    }, 0);
  });
}
setTimeout(function() {RunSelect2();},1000);
 //RunSelect2();
var selectAlllickHandler = function() {
$(".select2-results__option .select2-results__group").unbind( "click", selectAlllickHandler );        
$('#select-id').select2('destroy').find('option').prop('selected', 'selected').end();
  RunSelect2();
};
</script>
</main>
<?=$footer;?>