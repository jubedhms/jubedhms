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
	</div>
	<div class="widget-list">
	<div class="row" style="height: 20px;"></div>
        <div class="row">    
        <div class="widget-holder widget-full-height widget-flex col-lg-6">
                <div class="widget-bg">
                    <div class="widget-heading" style="background: #8dc63f;padding: 10px;width: 300px;color: #fff !important;border-top-right-radius: 50px 20px;">
                            <h5 class="widget-title" style="color: #fff;">Overall Experience in hospital</h5>
                    </div>
                    <div class="widget-body" style="width: 500px;height:200px;border: 2px solid;">
                        <div class="mr-t-10 flex-1">
                            <div>
                                <canvas id="pieChart" height="140"></canvas>
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
                    <div class="widget-heading" style="background: #8dc63f;padding: 10px;width: 300px;color: #fff !important;border-top-right-radius: 50px 20px;">
                            <h5 class="widget-title" style="color: #fff;">Overall Quality of check up</h5>
                    </div>
                    
                    <div class="widget-body" style="width: 500px;height:200px;border: 2px solid;">
                        <div class="mr-t-10 flex-1">
                            <div>
                                 <canvas id="pieChart2" height="140"></canvas>
                            </div>
							 
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
			
            <!-- /.widget-holder -->
        </div>
            
</main>
<!-- /.main-wrappper -->	
<!-- end page-->	
<?php 
                                    
        $total_patient=count($details);

        $excellent_totalH=0;
        $verygood_totalH=0;
        $good_totalH=0;
        $fair_totalH=0;
        $poor_totalH=0;

        $excellent_totalC=0;
        $verygood_totalC=0;
        $good_totalC=0;
        $fair_totalC=0;
        $poor_totalC=0;
    $i=0; //print_r($details);die;
    if($details && count($details)>0){
    foreach($details as $data){ 
            switch($data->checkup_rate){
                case 5:
                    $excellent_totalC++;
                    break;
                case 4:
                    $verygood_totalC++;
                    break;
                case 3:
                    $good_totalC++;
                    break;
                case 2:
                    $fair_totalC++;
                    break;
                case 1:
                    $poor_totalC++;
                    break;
                default:
                    break;
            }
            switch($data->hospital_rate){
                case 5:
                    $excellent_totalH++;
                    break;
                case 4:
                    $verygood_totalH++;
                    break;
                case 3:
                    $good_totalH++;
                    break;
                case 2:
                    $fair_totalH++;
                    break;
                case 1:
                    $poor_totalH++;
                    break;
                default:
                    break;
            }
    }
    }
    ?>


<?php 
        //Hospital rate
        $excellentHper=($excellent_totalH>0)?round(($excellent_totalH/$total_patient)*100,0):''; 
        $verygoodHper=($verygood_totalH>0)?round(($verygood_totalH/$total_patient)*100,0):''; 
        $goodHper=($good_totalH>0)?round(($good_totalH/$total_patient)*100,0):''; 
        $fairHper=($fair_totalH>0)?round(($fair_totalH/$total_patient)*100,0):''; 
        $poorHper=($poor_totalH>0)?round(($poor_totalH/$total_patient)*100,0):'';
        //Check up rate
        $excellentCper=($excellent_totalC>0)?round(($excellent_totalC/$total_patient)*100,0):''; 
        $verygoodCper=($verygood_totalC>0)?round(($verygood_totalC/$total_patient)*100,0):''; 
        $goodCper=($good_totalC>0)?round(($good_totalC/$total_patient)*100,0):''; 
        $fairCper=($fair_totalC>0)?round(($fair_totalC/$total_patient)*100,0):''; 
        $poorCper=($poor_totalC>0)?round(($poor_totalC/$total_patient)*100,0):'';

?>
<!--Start footer-->
<div style="position:relative">
<?=$footer;?>
</div>
 <script>
              new Chart(document.getElementById("pieChart"),
              {"type":"pie","data":{"labels":["Excellent", "Very Good", "good", "Fair", "Poor"],
              "datasets":[{"label":"My First Dataset","data":[<?=$excellentHper?>, <?=$verygoodHper?>, <?=$goodHper?>, <?=$fairHper?>, <?=$poorHper?>],
              "backgroundColor":["#4472C4","#ED7E33","#A5A5A5","#FFC000","#5B9BD5"]}]}});

              new Chart(document.getElementById("pieChart2"),
              {"type":"pie","data":{"labels":["Excellent", "Very Good", "good", "Fair", "Poor"],
              "datasets":[{"label":"My First Dataset","data":[<?=$excellentCper?>, <?=$verygoodCper?>, <?=$goodCper?>, <?=$fairCper?>, <?=$poorCper?>],
              "backgroundColor":["#4472C4","#ED7E33","#A5A5A5","#FFC000","#5B9BD5"]}]}});
            </script>
              <script>
              new Chart(document.getElementById("doughnutChart"),
              {"type":"doughnut","data":{"labels":["Promoter (9+10)", "Neutral(7+8)", "Detractor(0-6)"],
              "datasets":[{"label":"My First Dataset","data":[8,4,1],
              "backgroundColor":["rgb(255, 99, 132)","rgb(0, 255, 0)",
              "rgba(77, 175, 124, 1)"]}]}});</script>
<!--End footer-->