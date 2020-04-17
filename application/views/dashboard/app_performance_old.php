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
		<div class="page-title-right">
		<h6 class="page-title-heading mr-0 mr-r-5"><?= date('d-m-Y'); ?>&nbsp;<span id="curtime"></span></h6>
		<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
	</div>

        
<div class="row" style="background: #f0f0f0;">
    <div class="col-md-4" style="line-height: 20px;top: 10px;">
        <div class="col-md-2" style="float: left;text-align: right;">
            <img src="<?php echo base_url().'assets\img\icon\total_instal_1.png'; ?>">
        </div>
        <div class="col-md-10" style="float: left;">
            <p style="font-size: 15px;font-weight: 600;"><?=$TotalInstallation; ?> Installation in total<span style="font-size: 10px;font-weight: 500;"> (In Number)</span>
            <br><span style="font-size: 12px;font-weight: 500;">+ <?=$Last30DaysRecord; ?> installation in past 30 days</span></p>
        </div>
    </div>      
             <?php 
            $totalweek=($datediff>0)?round($datediff/7,0):'';
            $avgdailyActive=($dailyActive>0 && $datediff>0)?round($dailyActive/$datediff,0):'';
            if($avgdailyActive==0){
                $avgdailyActive=($dailyActive>0 && $datediff>0)?round($dailyActive/$datediff,2):'';
            }
            $avgweeklyActive=($dailyActive>0 && $totalweek>0)?round($dailyActive/$totalweek,0):'';
            if($avgweeklyActive==0){
                $avgweeklyActive=($dailyActive>0 && $totalweek>0)?round($dailyActive/$totalweek,2):'';
            }
            ?>
    <div class="col-md-4" style="line-height: 20px;top: 10px;">
        <div class="col-md-2" style="float: left;text-align: right;">
            <img src="<?php echo base_url().'assets\img\icon\user_active_1.png'; ?>">
        </div>
        <div class="col-md-10">
            <p style="font-weight: 600;line-height: 40px;"><?=$avgdailyActive; ?> Daily active uses<span style="font-size: 10px;font-weight: 500;"> (In Average)</span></p>
        </div>
    </div>         
            
    <div class="col-md-4" style="line-height: 20px;top: 10px;">
        <div class="col-md-2" style="float: left;text-align: right;">
            <img src="<?php echo base_url().'assets\img\icon\user_active_1.png'; ?>">
        </div>
        <div class="col-md-10">
            <p style="font-weight: 600;line-height: 40px;"><?=$avgweeklyActive; ?> Weekly active users<span style="font-size: 10px;font-weight: 500;"> (In Average)</span></p>
        </div>
    </div>         
