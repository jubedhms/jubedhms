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
        <div class="row" style="height: 20px;">
            
        </div>
	<div class="widget-list row">
                <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading" style="background: #8dc63f;padding: 10px;width: 300px;color: #fff !important;border-top-right-radius: 50px 20px;">
                            <h5 class="widget-title" style="color: #fff;">User Gender (In Percent)</h5>
                        </div>
                        
                        
                        <div class="widget-body" style="width: 500px;height:200px;border: 2px solid;">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
                                    <?php if(checkModulePermission($MODULEID,'print_btn')){ ?>
                                    <div class="box-tools pull-right">
                                        <a href="javascript:void(0);" title="Patient excel report download" style="background-color: #5b9bd5;border-color: #f5f7fa;" class="btn btn-block btn-flat btn-info btn-xs patient_exceldnld">Download Report</a>
                                    </div>
                                    <?php } ?>
                                    <canvas id="pieChart"  height="150"></canvas>
                                </div><p> </p>
                            </div>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
                <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading" style="background: #8dc63f;padding: 10px;width: 300px;color: #fff !important;border-top-right-radius: 50px 20px;">
                            <h5 class="widget-title" style="color: #fff;">Kid Gender (In Percent)</h5>
                        </div>
                        <div class="widget-body" style="width: 500px;height:200px;border: 2px solid;">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
                                    <?php if(checkModulePermission($MODULEID,'print_btn')){ ?>
                                    <div class="box-tools pull-right">
                                        <a href="javascript:void(0);" title="Sub patient excel report download" style="background-color: #5b9bd5;border-color: #f5f7fa;" class="btn btn-block btn-flat btn-info btn-xs subpatient_exceldnld">Download Report</a>
                                    </div>
                                    <?php } ?>
                                     <canvas id="pieChart2" height="150"></canvas>
                                </div>			 
                            </div>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
	<div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading" style="background: #8dc63f;padding: 10px;width: 300px;color: #fff !important;border-top-right-radius: 50px 20px;">
                            <h5 class="widget-title" style="color: #fff;">Patient Group (In Percent)</h5>
                        </div>
                        
                        <div class="widget-body" style="width: 500px;height:200px;border: 2px solid;">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
                                     <canvas id="doughnutChart" height="150"></canvas>
                                </div>
								 
                            </div>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
	<div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading" style="background: #8dc63f;padding: 10px;width: 300px;color: #fff !important;border-top-right-radius: 50px 20px;">
                            <h5 class="widget-title" style="color: #fff;">User age group (In Number)</h5>
                        </div>
                        <div class="widget-body" style="width: 500px;height:200px;border: 2px solid;">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
                                     <canvas id="doughnutChart2" height="150"></canvas>
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
 <script>//Chart.defaults.global.legend.display = false;
              new Chart(document.getElementById("pieChart"),
              {"type":"pie","data":{"labels":["Male", "Female"],
              "datasets":[{"label":"My First Dataset","data":[<?=$male; ?>, <?=$female; ?>],
              "backgroundColor":["#70AD47","#5B9BD5" ]}]}});

              new Chart(document.getElementById("pieChart2"),
              {"type":"pie","data":{"labels":["Male", "Female"],
              "datasets":[{"label":"My First Dataset","data":[<?=$smale; ?>,<?=$sfemale; ?>],
              "backgroundColor":["#70AD47","#5B9BD5"]}]}});
            </script>
              <script>
              new Chart(document.getElementById("doughnutChart"),
              {"type":"doughnut","data":{"labels":["Pregnancy", "Non-pregnancy", "Mom with first kid","Mom with kid+"],
              "datasets":[{"label":"My First Dataset","data":[<?=$pregnancy; ?>,<?=$nonpregnancy; ?>,<?=$momFirstKid; ?>,<?=$momFirstKidPlus; ?>],
              "backgroundColor":["#4472C4","#Ed7D31","#A5A5A5","#FFC000"]}]}});</script>
              <script>
              new Chart(document.getElementById("doughnutChart2"),
              {"type":"doughnut","data":{"labels":["18-25", "26-30", "30-35","36-40","40+"],
              "datasets":[{"label":"My First Dataset","data":[<?=$date18_25; ?>,<?=$date26_30; ?>,<?=$date31_35; ?>,<?=$date36_40; ?>,<?=$date41; ?>],
              "backgroundColor":["#4472C4","#ED7E33","#A5A5A5","#FFC000","#5B9BD5"]}]}});</script>
<!--End footer-->
<script>
            $(document).on('click', ".patient_exceldnld", function(){
                if(confirm('Are you sure to donwnload excel report.')){
                $.post("<?php echo base_url();?>dashboard/patient_export_list", function (data) {
                    var $a = $("<a>");
                    $a.attr("href",data);
                    $("body").append($a);
                    $a.attr("download","<?php  echo 'Patient Report';?>");
                    $a[0].click();
                    $a.remove();
                });
                }
        });
            $(document).on('click', ".subpatient_exceldnld", function(){
            if(confirm('Are you sure to donwnload excel report.')){
                $.post("<?php echo base_url();?>dashboard/subpatient_export_list", function (data) {
                    var $a = $("<a>");
                    $a.attr("href",data);
                    $("body").append($a);
                    $a.attr("download","<?php  echo 'Sub Patient Report';?>");
                    $a[0].click();
                    $a.remove();
                });
                }
        });
</script>