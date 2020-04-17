<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->
<style>
.action-btn{
    max-width: 13.2em !important;
    margin-left: 0.5em !important;
}
.table > tbody > tr > td {vertical-align: middle;}
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
					<th>Title</th>
					<th width="30%">Content</th>
					<th>Last Updated By</th>
					<th>Last Updated Date</th>
					<?php // (checkModulePermission($MODULEID,'status_btn'))?'<th>Active</th>':'';?>
					<th class="th-action" style="text-align: center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$i=1;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr>
					<td><?=$data->title;?></td>
					<td><?=$data->description;?></td>
					<td><?=$data->editor;?></td>
					<td><?= dateTime($data->updater_date,"Y-m-d");?></td>
 					<?php //if(checkModulePermission($MODULEID,'status_btn')){ ?>
						<!--<td>
							<div class="togglebutton" title="Active/Inactive"><label>
							<input type="checkbox" class="status" name="status[]" value="<?= "generic_notification".'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
							<span class="toggle"></span></label></div>
						</td>-->
					<?php //}?>
					<td style="text-align: center;"> 
                        <div class="dropdown">
						    <a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height: 33px;">
							    <i class="fa fa-ellipsis-v" style="font-size:24px"></i>
						    </a>
							<div class="dropdown-menu  dropdown-menu-left">
								<?php if(checkModulePermission($MODULEID,'view_btn')){ ?>
									<a href="<?=base_url('generic_notification/view_generic_notification');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info  btn-xs btn-block action-btn">View Notification</a>	
								<?php } if(checkModulePermission($MODULEID,'edit_btn')){ ?>
									<a href="<?=base_url('generic_notification/addedit_generic_notification');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success btn-xs btn-block action-btn">Edit Notification</a>
								<?php }?>
							</div>
						</div>
					</td>
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