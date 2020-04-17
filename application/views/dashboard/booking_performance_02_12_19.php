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
                            <h5 class="widget-title">Department</h5>
                             
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- /.widget-heading -->
                        <div class="widget-body">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
                                    <canvas id="chartjs-2"  height="150"></canvas>
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
                            <h5 class="widget-title">Location</h5>
                             
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- /.widget-heading -->
						
                        <div class="widget-body">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
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
 <script>Chart.defaults.global.legend.display = false;
 new Chart(document.getElementById("chartjs-2"),{"type":"horizontalBar",
  "data":{"labels":["Gynaecologist","Obstetrics","Vaccination","Pediatrician"],
  "datasets":[{"label":"My First Dataset","data":[65,59,80,81,56,55,40],
  "fill":false,"backgroundColor":["rgb(34,139,34)","rgb(34,139,34)","rgb(34,139,34)","rgb(34,139,34)"],"borderWidth":1}]},
  "options":{"scales":{"xAxes":[{"ticks":{"beginAtZero":true}}]}}});
</script>
<script>new Chart(document.getElementById("chartjs-3"),{"type":"horizontalBar",
"data":{"labels":["Ha Noi","Can Tho","Vung Tau","Dong Nai"],
"datasets":[{"label":"My First Dataset","data":[65,59,80,81,56,55,40],
"fill":false,"backgroundColor":["rgb(34,139,34)","rgb(34,139,34)","rgb(34,139,34)","rgb(34,139,34)"],"borderWidth":1}]},
"options":{"scales":{"xAxes":[{"ticks":{"beginAtZero":true}}]}}});
</script>
<!--End footer-->