</div>
<div class="row" style="background: #fff;height: 10px;"></div>        
        
        
<div class="widget-list row">
<div class="widget-holder widget-full-height widget-flex col-lg-6">
    <div class="widget-bg">
        <div class="widget-heading" style="display: block;">
                        <div class="row" style="margin-bottom: -25px;">
                        <div class="col-md-7" style="background: #8dc63f;padding: 10px;width: 300px;height: 42px;color: #fff !important;border-top-right-radius: 50px 20px;border-left: 3px solid #fff;"><h5 class="widget-title" style="color: #fff;">Monthly installation (In Number)</h5></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
			<div class="form-group">
                            <select class="form-control year" name="year" style="color: #00ADEE;background: #F4F4F4;">
                                <?php for($i=2019;$i<=3019;$i++){ ?>
                                    <option value="<?php echo $i; ?>"  <?php echo (date("Y")==$i)?'selected':''; ?>><?php echo $i; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
			</div>
			</div>
                        </div>
        <div class="widget-body" style="width: 96%;height:200px;border: 2px solid;">
            <div class="mr-t-10 flex-1">
                <div style="max-height: 270px; height: 270px" id="graph-container1">
                     <canvas id="chartjs-0" height="200"></canvas>
                </div><p> </p>
            </div>
        </div>
        
    </div>
</div>
<div class="widget-holder widget-full-height widget-flex col-lg-6">
        <div class="widget-bg">
                        <div class="widget-heading" style="display: block;">
                        <div class="row" style="margin-bottom: -25px;">
                        <div class="col-md-7" style="background: #8dc63f;padding: 10px;width: 300px;height: 42px;color: #fff !important;border-top-right-radius: 50px 20px;border-left: 3px solid #fff;"><h5 class="widget-title" style="color: #fff;">Daily installation (In Number)</h5></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
			<div class="form-group">
                            <select class="form-control week" name="week" style="color: #00ADEE;background: #F4F4F4;">
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
                                <div style="max-height: 270px; height: 270px"  id="graph-container2">
                                     <canvas id="chartjs-1" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</div>
<div style="display: inline-block;"></div>
            <div class="row">
            <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading" style="display: block;">
                        <div class="row" style="margin-bottom: -25px;">
                        <div class="col-md-8" style="background: #8dc63f;padding: 10px;width: 300px;height: 42px;color: #fff !important;border-top-right-radius: 50px 20px;"><h5 class="widget-title" style="color: #fff;">OS ( Operating System) (In Number)</h5></div>
                        <div class="col-md-1"></div>
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
                                <div style="max-height: 270px; height: 270px" id="graph-container3">
                                     <canvas id="chartjs-3" height="200"></canvas>
                                </div>
                                                                <p> </p>
                            </div>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
            </div>
            <hr>
            </div>
        </main>

<!--Start footer-->
<div style="position:relative">
<?=$footer;?>
</div>
<script>
      $(function(){
         $('.year').trigger("change");
         $('.week').trigger("change");
         $('.month').trigger("change");
         
     })
//monthly
$(document).on('change','.year',function(){
$.post('<?=base_url();?>dashboard/yearly_app_info',{year:$(this).val()},function(data){
			var dt=JSON.parse(data);
			var labelsArray = [];
			var amountArray = [];
			if(dt){
				for (var i = 0; i < dt.length; i++) {
					labelsArray.push(dt[i].month);
					amountArray.push(dt[i].monthdata);
				}
			}
              
			$('#chartjs-0').remove(); // this is my <canvas> element
			$('#graph-container1').append('<canvas id="chartjs-0"><canvas>');

      new Chart(document.getElementById("chartjs-0"),
    {"type":"line","data":{"labels":labelsArray,
    "datasets":[{"label":"Monthly dataset","data":amountArray,"fill":false,
    "borderColor":"#5B9BD5","lineTension":1}
  ]}, "options":{"scales":{"yAxes":[{"ticks":{'precision': 0,}}]}}});
  
  });
  });
  </script>



<script>
//daily
$(document).on('change','.week',function(){
$.post('<?=base_url();?>dashboard/Dailyweekwise_app_info',{week:$(this).val()},function(data){
                        var dt=JSON.parse(data);
			var labelsArray = [];
			var amountArray = [];
			if(dt){
				for (var i = 0; i < dt.length; i++) {
					labelsArray.push(dt[i].day);
					amountArray.push(dt[i].dailydata);
				}
			}
              
			$('#chartjs-1').remove(); // this is my <canvas> element
			$('#graph-container2').append('<canvas id="chartjs-1"><canvas>');
    

Chart.defaults.global.legend.display = false;
new Chart(document.getElementById("chartjs-1"),
    {"type":"line","data":{"labels":labelsArray,
  "datasets":[{"label":"Daily dataset","data":amountArray,"fill":false,
  "borderColor":"#5B9BD5","lineTension":0.1}]},"options":{"scales":{"xAxes":[{"ticks":{"beginAtZero":true}}]}}});
  });
  })
  </script>





<script>
     
     $(document).on('change','.month',function(){
        $.post('<?=base_url();?>dashboard/MonthwiseWeeklyOS_app_info',{month:$(this).val()},function(data){
			var dt=JSON.parse(data);
			var weekdataAndroid = [];
			var weekdataIOS = [];
			var weekArray = [];
			var colorIOS = [];
			var colorAndroid = [];
			if(dt){
				for (var i = 0; i < dt.length; i++) {
					weekdataAndroid.push(dt[i].weekdataAndroid);
					weekdataIOS.push(dt[i].weekdataIOS);
                                        weekArray.push(dt[i].week);
                                        colorIOS.push('#4472C4');
                                        colorAndroid.push('#ED7D31');
				}
			}
			$('#chartjs-3').remove(); // this is my <canvas> element
			$('#graph-container3').append('<canvas id="chartjs-3"><canvas>');
                    Chart.defaults.global.legend.display = false;
                    new Chart(document.getElementById("chartjs-3"),
                    {"type":"bar","data":{"labels":weekArray,
                    "datasets":[
                    {"label":"IOS","data":weekdataIOS,
                    "backgroundColor":colorIOS
                    ,"lineTension":0.1},
                    {"label":"Android","data":weekdataAndroid,
                    "backgroundColor":colorAndroid,
                    "borderColor":"#5B9BD5","lineTension":0.1}]},"options":{}});
      
      });
      })
  </script>


<script>
function myFunction() {
  var d = new Date();
  var n = d.toLocaleTimeString();
  document.getElementById("curtime").innerHTML = n;
}
setInterval(function(){myFunction();},1000);
//setInterval(myfunction, 1000);
</script>
<!--End footer-->