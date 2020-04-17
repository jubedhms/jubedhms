<!--Start header-->
<?=$header;?>
<!--End header-->

<?php 
$ID= (isset($details->ID))?$details->ID:""; 
?>

<!-- Start page-->
<style>
.select2-results__group
{
  cursor:pointer !important;
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
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= $main_page;?>">Manage <?=$heading;?></a>
			</li>
			<li class="breadcrumb-item active"><?= $mode.' '.$heading; ?></li>
			</ol>
		</div>
	<!-- /.page-title-right -->
	</div>
	<!-- /.page-title -->
	<!-- =================================== -->
	<!-- Different data widgets ============ -->
	<!-- =================================== -->

	<form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
	
	<div class="widget-list">
	<div class="row">
	<div class="col-md-12 widget-holder">
	<div class="widget-bg">
	<div class="widget-body clearfix">
		 
        <div class="row">
			<div class="col-md-6">
    			<div class="form-group">
					<input type="hidden" name="ID" value="<?= ($ID!='')?md5($ID):''; ?>">
    				<label for="title" class="">Title *</label>
    				<input type="text" id="title" name="title" class="form-control" value="<?=isset($details->title)?$details->title:'';?>" required="required" data-rule-required="true" data-msg-required="Please input Notification title.">
    				<span class="error" style="display: none;">
    					<i class="error-log fa fa-exclamation-triangle"></i>
    				</span>
    			</div>
			</div>
			
			<div class="col-md-6">
				<div class="form-group">
					<label for="customer_group" class="">Customer Group *</label>
					<select class="form-control select2" id="select-id" name="customer_group[]" required="required" data-rule-required="true" data-msg-required="Please select customer group." multiple>
    					<optgroup label="Select All">
                                        <?php 
                                                $customer_group=array('Pregnancy','Non-Pregnancy','Mom with first kid','Mom with Kids+');
                                                if($customer_group && count($customer_group)>0){
                                                $i=1;
                                                $cgroup=isset($details->customer_group)?explode(',',$details->customer_group):array();
                                                foreach($customer_group as $customer_group){
                                        ?>
                                                <option value="<?=$i;?>" <?=(in_array($i,$cgroup))?"selected":"";?>><?=$customer_group; ?></option>
                                        <?php $i++; }}?>
                                        </optgroup>
                                        </select>
					
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>  
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="from_date" class="">From Date *</label>
					<input id="from_date" name="from_date" class="form-control datepicker" required="required" type="text" value="<?=isset($details->from_date)?date('Y-m-d',strtotime($details->from_date)):date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd","startDate":"<?=date('Y-m-d');?>"}' data-rule-required="true" data-msg-required="Please select From Date.">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span> 
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="to_date" class="">To Date *</label>
					<input id="to_date" name="to_date" class="form-control datepicker" required="required" type="text" value="<?=isset($details->to_date)?date('Y-m-d',strtotime($details->to_date)):date('Y-m-d');?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd","startDate":"<?=date('Y-m-d');?>"}' data-rule-required="true" data-msg-required="Please select To Date.">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span> 
				</div>
			</div>
		</div>

        <div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="description" class="">Description *</label>
					<textarea name="description" class="form-control" rows="5" required="required" data-rule-required="true" data-msg-required="Please input description."><?=getFieldVal('description',$details)?></textarea>

 				</div>
			</div>
		</div>	

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
						<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
						<button type="submit" class="btn btn-success no-print submit">Save</button>	
 						<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
					</div>
				</div>
			</div>
		</div>

		
	</div>
	</div>
	</div>
	
	</div>
	</div>
	</form>
	
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>
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
RunSelect2();
var selectAlllickHandler = function() {
$(".select2-results__option .select2-results__group").unbind( "click", selectAlllickHandler );        
$('#select-id').select2('destroy').find('option').prop('selected', 'selected').end();
  RunSelect2();
};
</script>
				