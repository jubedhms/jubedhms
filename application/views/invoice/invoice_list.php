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
					<th>Invoice ID</th>

                        <th>Patient</th>

                        <th>Patient Type</th>

                        <th>Paid Date</th>

                        <th>Pending Amount</th>

                        <th>Paid Amount</th>
				</tr>
			</thead>
			<tbody>

                    <tr>



                        <td>#INV-0001</td>

                        <td>Charles Ortega</td>

                        <td>Cash</td>

                        <td>8 Aug 2017</td>

                        <td>$200</td>

                        <td>$300</td>

                    </tr>
					<tr>



                        <td>#INV-0002</td>

                        <td>Denise Stevens</td>

                        <td>Cheque</td>

                        <td>9 Aug 2017</td>

                        <td>$0</td>

                        <td>$200</td>

                    </tr>
                    <tr>



                        <td>#INV-0003</td>

                        <td>Dennis Salazar</td>

                        <td>Cheque</td>

                        <td>9 Aug 2017</td>

                        <td>$0</td>

                        <td>$200</td>

                    </tr>
                    <tr>

                      
						<td><p>&nbsp;</p> </td><td> </td><td> </td><td> </td>
                        

                        <td >$200</td>

                        <td>$700</td>

                    </tr>
				 	
			</tbody>
			</table>
			<div class="row" >	
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<p>Total summary</p>		  
<table class="table table-bordered table-hover hms-table">
<tr><td>Paid Amount <span style="float: right;"> $700</span></td></tr>
<tr><td>Pending Amount <span style="float: right;"> $200</span></td></tr>
<tr><td>Total <span style="float: right;"> $500</span></td></tr>
</table>
</div>
</div>
<div class="row" >	
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h4>Other Imformation</h4>
<div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
</div>
</div>
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