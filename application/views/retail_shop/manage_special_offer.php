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
			<a href="<?=base_url('special_offer/addedit_special_offer');?>" class="btn btn-info btn-sm">New</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?= base_url('special_offer/deleteData');?>" title="Delete selected rows">Delete</a>
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
					<th class="th-no-sort" data-sortable="false">
						<input type="checkbox" class="checkAllRows" id="checkAllRows"/>
					</th>
					<?php }?>	
					<th>Image</th>
					<th>Offer ID</th>
					<th>Name</th>
					<!--<th>Details</th>-->
					<th>Amount</th>
					<th>Uploader</th>
					<th>Upload Date</th>
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
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<td>
						<input type="checkbox" class="checkRow" name="checkRow[]" value="<?= MD5($data->ID);?>" />
					</td>
					<?php }?>
					<td style="width:100px !important;">
						<a href="<?=(isset($data->image) && $data->image!='')?$data->image:base_url('assets/images/icon/not-available.jpg');?>" class="image-lightbox" id="image-lightbox" title="" data-toggle="lightbox" data-type="image" style="cursor:zoom-in;">	
							<img src="<?=(isset($data->image) && $data->image!='')?$data->image:base_url('assets/images/icon/not-available.jpg');?>" >
						</a>
					</td>
					<td><?=$data->offer_id;?></td>
					<td><?=$data->name;?></td>
 					<!--<td><?=substr($data->description, 0, 50);?></td>-->
					<td><?=$data->currency_code.$data->sale_price;?></td>
					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td><?=$data->author;?></td>
					<td><?=$data->maker_date;?></td>
					<td>
					<div class="togglebutton" title="Active/Inactive"><label>
					<input type="checkbox" class="status" name="status[]" value="<?= tblprefix("special_offer").'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<td>
						 <div class="dropdown">
						    <a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width:33px;height:33px;">
								<i class="fa fa-ellipsis-v" style="font-size:24px;"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-left action-dropdown">
								<?php if(checkModulePermission($MODULEID,'view_btn')){ ?>
									<a href="<?=base_url('special_offer/view_special_offer');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info  btn-xs btn-block action-btn min-btn">View</a>	
								<?php } if(checkModulePermission($MODULEID,'edit_btn')){ ?>
									<a href="<?=base_url('special_offer/addedit_special_offer');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success  btn-xs btn-block action-btn min-btn">Edit</a>
								<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
									<a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger btn-xs btn-block action-btn min-btn" id="special_offer/deleteData/<?=md5($data->ID);?>">Delete</a>
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