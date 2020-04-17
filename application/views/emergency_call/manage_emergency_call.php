<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->

<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
<!-- Page Title Area -->
	
<!-- /.page-title -->
<!-- =================================== -->
<!-- Different data widgets ============ -->
<!-- =================================== -->
 
			<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>

		<!-- /.page-title-left -->
		<!-- <div class="page-title-right d-none d-sm-inline-flex">
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
			<a href="<?=base_url('patient/addedit_patient');?>" class="btn btn-info btn-sm">Add</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?=base_url('patient/deleteData');?>" title="Delete selected rows">Delete All</a>
			<?php }?>
			</span>
		</div> -->
	<!-- /.page-title-right -->
	</div>
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
					<!-- <?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<th class="th-no-sort" data-sortable="false">
					<div class="togglebutton" title="Select/Unselect all"><label>
					<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
					<span class="toggle"></span></label></div>
					</th>
					<?php }?>	 -->
					<th>Name</th>
					<th>UserName</th>
					<th>Contact Number</th>
                    <th>Email</th>
					<th>Date</th>
					<th>Time</th>
					<!--<th>Location</th> -->
 					<th class="th-action" style="text-align: center;">Action</th>
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
					<div class="togglebutton" title="Select/Unselect"><label>
					<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?> -->
 					<td><?=$data->name;?></td>
					<td><?=$data->username;?></td>
					<td><?=$data->contact_number;?></td>
					<td><?=$data->email_id;?></td>
 					<td><?=DateTime($data->date,"Y-m-d");?></td>
 					<td><?=DateTime($data->time,"h:i:s A");?></td>
 					<!--<td><?=$data->location;?></td> -->
 					 
					<td style="text-align: center;">
						<div class="dropdown">
							<a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height: 33px;">
								<i class="fa fa-ellipsis-v" style="font-size:24px"></i>
							</a>
							<div class="dropdown-menu  dropdown-menu-left">
							<?php if(checkModulePermission($MODULEID,'edit_btn')){ ?>
								<a href="<?=base_url('emergency_calls/view_map');?>/<?=md5($data->username);?>" class="dropdown-item btn btn-success btn-xs btn-block action-btn">View Location</a> 
							<?php } if(checkModulePermission(15,'view_btn')){ ?>
								<a href="patient/view_patient/<?=$data->username;?>/username" class="dropdown-item btn btn-info btn-xs btn-block action-btn">View Patient</a>	
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
<div style="position:relative">
<?=$footer;?>
</div>
 <script>
              new Chart(document.getElementById("pieChart"),
              {"type":"pie","data":{"labels":["Excellent", "Very Good", "good", "Fair", "Poor"],
              "datasets":[{"label":"My First Dataset","data":[90, 40, 20, 13, 5],
              "backgroundColor":["rgb(255, 99, 132)","rgb(0, 255, 0)",
              "rgba(77, 175, 124, 1)","rgb(255, 205, 86)","rgb(255, 99, 132)"]}]}});

              new Chart(document.getElementById("pieChart2"),
              {"type":"pie","data":{"labels":["Excellent", "Very Good", "good", "Fair", "Poor"],
              "datasets":[{"label":"My First Dataset","data":[90, 40, 20, 13, 5],
              "backgroundColor":["rgb(255, 99, 132)","rgb(0, 255, 0)",
              "rgba(77, 175, 124, 1)","rgb(255, 205, 86)","rgb(255, 99, 132)"]}]}});
            </script>
              <script>
              new Chart(document.getElementById("doughnutChart"),
              {"type":"doughnut","data":{"labels":["Promoter (9+10)", "Neutral(7+8)", "Detractor(0-6)"],
              "datasets":[{"label":"My First Dataset","data":[8,4,1],
              "backgroundColor":["rgb(255, 99, 132)","rgb(0, 255, 0)",
              "rgba(77, 175, 124, 1)"]}]}});</script>
<!--End footer-->