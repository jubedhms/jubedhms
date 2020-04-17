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

	<div class="widget-list row">
                 
                 
                 
                 
                <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading">
                            <h5 class="widget-title">User Gender</h5>
                             
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- /.widget-heading -->
                        <div class="widget-body">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
                                    <canvas id="pieChart"  height="150"></canvas>
                                </div>
								<p> </p>
                            </div>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
                <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading">
                            <h5 class="widget-title">Kid Gender</h5>
                             
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- /.widget-heading -->
						
                        <div class="widget-body">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
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
                        <div class="widget-heading">
                            <h5 class="widget-title">Patient Group</h5>
                             
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- /.widget-heading -->
						
                        <div class="widget-body">
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
              "datasets":[{"label":"My First Dataset","data":[30, 70],
              "backgroundColor":["rgb(255, 99, 132)","rgb(0, 255, 0)" ]}]}});

              new Chart(document.getElementById("pieChart2"),
              {"type":"pie","data":{"labels":["Male", "Female"],
              "datasets":[{"label":"My First Dataset","data":[37,63],
              "backgroundColor":["rgb(255, 99, 132)","rgb(0, 255, 0)"]}]}});
            </script>
              <script>
              new Chart(document.getElementById("doughnutChart"),
              {"type":"doughnut","data":{"labels":["Pregnancy", "Non-pregnancy", "Mom with first kid","Mom with kid+"],
              "datasets":[{"label":"My First Dataset","data":[47,15,30,8],
              "backgroundColor":["rgb(255, 99, 132)","rgb(0, 255, 0)",
              "rgba(77, 175, 124, 1)"]}]}});</script>
<!--End footer-->