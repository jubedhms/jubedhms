<!--Start header-->
<?=$header;?>
<!--End header-->

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
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.html">Manage <?= $heading;?></a>
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
		<div class="widget-heading clearfix">
			<h5>  </h5>
		</div>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<?php $ID= (isset($details->ID))?$details->ID:""; ?>
						<input type="hidden" name="ID" value="<?= $ID; ?>">	
						<label for="name" class="">Role Name *</label>
						<input id="name" name="name" class="form-control" required="required" type="text" value="<?= getFieldVal('name',$details);?>" data-rule-required="true" data-msg-required="Please include your Role Name" >
						<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
						</span> 
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">	
						<label for="description" class="">Description *</label>
						<textarea id="description" name="description" class="form-control" required="required" data-toggle="wysiwyg" data-rule-required="true" data-msg-required="Please include your Role Description"><?= getFieldVal('description',$details);?></textarea>
						<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
						</span> 
					</div>
				</div>
			</div>
		</div>
		<!-- /.media-body -->
		</div>
	<!-- /.counter-w-info -->
	</div>

		<div class="col-md-12 widget-holder">
		<div class="widget-bg">
		<div class="widget-heading clearfix">
		<h5>  </h5>
		</div>
		<!-- /.widget-heading -->
			<div class="widget-body clearfix">	
			<table class="table table-striped table-responsive table-bordered">
			<thead>
				<tr>
					<th>Module Name</th>
					<th>
					<div class="togglebutton"><label>
					<input type="checkbox" class="checkAllRows"  id="checkAllRows" onClick="checkAllRows(this)"/>
					<span class="toggle"></span></label></div>
					</th>
					<th>Add</th>
					<th>View</th>
					<th>Edit</th>
					<th>Delete</th>
					<th>Show States</th>
					<th>Print</th>
					<th>Other</th>
				</tr>
			</thead>	
			<tbody>
				<?php //echo "<pre>";print_r($getModulList);
				if(count($getModulList)>0){
				foreach ($getModulList as  $module) {
				//if($module->module_url=="javascript:void(0)"){	
				?>
				<!--
				<tr style="background:#EEEEEE">
				<td colspan="9">
				<u><b><?php //echo $module->module_name;?><b></u>
				<input type="hidden" name="module_id[<?php //echo $module->ID?>]" id="UMID" value="<?php //echo $module->ID?>">
				</td>
				</tr>
				-->
				<?php //}else{?>
				<tr>
					<td>
						<?=$module->module_name;?>
						<input type="hidden" name="module_id[<?=$module->ID?>]" id="UMID" value="<?=$module->ID?>">
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="checkRows check all_btn"  name="all_btn[<?=$module->ID?>]" id="all_btn<?=$module->ID?>" value="1" <?=($module->all_btn=='1')?"checked":"";?>/>
						<span class="toggle"></span></label></div>
					</td>	
					<td>
						<?php $module->ID; if($module->ID!='1' && $module->ID!='2') {?>
						<div class="togglebutton"><label>
						<input type="checkbox" class="checkRow check add_btn"  name="add_btn[<?=$module->ID?>]" id="add_btn<?=$module->ID?>" value="1" <?=($module->add_btn=='1')?"checked":"";?>/>
						<span class="toggle"></span></label></div>
						<?php } ?>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="checkRow check view_btn"  name="view_btn[<?=$module->ID?>]" id="view_btn<?=$module->ID?>" value="1" <?=($module->view_btn=='1')?"checked":"";?>/>
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="checkRow check edit_btn"  name="edit_btn[<?=$module->ID?>]" id="edit_btn<?=$module->ID?>" value="1" <?=($module->edit_btn=='1')?"checked":"";?>/>
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<?php $module->ID; if($module->ID!='1' && $module->ID!='2') {?>
						<div class="togglebutton"><label>
						<input type="checkbox" class="checkRow check delete_btn"  name="delete_btn[<?=$module->ID?>]" id="delete_btn<?=$module->ID?>" value="1" <?=($module->delete_btn=='1')?"checked":"";?>/>
						<span class="toggle"></span></label></div>
						<?php } ?>
					</td>
					<td>
						<?php $module->ID; if($module->ID!='1' && $module->ID!='2') {?>
						<div class="togglebutton"><label>
						<input type="checkbox" class="checkRow check status_btn"  name="status_btn[<?=$module->ID?>]" id="status_btn<?=$module->ID?>" value="1" <?=($module->status_btn=='1')?"checked":"";?>/>
						<span class="toggle"></span></label></div>
						<?php } ?>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="checkRow check print_btn"  name="print_btn[<?=$module->ID?>]" id="print_btn<?=$module->ID?>" value="1" <?=($module->print_btn=='1')?"checked":"";?>/>
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="checkRow check other_btn"  name="other_btn[<?=$module->ID?>]" id="other_btn<?=$module->ID?>" value="1"  <?=($module->other_btn=='1')?"checked":"";?>/>
						<span class="toggle"></span></label></div>
					</td>
					<?php //}?>
				</tr>
				<?php }}?>
				</tbody>
			</table>

			<div class="row">
				<div class="col-md-12">
				<div class="form-group">
				<div class="box-footer text-center">
					<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
					<button type="submit" class="btn btn-success no-print">Save</button>
					<a href="<?= $main_page;?>" class="btn btn-danger no-print">Cancel</a>
				</div>
				</div>
				</div>
			</div>
	</div>
	<!-- /.widget-body -->
	</div>
	<!-- /.widget-bg -->
	</div>
	
	
	
	
	
<!-- /.widget-body -->
	</div>
	<!-- /.widget-bg -->
	</div>
	<!-- /.widget-holder -->
	
	</form>
</main>
<!-- /.main-wrappper -->	
<!-- end page-->		

<!--Start footer-->
<?=$footer;?>
<!--End footer-->

<script>
if ($('.check:checked').length == $('.check').length ){
    $("#checkAllRows")[0].checked = true;
}

$(document).on('click', '.checkRows', function(event) { 
var obj = $(this).parent().parent().parent().parent();
obj.find('.checkRow').not(this).prop('checked', this.checked);
});

$(document).on('click', '.checkRow', function(event) { 
var obj = $(this).parent().parent().parent().parent();
 if ((obj.find('.checkRow:checked').length) == (obj.find('.checkRow').length)){
   obj.find('.checkRows').prop('checked', "checked");
}else{
	obj.find('.checkRows').prop('checked', "");
}
});
</script>