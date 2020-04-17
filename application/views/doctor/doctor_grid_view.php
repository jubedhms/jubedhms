<style>
    .pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    /*color: #337ab7;*/
    text-decoration: none;
    /*background-color: #fff;*/
    border: 1px solid #ddd;
}
.highlight{
    background-color: #d3d3d3;
    color: #fff !important;
}
</style>
<div class="col-md-12 widget-holder">
                    <div class="widget-bg">
                        <!--Grid searching-->
                        
                        <!--End-->
                        <div class="widget-body clearfix">
                            <h5 class="box-title border-bottom"><span style="visibility:hidden;">Grid View<span></h5>
                            <?php 
                                if($details && count($details)>0){ ?>
                            <div class="row m-0">
                                <?php 
                                foreach($details as $data){ ?> 
                                <div class="col-sm-3 col-md-3 card border-1 DoctorView">
                                    <div class="text-center">
                                            <header style=" top: 10px; position: relative; ">
                                                <figure class="">
                                                    <img class="rounded-circle" src="<?=base_url(); ?><?=($data->image)?$data->image:'data/patient-profile-image/patient_default.png' ?>" alt="" style="width: 100px;height: 110px;">
                                                </figure>
                                            </header>
                                            <section style="text-align: left;">
                                                <div style="margin-left:12px;" class="DoctorSearch">
                                                    <h6><b class="icon-box-title fw-300 doctor_name"><?=$data->name;?></b></h6>
                                                    <div><?= $data->primary_specialty_name ?></div>
                                                    <div><b>MCR:-<?=$data->mcr;?></b></div>
                                                    <!--<div><?php //$data->country_code;?></div>-->
                                                    <div><?=$data->contry_name;?></div>
                                                </div>
                                                <div>
                                                    
                                                    <?php if(checkModulePermission($MODULEID,'edit_btn')){?>
                                                        <a href="doctor/addedit_doctor/<?=MD5($data->ID);?>" class='btn btn-success btn-sm action-btn' style='width: 40px;background: #8dc63f;height: 22px;border: 1px solid;margin:0 1px 0 0;'>Edit</a>
                                                        <?php } ?>
                                                        <?php if(checkModulePermission($MODULEID,'delete_btn')){?>
                                                        <!-- <a href="javascript:void(0)" class='single_delete btn btn-danger btn-sm action-btn' id="doctor/deleteData/<?php //md5($data->ID);?>" style='margin:0 1px 0 0;width: 46px;height: 22px;background: #808183;border: 1px solid #808183;'>Delete</a> -->
                                                        <?php } ?>
                                                        
                                                        <?php if(checkModulePermission("37",'view_btn') && $data->mcr!=''){ ?>
                                                            <a href="doctor/view_doctor/<?=MD5($data->ID);?>" class='btn btn-info btn-sm action-btn' style='margin:0 1px 0 0;width: 40px;height: 22px;'>View</a>
                                                        <?php } ?>
                                                        <?php if(checkModulePermission($MODULEID,'edit_btn')){?>
                                                        <!--<a href="javascript:void(0)" class='open_popup_avalability btn btn-orange btn-sm action-btn' style='width: 80px;height: 22px;margin:0px 1px 1px 0;' data-url="<?php //base_url(). 'doctor/addedit_avalability/' ?><?php //MD5($data->ID);?>">Availability</a>-->
                                                        <?php } ?>
                                                         <?php if(checkModulePermission("38",'view_btn') && $data->mcr!=''){ ?>
                                                            <!-- <a href="doctor_appointment?mcr=<?php // MD5($data->mcr);?>" class='btn btn-info btn-sm action-btn' style='width: 90px;height: 22px;margin:5px 5px 5px 0;'>Appointment</a> -->
                                                            <!-- <a href="vaccine_appointment?mcr=<?php // MD5($data->mcr);?>" class='btn btn-info btn-sm action-btn' style='width: 135px;height: 22px;margin:5px 5px 5px 0;'>Vaccine Appointment</a> -->
                                                         <?php } ?>
                                                        
                                                </div>
                                            </section>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                
                            </div>
                                        <div class="border-bottom" style="margin-bottom: 10px;"></div>
                                        <?php $total_of=($start_of>1)?($start_of*$limit)-11:$start_of; 
										$tilltotal=(($start_of*$limit)>$total_data)?$total_data:($start_of*$limit)
										?>
                                        <?php if($total_data>10){ ?>
                                        <ul class="pull-left" style="left: -41px;position: relative;"><?php echo "Showing ".$total_of." to ".$tilltotal." of ".$total_data." total entries"; ?></ul>
                                        <?php } ?>
                                        <ul class="pagination pull-right"><?php echo "<li>". $links."</li>"; ?></ul>
                                <?php }else{ ?>
                            <p style="text-align: center;font-size: 15px;"><span>No data available.</span></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

<script>
        //Search the patient in the chat bot
    // $(document).ready(function(){
        // $(".gridviewSearch").keyup(function(){
        // var filter = $(this).val();
        
        // $("section").each(function(){
            // if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                // $(this).closest('.DoctorView').fadeOut();
            // } else {
                // $(this).closest('.DoctorView').show();
            // }
        // });
    // });
    // });
    $(document).ready(function(){
        $(".gridviewSearchbtn").click(function(){
            var searchDoctor=$('.gridviewSearch').val();
            //if(searchDoctor){
            $('select[name="view_type"]').trigger('change');
            //}
         
    });
    });
    // $(document).ready(function(){
    //     $(".gridviewSearch").blur(function(){
    //         var searchDoctor=$('.gridviewSearch').val();
    //         if(searchDoctor){
    //         $('select[name="view_type"]').trigger('change');
    //         }
         
    // });
    // });
    //End
    
    
</script>
