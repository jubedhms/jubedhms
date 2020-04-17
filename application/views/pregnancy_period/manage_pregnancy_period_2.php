<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->

<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	
<!-- Page Title Area -->
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?=$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>

		<!-- /.page-title-left -->
		<div class="page-title-right d-none d-sm-inline-flex">
			<span>
			<?php if(checkModulePermission($MODULEID,'add_btn')){ ?>
			<a href="<?=base_url('pregnancy_period/addedit_pregnancy_period');?>" class="btn btn-info btn-sm">New</a>
			<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?= base_url('pregnancy_period/deleteData');?>" title="Delete selected rows">Delete</a>
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
			<table class="table table-striped table-responsive table-bordered" id="myTable" style="font-size: 12px;">
			<thead>
				<tr>
					<?php if(checkModulePermission($MODULEID,'delete_btn')){ ?>
					<th class="th-no-sort" data-sortable="false">
					<!-- <div class="togglebutton" title="Select all"><label> -->
					<input type="checkbox" class="checkAllRows"  id="checkAllRows" />
					<span class="toggle"></span></label>
					<!-- </div> -->
					</th>
					<?php }?>	
					<th>Type(Articles/<br>video clip)</th>
					<th>Type</th>
					<th>Title<br>(English)</th>
					<th>Title<br>(Vietnamese)</th>
					<!--<th>Audience<br> Segment</th>-->
					<!--<th>Description</th> -->
					<th>Editor/<br> Author</th>
					<th>Status<br>(Published/<br> Scheduled/<br> Draft)</th>
<!--					<th style="width: 80px;">Date Start</th>
					<th style="width: 80px;">Date End</th>-->
					<th style="width: 80px;">Date posted</th>
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
					<!-- <div class="togglebutton" title="Select"><label> -->
					<input type="checkbox" class="checkRow" name="checkRow[]"  value="<?= MD5($data->ID);?>" />
					<span class="toggle"></span>
					<!-- </div> -->
					</td>
					<?php }?>
					<td><?php echo ($data->file_type==1)?'Articles':'Video clip';?></td>
					<td style="text-align: center;">
                                            <?php if($data->pregnancy_period_image){ ($data->pregnancy_period_image)?$imgextention=explode('.',$data->pregnancy_period_image):array(); ?>
                                            <?php if(in_array(end($imgextention),array('jpg','jpeg','png','gif'))){ ?>
                                            <img width="100" height="60" class="img" src="<?php echo base_url().$data->pregnancy_period_image;?>" >
                                                
                                                <?php }else{
                                                ($data->pregnancy_period_image)?$youtubelink=explode('=',$data->pregnancy_period_image):'';
                                                ?>
                                                <iframe width="100" height="60" src="<?php echo 'https://www.youtube.com/embed/'.end($youtubelink);?>" frameborder="0">
                                                </iframe>
                                            <?php } } ?>
                                            
                                            
					</td>
					<td><?php echo ($data->name)?$data->name:'';?></td>
					<td><?php echo ($data->name_vi)?$data->name_vi:'';?></td>
					<!--<td>
							<?php // $customer_group=array('Pregnancy','Non-Pregnancy','Mom with first kid','Mom with Kids+');
//							$i=0;
//							$cgroup=isset($data->customer_group)?explode(',',$data->customer_group):array();
//							foreach($customer_group as $customer_group){
//								if(in_array($i,$cgroup)){
//									echo $customer_group.', ';
//								}
//							 $i++; } 
							 ?>
					</td>-->
 					<!--<td><?php //echo ($data->description)?substr($data->description, 0, 50):substr($data->description_vi, 0, 50);?></td>-->
					<td><?=($data->editor!='NA')?$data->editor:'';?></td>
					<!--<td>
							<?php //status
//								if(date('Y-m-d')<$data->start_date){
//									echo 'Scheduled';
//								}elseif(date('Y-m-d')>=$data->start_date && date('Y-m-d')<=$data->end_date){
//									echo 'Published';
//								}elseif(date('Y-m-d')>$data->end_date){
//									echo 'Draft';
//								}
							?>
					</td>-->
					<!--<td><?php //DateTime($data->start_date,"Y-m-d");?></td>-->
					<td><?php //DateTime($data->end_date,"Y-m-d");?></td>
					<td><?=DateTime($data->maker_date,"Y-m-d");?></td>
                                        
 					<?php if(checkModulePermission($MODULEID,'status_btn')){ ?>
					<td>
					<div class="togglebutton" title="Active/Inactive"><label>
					<input type="checkbox" class="status" name="status[]" value="<?= "s".'^'.MD5($data->ID);?>" <?=($data->show_status=='1')?"checked":"";?> />
					<span class="toggle"></span></label></div>
					</td>
					<?php }?>
					<td>
						<div class="dropdown">
						    <a href="#" class="btn btn-circle btn-outline-info fs-20 mr-2 mr-0-rtl ml-2-rtl dropdown-toggle" data-toggle="dropdown" title="Click" style="width: 33px;height: 33px;">
								<i class="fa fa-ellipsis-v" style="font-size:24px"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-left action-dropdown-min">
								<?php if(checkModulePermission($MODULEID,'view_btn')){ ?>
									<a href="<?=base_url('pregnancy_period/view_pregnancy_period');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-info btn-xs action-btn min-btn">View</a>	
								<?php } if(checkModulePermission($MODULEID,'edit_btn')){ ?>
									<a href="<?=base_url('pregnancy_period/addedit_pregnancy_period');?>/<?=MD5($data->ID);?>" class="dropdown-item btn btn-success btn-xs action-btn min-btn">Edit</a>
								<?php } if(checkModulePermission($MODULEID,'delete_btn')){ ?>
									<a href="javascript:void(0)" class="single_delete dropdown-item btn btn-danger btn-xs action-btn min-btn" id="pregnancy_period/deleteData/<?=md5($data->ID);?>">Delete</a>
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