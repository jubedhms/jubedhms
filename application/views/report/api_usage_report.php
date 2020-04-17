<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->

<main class="main-wrapper clearfix">
<!-- Page Title Area -->
<div class="action-message"><?= getFlashMsg('success_message'); ?></div>

	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>

		<!-- /.page-title-left -->
		<div class="page-title-right d-none d-sm-inline-flex">
			<span>
			
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
		<div class="col-md-12 widget-holder">
		<form class="MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">				 
		<div class="widget-bg">
		<div class="widget-heading clearfix">
		<h5>  </h5>
		</div>
		<!-- /.widget-heading -->
		<div class="widget-body clearfix">
            <div class="row hidden">
                <div class="col-md-6">
                    <div class="form-group">
                    <select class="form-control api_secret_key" id="api_secret_key" name="api_secret_key" data-toggle="select22" >
                        <?php
                        if($configDetails && count($configDetails)>0){
                            foreach(array($configDetails) as $config){
                                ?>
                                <option value="<?=$config->api_secret_key;?>" <?= (isset($_REQUEST['api_secret_key']) && $config->api_secret_key==$_REQUEST['api_secret_key'])?"selected":"";?>><?=$config->title;?></option>
                            <?php }}?>
                    </select>
                </div>
            </div>
            </div>

            <div class="row ">
			<div class="col-md-6">
                <div class="form-group">
					<label for="from_date">From Date</label>
					<input type="text" id="from_date" name="from_date" class="form-control from_date datepicker" value="<?= (isset($_REQUEST['from_date']))?$_REQUEST['from_date']:date('01-m-Y');?>" data-plugin-options='{"autoclose": true,"format": "dd-mm-yyyy","endDate":"<?=date('d-m-Y');?>"}' data-rule-required="false" data-msg-required="Please select To Date." >
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="to_date">To Date</label>
					<input type="text" id="to_date" name="to_date" class="form-control to_date datepicker" value="<?= (isset($_REQUEST['to_date']))?$_REQUEST['to_date']:date('d-m-Y');?>" data-plugin-options='{"autoclose": true,"format": "dd-mm-yyyy","endDate":"<?=date('d-m-Y');?>"}' data-rule-required="false" data-msg-required="Please select To Date." >
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
                    <label for="on_app" class="">App</label>
                    <select class="form-control on_app" id="on_app" name="on_app" data-toggle="select2" >
                        <option value="">All</option>
                        <option value="resourceguruapp" <?= (isset($_REQUEST['on_app']) && $_REQUEST['on_app']=="resourceguruapp")?"selected":""?>>Resourceguruapp</option>
                        <option value="workflowmax" <?= (isset($_REQUEST['on_app']) && $_REQUEST['on_app']=="workflowmax")?"selected":""?>>Workflowmax</option>
                    </select>
                </div>
			</div>
			
			<div class="col-md-6">
                <div class="form-group">
                    <label for="type" class="">Type</label>
                    <select class="form-control type" id="type" name="type" data-toggle="select2" >
                        <option value="">All</option>
                        <option value="Project" <?= (isset($_REQUEST['type']) && $_REQUEST['type']=="Project")?"selected":""?>>Projects</option>
                        <option value="Client" <?= (isset($_REQUEST['type']) && $_REQUEST['type']=="Client")?"selected":""?>>Clients</option>
                        <option value="Resource" <?= (isset($_REQUEST['type']) && $_REQUEST['type']=="Resource")?"selected":""?>>Resources</option>
                        <option value="Task" <?= (isset($_REQUEST['type']) && $_REQUEST['type']=="Task")?"selected":""?>>Tasks</option>
                    </select>
                </div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">

			</div>
			
			<div class="col-md-6">
				<div class="form-group pull-right" style="margin-top: 25px;">
					<button type="submit" class="btn btn-success no-print">Search</button>
					<a href="<?= base_url('dashboard');?>" class="btn btn-danger no-print">Cancel</a>
					<!--<a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>-->
				</div>
			</div>
		</div>
		
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
			<div class="table-responsive">
			<table class="table table-striped table-responsive table-bordered" id="myTable">
			<thead>
				<tr>
                    <th class="th-no-sort" data-sortable="false" width='10%'>S.No.</th>
                    <th>Synced Date</th>
                    <!--<th>License Title</th>-->
                    <th>Messages</th>
                </tr>
			</thead>
			<tbody>
				<?php  
				$i=1;
				if($details && count($details)>0){
				foreach($details as $data){?>		
				<tr>
                    <td><?=$i;?></td>
                    <td><?=DateTime($data->synced_date, "d-m-Y H:i:s");?></td>
                    <!--<td></td>-->
                    <td>
                        <?= $data->type." name '".$data->name."' has been ".$data->action." successfully in ".$data->on_app.".";?>
						<?php if($data->old_record=='0'){?>
						<span >
							<img src="<?=base_url('assets/img/icon/new.png');?>" style="float:right">
						</span>
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