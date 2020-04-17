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
						<input type="hidden" name="ID" value="<?= MD5($ID); ?>">	
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
						<textarea id="description" name="description" class="form-control" required="required" rows="1" data-rule-required="true" data-msg-required="Please include your Role Description"><?= getFieldVal('description',$details);?></textarea>
						<span class="error1" style="display: none;">
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
				if($module->module_url=="javascript:void(0)"){	
				?>
				<tr style="background:#EEEEEE"><td colspan="9"><u><b><?=$module->module_name;?><b></u></td></tr>
				<?php }else{?>
				<tr>
					<td><?=$module->module_name;?></td>	
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="check_row check add_btn"  name="add_btn[<?=$module->ID?>]" id="add_btn<?=$module->ID?>" value="1" <?=($module->add_btn=='1')?"checked":"";?> />
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="check_row check view_btn"  name="view_btn[<?=$module->ID?>]" id="view_btn<?=$module->ID?>" value="1" <?=($module->view_btn=='1')?"checked":"";?> />
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="check_row check edit_btn"  name="edit_btn[<?=$module->ID?>]" id="edit_btn<?=$module->ID?>" value="1" <?=($module->edit_btn=='1')?"checked":"";?> />
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="check_row check delete_btn"  name="delete_btn[<?=$module->ID?>]" id="delete_btn<?=$module->ID?>" value="1" <?=($module->delete_btn=='1')?"checked":"";?> />
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="check_row check status_btn"  name="status_btn[<?=$module->ID?>]" id="status_btn<?=$module->ID?>" value="1" <?=($module->status_btn=='1')?"checked":"";?> />
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="check_row check print_btn"  name="print_btn[<?=$module->ID?>]" id="print_btn<?=$module->ID?>" value="1" <?=($module->print_btn=='1')?"checked":"";?> />
						<span class="toggle"></span></label></div>
					</td>
					<td>
						<div class="togglebutton"><label>
						<input type="checkbox" class="check_row check other_btn"  name="other_btn[<?=$module->ID?>]" id="other_btn<?=$module->ID?>" value="1"  <?=($module->other_btn=='1')?"checked":"";?> />
						<span class="toggle"></span></label></div>
					</td>
					<?php }?>
				</tr>
				<?php }}?>
			</tbody>
			</table>
			
			<div class="row">
				<div class="col-md-12">
				<div class="form-group">
				<div class="box-footer text-center">
					<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
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
$('.MyForm input,textarea,select,checkbox,radio').attr('disabled', 'disabled');
</script>
