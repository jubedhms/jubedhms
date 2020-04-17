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
					<!-- <?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<th class="th-no-sort" data-sortable="false">
					<div class="togglebutton" title="Select/Unselect all"><label>
					<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
					<span class="toggle"></span></label></div>
					</th>
					<?php }?>	 -->
					<th>Product Id</th>
					<th>Name</th>
					<th>Detail</th>
 					<th>Amount</th>
					<th>Quantity</th>
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
					<div class="togglebutton" title="Select/Unselect"><label>
					<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?> -->
					<td><?=$data->product_id;?></td>
					<td><?=$data->name;?></td>
					<td><?=$data->description;?></td>
 					<td><?=$data->product_amount;?></td>
					<td><?=$data->quantity;?></td>
					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td>
					<div class="togglebutton" title="Active/Deactive"><label>
					<input type="checkbox" class="status" name="status[]" value="patient.'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<td>
                    <?php if(checkModulePermission($MODULEID,'edit_btn')){ ?>
						 
						<a href="<?=base_url('product_list/view_product');?>/<?=MD5($data->ID);?>" title="View product">
                            <img src="<?= base_url('assets/img/icon/view.png');?>"/>
                        </a> 
                    <!-- <?php }if(checkModulePermission($MODULEID,'edit_btn')){?>
					<a href="patient/addedit_patient/<?=MD5($data->ID);?>" title="Edit patient">
					<img src="<?= base_url('assets/img/icon/edit.png');?>"/>
					</a>
					<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<a href="javascript:void(0)" class="single_delete" id="patient/deleteData/<?=md5($data->ID);?>" title="Delete patient">
					<img src="<?= base_url('assets/img/icon/delete.png');?>"/>
					</a>
					<?php }?> -->
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