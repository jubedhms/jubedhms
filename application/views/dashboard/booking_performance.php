<!--Start header-->
<?=$header;?>
<!--End header-->

<!-- Start page-->
<style>
    .widget-bg .widget-heading {
    padding: 20px 20px 0 0;
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
		<!--
		<div class="page-title-right d-none d-sm-inline-flex">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.html">Home</a>
		</li>
		<li class="breadcrumb-item active"><?= $mode.' '.$heading; ?></li>
		</ol>
		</div>
		-->
	<!-- /.page-title-right -->
	</div>
	<!-- /.page-title -->
	<!-- =================================== -->
	<!-- Different data widgets ============ -->
	<!-- =================================== -->

	<div class="widget-list row">
                <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading" style="display: block;">
                        <div class="row" style="margin-bottom: -25px;">
                        <div class="col-md-7" style="background: #8dc63f;padding: 10px;width: 300px;height: 42px;color: #fff !important;border-top-right-radius: 50px 20px;"><h5 class="widget-title" style="color: #fff;">Department (In Percent)</h5></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
			<div class="form-group">
                            <select class="form-control department" name="department" style="color: #00ADEE;background: #F4F4F4;">
                                <?php if(isset($weeks)){ $i=1; foreach($weeks as $wrow){ ?>
                                <option value="<?php echo $wrow['start_date'].'/'.$wrow['end_date']; ?>"  <?php echo (date('Y-m-d')>=$wrow['start_date'] && date('Y-m-d')<= $wrow['end_date'] )?'selected':''; ?>>Week<?=$i++; ?></option>
                                <?php } } ?>
                            </select>
                        </div>
			</div>
			</div>
                        </div>
                        <div class="widget-body" style="width: 96%;height:200px;border: 2px solid;">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px;" id="graph-container">
                                    <canvas id="chartjs-2"  height="150"></canvas>
                                </div><p> </p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        
                        <div class="widget-heading" style="display: block;">
                        <div class="row" style="margin-bottom: -25px;">
                        <div class="col-md-7" style="background: #8dc63f;padding: 10px;width: 300px;height: 42px;color: #fff !important;border-top-right-radius: 50px 20px;border-left: 3px solid #fff;"><h5 class="widget-title" style="color: #fff;">Location (In Number)</h5></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
			<div class="form-group">
                            <select class="form-control month" name="month" style="color: #00ADEE;background: #F4F4F4;">
                                    <option value="01"  <?php echo (date("F")=='January')?'selected':''; ?>>January</option>
                                    <option value="02" <?php echo (date("F")=='February')?'selected':''; ?>>February</option>
                                    <option value="03" <?php echo (date("F")=='March')?'selected':''; ?>>March</option>
                                    <option value="04" <?php echo (date("F")=='April')?'selected':''; ?>>April</option>
                                    <option value="05" <?php echo (date("F")=='May')?'selected':''; ?>>May</option>
                                    <option value="06" <?php echo (date("F")=='June')?'selected':''; ?>>June</option>
                                    <option value="07" <?php echo (date("F")=='July')?'selected':''; ?>>July</option>
                                    <option value="08" <?php echo (date("F")=='August')?'selected':''; ?>>August</option>
                                    <option value="09" <?php echo (date("F")=='September')?'selected':''; ?>>September</option>
                                    <option value="10" <?php echo (date("F")=='October')?'selected':''; ?>>October</option>
                                    <option value="11" <?php echo (date("F")=='November')?'selected':''; ?>>November</option>
                                    <option value="12" <?php echo (date("F")=='December')?'selected':''; ?>>December</option>
                            </select>
                        </div>
			</div>
			</div>
                        </div>
                        
                        
                        
                        
                        <div class="widget-body" style="width: 96%;height:200px;border: 2px solid;">
                        <div class="mr-t-10 flex-1">
                        <div class="row">
                        <div class="col-md-6"></div>
			<div class="col-md-6">
			
			</div>
			</div>
                                <div style="max-height: 270px; height: 270px" id="graph-container2">
                                     <canvas id="chartjs-3" height="150"></canvas>
                                </div>
								 
                            </div>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
            </div>
            <!-- /.widget-list -->
             
             
            <hr >
              
               
            </div>
            <!-- /.widget-list -->
        </main>
        <!-- /.main-wrappper -->





<!-- end page-->		

<!--Start footer-->
<div style="position:relative">
<?=$footer;?>
</div>

<script>
    $(function(){
         $('.month').trigger("change");
         $('.department').trigger("change");
         
     })
     
    $(document).on('change','.month',function(){
        $.post('<?=base_url();?>dashboard/booking_location_info',{month:$(this).val()},function(data){
			var dt=JSON.parse(data);
			var labelsArray = [];
			var amountArray = [];
			if(dt){
				for (var i = 0; i < dt.length; i++) {
					labelsArray.push(dt[i].location_name);
					amountArray.push(dt[i].total_appointment);
				}
			}
              
			$('#chartjs-3').remove(); // this is my <canvas> element
			$('#graph-container2').append('<canvas id="chartjs-3"><canvas>');
            new Chart(document.getElementById("chartjs-3"),{"type":"horizontalBar",
            "data":{"labels":labelsArray,
                "datasets":[{"label":"Location dataset",
                "data":amountArray,
            "fill":false,"backgroundColor":["#5B9BD5"],"borderWidth":1}]},
            "options":{"scales":{"xAxes":[{"ticks":{"beginAtZero":true}}]}}});
            
        })
        
    })
</script>
<script>
    $(document).on('change','.department',function(){
        $.post('<?=base_url();?>dashboard/booking_department_info',{week:$(this).val()},function(data){
            var dt=JSON.parse(data);
                var labelsArray2 = [];
                var amountArray2 = [];
                var colorArray2 = [];
                var color=50 ;
                var totalPatient=dt.totalPatient;
                for (var i = 0; i < dt.deptarr.length; i++) {
                    labelsArray2.push(dt.deptarr[i].name+'('+dt.deptarr[i].persent_in_department+')');
                }
                for (var j = 0; j < dt.deptarr.length; j++) {
                    amountArray2.push(Math.round((dt.deptarr[j].persent_in_department/totalPatient)*100));
                    colorArray2.push('#'+"5B9B"+color);
                    color=color+2;
                }
                $('#chartjs-2').remove(); // this is my <canvas> element
                $('#graph-container').append('<canvas id="chartjs-2"><canvas>');
                //$("#chartjs-2").html('');
            new Chart(document.getElementById("chartjs-2"),{"type":"horizontalBar",
            "data":{"labels":labelsArray2,
                "datasets":[{"label":"Department dataset",
                "data":amountArray2,
                "backgroundColor": colorArray2,
            "fill":false,"borderWidth":1}]},
            "options":{"scales":{"xAxes":[{"ticks":{"beginAtZero":true}}]}}});
        })
        
    })
</script>
<!--End footer-->