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
                <div class="widget-holder widget-sm col-md-4 widget-full-height">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Daily revenue  </p><span class="counter-title color-primary"><span class="counter">500 </span> millions VND</span>
                                    <!-- /.counter-title -->  
                                    <div class="mr-t-20"><span data-toggle="sparklines" data-height="15" data-width="70" data-line-color="#1976d2" data-line-width="3" data-spot-radius="1" data-fill-color="rgba(0,0,0,0)" data-spot-color="undefined" data-min-spot-color="undefined"
                                        data-max-spot-color="undefined" data-highlight-line-color="undefined"><!-- 10,5,7,8,3,0,4,12,10,8,12 --></span>
                                    </div>
                                </div>
                                <!-- /.media-body -->
                                <div class="pull-right align-self-center"><i class="fa fa-money fa-4x "></i>
                                </div>
                            </div>
                            <!-- /.counter-w-info -->
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
                <div class="widget-holder widget-sm col-md-4 widget-full-height">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Weekly revenue   </p><span class="counter-title color-info"><span class="counter">1.25</span> billions VND</span>
                                    <!-- /.counter-title -->  
                                    <div class="progress" style="width: 70%; position: relative; top: 25px">
                                        <div class="progress-bar bg-info" style="width: 66%" role="progressbar"> 
                                        </div>
                                    </div>
                                </div>
                                <!-- /.media-body -->
                                <div class="pull-right align-self-center"><i class="fa fa-money fa-4x"></i>
                                </div>
                            </div>
                            <!-- /.counter-w-info -->
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
                 
                <!-- /.widget-holder -->
                <div class="widget-holder widget-sm col-md-4 widget-full-height">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Monthly revenue</p>
									<span class="counter-title"><span class="counter">5</span> billions VND</span>
                                    <!-- /.counter-title -->
                                    <div class="progress" style="width: 70%; position: relative; top: 25px">
                                        <div class="progress-bar bg-warning" style="width: 66%" role="progressbar"><span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.media-body -->
                                <div class="pull-right align-self-center"><i class="fa fa-money fa-4x"></i>
                                </div>
                            </div>
                            <!-- /.counter-w-info -->
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
                <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading">
                            <h5 class="widget-title">Revenue by Department</h5>
                             
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- /.widget-heading -->
                        <div class="widget-body">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
                                     <canvas id="chartjs-2" height="200"></canvas>
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
                            <h5 class="widget-title">Revenue by Service</h5>
                             
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- /.widget-heading -->
						
                        <div class="widget-body">
                            <div class="mr-t-10 flex-1">
                                <div style="max-height: 270px; height: 270px">
                                     <canvas id="chartjs-3" height="200"></canvas>
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
Chart.defaults.global.legend.display = false;
new Chart(document.getElementById("chartjs-2"),{"type":"bar",
  "data":{"labels":["Women Care","Child Care","Obstetrics","Family Clinic"],
  "datasets":[{"label":"My First Dataset","data":[5.8,4.1,2.3,1.7],
  "fill":false,"backgroundColor":["rgb(34,139,34)","rgb(34,139,34)","rgb(34,139,34)","rgb(34,139,34)"],"borderWidth":1}]},
  "options":{"scales":{"xAxes":[{"ticks":{"beginAtZero":true}}]}}});
</script>
<script>new Chart(document.getElementById("chartjs-3"),{"type":"bar",
"data":{"labels":["Birth service","Cancer screening","Physical examination","Gynecological examination"],
"datasets":[{"label":"My First Dataset","data":[8,5,4,5],
"fill":false,"backgroundColor":["rgb(34,139,34)","rgb(34,139,34)","rgb(34,139,34)","rgb(34,139,34)"],"borderWidth":1}]},
"options":{"scales":{"xAxes":[{"ticks":{"beginAtZero":true}}]}}});
</script>
<!--End footer-->