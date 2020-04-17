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
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
				<!--<a href="<?php //base_url('doctor_specialization/addedit_doctor_specialization');?>" class="btn btn-info btn-sm">New Speciality</a>-->
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
				<!--<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?php //base_url('doctor_specialization/deleteData');?>" title="Delete selected">Delete Selected</a>-->
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
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">
			<div class="overflow">
			<table class="table table-striped table-responsive table-bordered" id="myTable">
			<thead>
				<tr>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<!--<th class="th-no-sort" data-sortable="false">
						<div class="togglebutton" title="Select all">
							<label>
								<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
								<span class="toggle"></span>
							</label></div>
					</th>-->
					<?php }?>	
					<th>Code</th>
					<th>Name</th> 
                    <?= (checkModulePermission($MODULEID,'status_btn'))?'<th>Active</th>':'';?>
					<!--<th class="th-action">Action</th>-->
				</tr>
			</thead>
			<tbody>
				<?php  
				$i=0;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<!--<td>
						<div class="togglebutton" title="Select"><label>
						<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
						<span class="toggle"></span></label></div>
					</td>-->
					<?php }?>
					<td><?=$data->code;?></td>
					<td><?=$data->name;?></td>
					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td>
					<div class="togglebutton" title="Active/Inactive"><label>
					<input type="checkbox" class="status" name="status[]" value="<?= "doctor_specialization".'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<!--
					<td>
						<div class="dropdown">
						    <a href="#" class="btn btn-circle btn-outline-default fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click">
							    <i class="fa fa-ellipsis-v" style="font-size:24px"></i>
						    </a>
							<div class="dropdown-menu  dropdown-menu-left">
								<?php if(checkModulePermission($MODULEID,'view_btn')){ ?>
									<a href="<?=base_url('doctor_specialization/view_doctor_specialization');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info  btn-xs btn-block action-btn">View Speciality</a>	
								<?php } if(checkModulePermission($MODULEID,'edit_btn')){ ?>
									<a href="<?=base_url('doctor_specialization/addedit_doctor_specialization');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success btn-xs btn-block action-btn">Edit Speciality</a>
								<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
									<a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger btn-xs btn-block action-btn" id="doctor_specialization/deleteData/<?=md5($data->ID);?>">Delete Speciality</a>
								<?php }?>
							</div>
						</div>
					</td>-->
				</tr>
				<?php $i++;}}?>	
			</tbody>
			</table>
	</div>
	<!-- /.widget-body -->
	</div>
	<!-- /.widget-bg -->
	</div>
	<!-- /.widget-holder -->


	<!-- /.widget-body -->
	</div>
	<!-- /.widget-bg -->
	</div>
	<!-- /.widget-holder -->
</main>
<!-- /.main-wrappper -->	
<!-- end page-->		

<!--Start footer-->
<?=$footer;?>
<!--End footer-->