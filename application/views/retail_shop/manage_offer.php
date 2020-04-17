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
			<a href="<?=base_url('offer/addedit_offer');?>" class="btn btn-info btn-sm">Add</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<? //=base_url('offer/deleteData');?>" title="Delete selected rows">Delete All</a>
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
					<div class="togglebutton" title="Select/Unselect all"><label>
					<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
					<span class="toggle"></span></label></div>
					</th>
					<?php }?>	
					<th>Name</th>
					<th>Description</th>
					<th>Quantity</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Status</th>
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
					<div class="togglebutton" title="Select/Unselect"><label>
					<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<td><?=$data->name;?></td>
					<td><?=substr($data->description, 0, 50);?></td>
					<td><?=$data->quantity;?></td>
					<td><?=DateTime($data->start_date,"d-m-Y");?></td>
					<td><?=DateTime($data->end_date,"d-m-Y");?></td>
					<td><?=$data->status;?></td>
					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td>
					<div class="togglebutton" title="Active/Deactive"><label>
					<input type="checkbox" class="status" name="status[]" value="<?= "offer".'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<td>
                    <?php if(checkModulePermission($MODULEID,'edit_btn')){ ?>
                        <a href="<?=base_url('offer/view_offer');?>/<?=MD5($data->ID);?>" title="View offer">
                            <img src="<?= base_url('assets/img/icon/view.png');?>"/>
                        </a>
                    <?php }if(checkModulePermission($MODULEID,'edit_btn')){?>
					<a href="offer/addedit_offer/<?=MD5($data->ID);?>" title="Edit offer">
					<img src="<?= base_url('assets/img/icon/edit.png');?>"/>
					</a>
					<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<a href="javascript:void(0)" class="single_delete" id="offer/deleteData/<?=md5($data->ID);?>" title="Delete offer">
					<img src="<?= base_url('assets/img/icon/delete.png');?>"/>
					</a>
					<?php }?>
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