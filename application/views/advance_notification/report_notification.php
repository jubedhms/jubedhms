<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->
<style>
.widget-body {
    padding: 0px 20px !important;
}

.show-grid {
    margin: 0 0 !important;
}

.readonly{
    background-color: #fff !important;
}

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
		
		<div class="widget-bg">
			<div class="widget-heading clearfix">
				<h5>  </h5>
			</div>
			<!-- /.widget-heading -->
			<div class="widget-body clearfix">
				<div class="row show-grid">
					<div class="col-md-4">
						<p>From Date</p>
						<input id="from_date" name="from_date" class="form-control datepicker" type="text"  data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' value="<?php //date( 'Y-m-01');?>" placeholder="From Date" autocomplete="off">
					</div>
					
					<div class="col-md-4">
						<p>To Date</p>
						<input id="to_date" name="to_date" class="form-control datepicker" type="text"  data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd"}' value="<?php //date( 'Y-m-t');?>" placeholder="To Date" autocomplete="off">
					</div>
					<div class="col-md-4">
					</div>	
				</div>
				<div class="row show-grid">
					<div class="col-md-4">
						<p>Notification Name</p>
						<select id="name" name="name" class="form-control name" >
							<option value="0">Select</option>
							<?php
								if ($notificationList && count($notificationList) > 0) {
								foreach ($notificationList as $value) {
									?>
									<option value="<?= $value->ID; ?>"><?= $value->name; ?></option>
									<?php }
								}
							?>			
						</select>
					</div>
					
					<div class="col-md-4">
						<p>Start Date</p>
						<input id="start_date" name="start_date" class="form-control readonly" type="text" value="" placeholder="Start Date" readonly>
					</div>
					
					<div class="col-md-4">
						<p>End Date</p>
						<input id="end_date" name="end_date" class="form-control readonly" type="text" value="" placeholder="End Date" readonly>
					</div>		
				</div>
				
				<div class="row columns-border-bw border-top border-left border-bottom">
					<div class="col-3 d-flex flex-column justify-content-center align-items-center py-4">
						<h6 class="my-0"><span class="counter" id="counter-2">SENT</span></h6>
						<h6 class="my-0"><span class="send_count_counter">0</span></h6>
						<small>Sent</small>
					</div>
					
					<div class="col-3 d-flex flex-column justify-content-center align-items-center py-4">
						<h6 class="my-0"><span class="counter">DELIVERED</span></h6>
						<h6 class="my-0"><span class="seen_count_counter">0</span></h6>
						<small>Delivered</small>
					</div>
					
					<div class="col-2 d-flex flex-column justify-content-center align-items-center py-4">
						<h6 class="my-0"><span class="counter">CLICKS</span></h6>
						<h6 class="my-0"><span class="click_count_counter">0</span></h6>
						<small>Clicks</small>
					</div>
					
					<div class="col-2 d-flex flex-column justify-content-center align-items-center py-4">
						<h6 class="my-0"><span class="counter">INTERACT</span></h6>
						<h6 class="my-0"><span class="interact_count_counter">0</span></h6>
						<small>Conversions</small>
					</div>
					
					<div class="col-2 d-flex flex-column justify-content-center align-items-center py-4">
						<h6 class="my-0"><span class="counter">BOUNCE</span></h6>
						<h6 class="my-0"><span class="failed_count_counter">0</span></h6>
						<small>Failed</small>
					</div>
				</div>
				
				<div class="row">
					<div class="loaderajax" style="text-align: center;position: absolute;width: 150px;z-index: 1;margin-left: 30%;">
						<img src="<?= base_url('assets/img/Ajax-loader.gif'); ?>" style="width: 150px;">
					</div>
					<div class="col-12">
						<canvas id="line-chart" ></canvas>
					</div>
				</div>
			</div>
		<!-- /.media-body -->
		</div>
		<!-- /.counter-w-info -->
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

<script> 
var date=[];
var sent=[];
var delivered=[];
var clicks=[];
var conversions=[];
var failed= [];

//$(function() {
	syncData(ID='');
//});

$(document).ready(function() {
   	$( ".datepicker" ).datepicker({
		//dateFormat: 'yy-mm-dd',
		//autoclose: true,
	}).on('changeDate', function (ev) {
		$("#name").html("<option value='0'>Select</option>");
		
		var from_date = $("#from_date").val();
		var to_date = $("#to_date").val();
		
		$.ajax({
			url: BASE_URL+"advance_notification/getSelectboxData",
			type:'post',	  
			cache: false,
			data:{from_date:from_date,to_date:to_date},
			success: function(data){
			if(data!=''){
				var jsonData= JSON.parse(data);
				if(jsonData){
					for(i=0;i<jsonData.length;i++) {
						$('#name')
						.append($("<option>Select</option>")
						.attr("value",jsonData[i].ID)
						.text(jsonData[i].name)); 
					}		
				}
			}
		  }
		});
		syncData(0);	
	});
});

$(document).on("change","#name",function(){
	var ID = $("#name").val();
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	syncData(ID);
});

function syncData(ID){
	var date=[];
	var sent=[];
	var delivered=[];
	var clicks=[];
	var conversions=[];
	var failed= [];
	$('.loaderajax').show();
	
	$.ajax({
	  url: BASE_URL+"advance_notification/reportChartData",
	  type:'post',	  cache: false,

	  data:{ID:ID},
	  success: function(data){
		if(data!=''){
			var jsonData= JSON.parse(data);
			if(jsonData){
				var TotalCountData=jsonData.TotalCount;
				if(TotalCountData){
					(TotalCountData.notification_id)?$("#name").val(TotalCountData.notification_id):'';
					(TotalCountData.start_date)?$("#start_date").val(TotalCountData.start_date):'';
					(TotalCountData.end_date)?$("#end_date").val(TotalCountData.end_date):'';
					$('.send_count_counter').html((TotalCountData.send_count)?TotalCountData.send_count:0);
					$('.seen_count_counter').html((TotalCountData.seen_count)?TotalCountData.seen_count:0);
					$('.click_count_counter').html((TotalCountData.click_count)?TotalCountData.click_count:0);
					$('.interact_count_counter').html((TotalCountData.interact_count)?TotalCountData.interact_count:0);
					var failCount=parseInt(TotalCountData.send_count)-parseInt(TotalCountData.seen_count)
					$('.failed_count_counter').html((failCount >0)?failCount:0);
				}
				
				var chartData=jsonData.chartData;
				if(chartData){
					for(i=0;i<chartData.length;i++) {
						date.push((chartData[i].date)?chartData[i].date:'');
						sent.push((chartData[i].send_count)?chartData[i].send_count:0);
						delivered.push((chartData[i].seen_count)?chartData[i].seen_count:0);
						clicks.push((chartData[i].click_count)?chartData[i].click_count:0);
						conversions.push((chartData[i].interact_count)?chartData[i].interact_count:0);
						fail= parseInt(chartData[i].send_count)-parseInt(chartData[i].seen_count);
						failed.push((fail >0)?fail:0);
					}	
				}
			}	
		}
		syncChartData(date,sent,delivered,clicks,conversions,failed);
		$('.loaderajax').hide();
	  }
	});	
}

function syncChartData(date,sent,delivered,clicks,conversions,failed){
	new Chart(document.getElementById("line-chart"), {
	  type: 'line',
	  data: {
		
		labels: date,
		datasets: [{ 
			data: sent,
			label: "Sent",
			borderColor: "#3e95cd",
			backgroundColor: "#3e95cd",
			fill: false
		  }, { 
			data: delivered,
			label: "Delivered",
			borderColor: "#8e5ea2",
			backgroundColor: "#8e5ea2",
			fill: false
		  }, { 
			data: clicks,
			label: "Clicks",
			borderColor: "#00ff7f",
			backgroundColor: "#00ff7f",
			fill: false
		  }, { 
			data: conversions,
			label: "Conversions",
			borderColor: "#ff8c00",
			backgroundColor: "#ff8c00",
			fill: false
		  }, { 
			data: failed,
			label: "Failed",
			borderColor: "#c45850",
			backgroundColor: "#c45850",
			fill: false
		  }
		]
	  },
	  options: {
		title: {
		  display: false,
		  text: 'World population per region (in millions)'
		}
	  }
	});	
} 

</script>