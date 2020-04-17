<!--Start header-->
<?= $header; ?>
<!--End header-->

<?php
$ID = (isset($details->ID)) ? $details->ID : "";

$url1 = ($this->uri->segment(1) != '') ? $this->uri->segment(1) : '';
$url2 = ($this->uri->segment(2) != '') ? $this->uri->segment(2) : '';
$url3 = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : '';
$url4 = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : '';
$curr_url = $url1 . '/' . $url2 . '/' . $url3 . '/' . $url4;
?>
<style>
/*    ::-webkit-scrollbar {
        width: 5px;
    }
    ::-moz-scrollbar {
        width: 5px;
    }*/
    .doctor_dept p {
        margin-bottom: 0px;
        /*margin-bottom: -11px;*/
    }
    .cert_award_description_vi{display: none}
    .experience_description_vi{display: none}
    .education_description_vi{display: none}
    .experience_to_vi{display: none}
    .p_exp_year::after{content: Years}
    /*.age,.income,.relationship,.location,.gender,.deliveryathph{
        display: none;
    }*/
</style>
<!-- Start page-->
<?php //print_r($details);die; ?>
<main class="main-wrapper clearfix">
    <span class="action-message"><?= getFlashMsg('success_message'); ?></span>

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5"><?= $mode . ' ' . $heading; ?></h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $main_page; ?>">User</a>
                </li>
                <li class="breadcrumb-item active"><?= $mode . ' ' . $heading; ?></li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <ul class="nav nav-tabs pull-left">
                    <li class="nav-item language" tabval='2' aria-expanded="false">
                        <a class="nav-link active" href="javascript:void(0);" data-toggle="tab" aria-expanded="true">English</a>
                    </li>
                    <li class="nav-item language" tabval='1'>
                        <a class="nav-link" href="javascript:void(0);" data-toggle="tab" aria-expanded="false">Vietnamese</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="review">
        <form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post">
            <div class="widget-list">
                <div class="row">
                    <div class="col-md-12 widget-holder">
                        <div class="widget-bg">
                            <div class="widget-body clearfix">

                                <div class="row">
                                    <div class="col-md-8 widget-holder">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="ID" value="<?= ($ID != '') ? md5($ID) : ''; ?>">
                                                    <?php if ($ID != '') { ?>
                                                        <input type="hidden" class="DID" name="doctorID" value="<?= $ID; ?>">
                                                    <?php } ?>
                                                    <label for="mcr" class="doctor_mcr">Doctor MCR *</label>
                                                    <input type="text" class="form-control checkNotExistDoctorMCR" name="mcr" id="mcr"  value="<?= getFieldVal('mcr', $details); ?>" <?= (getFieldVal('mcr', $details) != '') ? "disabled" : "" ?> required="required" size="50" minlength="4" maxlength="50" data-rule-required="true" data-msg-required="Please include your MCR">
                                                    <span class="error" style="display: none;">
                                                        <i class="error-log fa fa-exclamation-triangle"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 title_en">
                                                <div class="form-group">
                                                    <label for="title" class="">Title</label>
                                                    <select class="form-control" id="title" name="title">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $titles = array('Ph.D', 'M.D', 'Prof.', 'Assoc. Prof.', 'Other');
                                                        //$titles=array('Mr','Mrs','Miss','Ms','Dr','Prof','Rev','Other');
                                                        if ($titles && count($titles) > 0) {
                                                            foreach ($titles as $title) {
                                                                ?>
                                                                <option value="<?= $title; ?>" <?= ($title == getFieldVal('title', $details)) ? "selected" : ""; ?>><?= $title; ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <input type="text" class="form-control other_title <?php echo (isset($details->title) && $details->title == 'Other') ? '' : 'hidden'; ?> " value="<?php echo (isset($details->title_other) && $details->title == 'Other') ? $details->title_other : ''; ?>" id="title_other" name="title_other" placeholder='Enter other title'>
                                                    <!--<span class="title_error" style="display: none;">Please select Title.</span>-->  
                                                </div>
                                            </div>
                                            <div class="col-md-6 title_vi" style="display:none;">
                                                <div class="form-group">
                                                    <label for="title_vi" >HỌC VỊ</label>
                                                    <select class="form-control" id="title_vi" name="title_vi">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $titles_vi = array('Tiến sỹ', 'Thạc sỹ', 'Giáo sư', 'Phó giáo sư', 'Other');
                                                        //$titles=array('Mr','Mrs','Miss','Ms','Dr','Prof','Rev','Other');
                                                        if ($titles_vi && count($titles_vi) > 0) {
                                                            foreach ($titles_vi as $title_vi) {
                                                                ?>
                                                                <option value="<?= $title_vi; ?>" <?= ($title_vi == getFieldVal('title_vi', $details)) ? "selected" : ""; ?>><?= $title_vi; ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <input type="text" class="form-control other_title_vi <?php echo (isset($details->title_vi) && $details->title_vi == 'Other') ? '' : 'hidden'; ?> " value="<?php echo (isset($details->title_other_vi) && $details->title_vi == 'Other') ? $details->title_other_vi : ''; ?>" id="title_other_vi" name="title_other_vi" placeholder='Enter other title'>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 position_en">
                                                <div class="form-group">
                                                    <label for="position">Position *</label>
                                                    <select class="form-control" id="position" name="position" required="required" data-rule-required="true" data-msg-required="Please select position.">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $position = array('Head of Department', 'Deputy', 'Specialist level I', 'Specialist level II','Doctor', 'Other');
                                                        if ($position && count($position) > 0) {
                                                            foreach ($position as $position) {
                                                                ?>
                                                                <option value="<?= $position; ?>" <?= ($position == getFieldVal('position', $details)) ? "selected" : ""; ?>><?= $position; ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <input type="text" class="form-control other_position <?php echo (isset($details->position) && $details->position == 'Other') ? '' : 'hidden'; ?>" value="<?php echo (isset($details->position_other) && $details->position == 'Other') ? $details->position_other : ''; ?>" id="position_other" name="position_other" placeholder='Enter other position'>
                                                    <span class="position_error" style="display: none;">Please select Position.</span>  
                                                </div>
                                            </div>		
                                            <div class="col-md-6 position_vi" style="display:none;">
                                                <div class="form-group">
                                                    <label for="position_vi">CHỨC VỤ</label>
                                                    <select class="form-control" id="position_vi" name="position_vi">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $position_vi = array('Trưởng khoa', 'Phó khoa', 'Bác sỹ CKI', 'Bác sỹ CKII','Bác sỹ', 'Other');
                                                        if ($position_vi && count($position_vi) > 0) {
                                                            foreach ($position_vi as $position_vi) {
                                                                ?>
                                                                <option value="<?= $position_vi; ?>" <?= ($position_vi == getFieldVal('position_vi', $details)) ? "selected" : ""; ?>><?= $position_vi; ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <input type="text" class="form-control other_position_vi <?php echo (isset($details->position_vi) && $details->position_vi == 'Other') ? '' : 'hidden'; ?>" value="<?php echo (isset($details->position_other_vi) && $details->position_vi == 'Other') ? $details->position_other_vi : ''; ?>" id="position_other_vi" name="position_other_vi" placeholder='Enter other position'>
                                                   
                                                </div>
                                            </div>		




                                            <div class="col-md-6 name_b">
                                                <div class="form-group">
                                                    <label for="name" class="">Name *</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?= getFieldVal('name', $details); ?>" data-rule-required="true" data-msg-required="Please include your Name">
                                                    <span class="name_error" style="display: none;">Please enter Name.</span> 
                                                </div>
                                            </div>
                                            <div class="col-md-6 name_b_vi" style="display:none;">
                                                <div class="form-group">
                                                    <label for="name_vi" class="">HỌ VÀ TÊN</label>
                                                    <input type="text" class="form-control" id="name_vi" name="name_vi" value="<?= getFieldVal('name_vi', $details); ?>">
                                                </div>
                                            </div>
                                            <?php if(1==2){ ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name" class="first_name_b">First name *</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?= getFieldVal('first_name', $details); ?>" data-rule-required="true" data-msg-required="Please include your First Name">
                                                    <span class="error" style="display: none;">
                                                        <i class="error-log fa fa-exclamation-triangle"></i>
                                                    </span>  
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php if(1==2){ ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="middle_name" class="middle_name_b">Middle name</label>
                                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= getFieldVal('middle_name', $details); ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="last_name_b">Last name</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?= getFieldVal('last_name', $details); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="primary_specialty_code" class="primary_specialty_b">Primary Specialty *</label>
                                                    <select class="form-control" id="primary_specialty_code" name="primary_specialty_code"  required="required" data-rule-required="true" data-msg-required="Please select primary specialty.">
                                                        <option value="">Select</option>
                                                        <?php
                                                        if ($doctor_specialization && count($doctor_specialization) > 0) {
                                                            foreach ($doctor_specialization as $specialty) {
                                                                ?>
                                                                <option value="<?= $specialty->code; ?>" <?= ($specialty->code == getFieldVal('primary_specialty_code', $details)) ? "selected" : ""; ?>><?= $specialty->name; ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 specialty_b">
                                                <div class="form-group">
                                                    <label for="" class="">Specialty</label>
                                                    <select class="form-control specialty" id="profile_specialty" name="profile_specialty">
                                                        <option value="">Select</option>
                                                        <?php
                                                        if ($profile_specialization && count($profile_specialization) > 0) {
                                                            $dept_code = (isset($details->profile_specialty) && $details->profile_specialty != '') ? $details->profile_specialty : '';
                                                            foreach ($profile_specialization as $pspecialty) {
                                                                ?>
                                                                <option value="<?= $pspecialty->ID; ?>" <?= (isset($dept_code) && $pspecialty->ID==$dept_code) ? "selected" : ""; ?>><?= $pspecialty->name; ?></option>
                                                        <?php } } ?>
                                                                <!--<option value="Other">Other</option>-->
                                                    </select>
                                                    <input type="text" class="form-control other_specilty <?php echo (isset($details->profile_specialty_other) && $details->profile_specialty == '10') ? '' : 'hidden'; ?>" value="<?php echo (isset($details->profile_specialty_other) && $details->profile_specialty == '10') ? $details->profile_specialty_other : ''; ?>" id="profile_specialty_other" name="profile_specialty_other" placeholder='Enter other specialty'>
                                                    <span class="specialty_error" style="display: none;">Please select specialty.</span>  
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6 specialty_b_vi" style="display:none;">
                                                <div class="form-group">
                                                    <label for="" class="">CHUYÊN KHOA</label>
                                                    <select class="form-control specialty_vi" id="profile_specialty_vi" name="profile_specialty_vi">
                                                        <option value="">Select</option>
                                                        <?php
                                                        if ($profile_specialization && count($profile_specialization) > 0) {
                                                            $dept_code = (isset($details->profile_specialty) && $details->profile_specialty != '') ? $details->profile_specialty : '';
                                                            foreach ($profile_specialization as $pspecialty) {
                                                                ?>
                                                                <option value="<?= $pspecialty->ID; ?>" <?= (isset($dept_code) && $pspecialty->ID==$dept_code) ? "selected" : ""; ?>><?= $pspecialty->name_vi; ?></option>
                                                        <?php } } ?>
                                                                <!--<option value="Other">Other</option>-->
                                                    </select>
                                                    <input type="text" class="form-control other_specilty_vi <?php echo (isset($details->profile_specialty_other_vi) && $details->profile_specialty_vi == '10') ? '' : 'hidden'; ?>" value="<?php echo (isset($details->profile_specialty_other_vi) && $details->profile_specialty_vi == '10') ? $details->profile_specialty_other_vi : ''; ?>" id="profile_specialty_other_vi" name="profile_specialty_other_vi" placeholder='Enter other specialty'>
                                                    <span class="specialty_vi_error" style="display: none;">Please select specialty.</span>  
                                                    
                                                </div>
                                            </div>
                                        </div>   


                                        <div class="row">
                                        <div class="col-md-6 widget-holder">
                                            <div class="widget-bg">
                                                <div class="widget-body---">
                                                    <div class="col-md-12">
                                                        <label for="image" class="image_b">PROFILE PICTURE</label>
                                                        <input type="file" class="form-control choose-image" id="image" name="image" accept=".jpg,.jpeg,.png" data-min-size="10" data-max-size="1000" table-id="<?= $ID; ?>" action="<?= $this->main_page; ?>/change_image" show-image-src=".view_image" show-image-href=".image-lightbox" <?= ($ID == '') ? 'data-rule-required="true" data-msg-required="Please select Doctor profile image"' : ''; ?> style="opacity:0;height:0px;width:0px;">
                                                        <span class="error" style="display:none;margin-left:-237px">
                                                            <i class="error-log fa fa-exclamation-triangle"></i>
                                                        </span>
                                                    </div>
                                                    <?php //if(getFieldVal('image', $details)!= ''){ ?>
                                                    <div class="col-md-12" style="width: 180px;border: 1px solid #f0f0f0;margin-bottom: 3px;">
                                                        <div style="margin-left: 28px;">
                                                            <img style="height: 110px;width: 100px;border:1px solid;border-radius: 50%;" alt="image" class="view_image img" src="<?= (getFieldVal('image', $details) != '') ? base_url(getFieldVal('image', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div style="width: 70px;float: left;<?php echo (getFieldVal('image', $details) != '')?'':'pointer-events: none;opacity: .3;'; ?>" img="<?php echo $details->image; ?>" class="remove_doc_image" onclick="remove_doc_image(this);">
                                                            <!--<span class="btn btn-xs btn-info">Remove</span>-->
                                                        </div>	
                                                        <div style="width: 110px;float: left;" class="change_doc_image" onclick="change_doc_image();">
                                                            <!--<span class="btn btn-xs btn-info">Change Image</span>-->
                                                        </div>	
                                                    </div>
                                                    <?php //}?>
                                                    <div class="col-md-12" style="display:none;" >
                                                        <div class="blog-post">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <input type="file" class="form-control choose-image doctor_image" data-iddoctor="1" id="image" name="image" accept=".jpg,.jpeg,.png" data-min-size="10" data-max-size="1000" table-id="<?= $ID; ?>" action="<?= $this->main_page; ?>/change_image" show-image-src=".view_image" show-image-href=".image-lightbox" <?= ($ID == '') ? 'data-rule-required="true" data-msg-required="Please select Doctor profile image"' : ''; ?>>  
                                                            </div>
                                                            <!--</header>-->
                                                        </div>	
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                            
                                            <div class="col-md-6 level_b">
                                                <div class="form-group">
                                                    <label for="level" class="level">Level </label>
                                                    <select class="form-control" id="level" name="level">
                                                        <option value="">Select</option>
                                                                <option value="Standard" <?php echo (isset($details->level) && $details->level=='Standard')?'selected':''; ?> >Standard</option>
                                                                <option value="Senior" <?php echo (isset($details->level) && $details->level=='Senior')?'selected':''; ?> >Senior</option>
                                                                <option value="Expert" <?php echo (isset($details->level) && $details->level=='Expert')?'selected':''; ?> >Expert</option>
                                                                <option value="Foreign Expert" <?php echo (isset($details->level) && $details->level=='Foreign Expert')?'selected':''; ?> >Foreign Expert</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 level_b_vi" style="display:none;">
                                                <div class="form-group">
                                                    <label for="level_vi" class="level">Cấp độ </label>
                                                    <select class="form-control" id="level_vi" name="level_vi">
                                                        <option value="">Select</option>
                                                                <option value="Tiêu chuẩn" <?php echo (isset($details->level_vi) && $details->level_vi=='Tiêu chuẩn')?'selected':''; ?> >Tiêu chuẩn</option>
                                                                <option value="Cao cấp" <?php echo (isset($details->level_vi) && $details->level_vi=='Cao cấp')?'selected':''; ?> >Cao cấp</option>
                                                                <option value="Chuyên gia" <?php echo (isset($details->level_vi) && $details->level_vi=='Chuyên gia')?'selected':''; ?> >Chuyên gia</option>
                                                                <option value="Chuyên gia nước ngoài" <?php echo (isset($details->level_vi) && $details->level_vi=='Chuyên gia nước ngoài')?'selected':''; ?> >Chuyên gia nước ngoài</option>
                                                    </select>
                                                </div>
                                            </div>


                                    </div>
                                        


                                    </div>

                                    <!-- Start upload Image-->
                                    <div class="col-md-4 widget-holder">
                                        <div class="row border" style=" background: #f0f0f0;max-height: 500px;"﻿>
                                            <div class="text-inverse col-md-12" style="background: #00b1f3;">
                                                <span><i class="feather feather-menu list-icon fs-20"></i> &nbsp;Preview</span>
                                                <span><i class="" aria-hidden="true"></i></span>
                                                <div class="pull-right">
                                                    <span><i class="fa fa-phone" aria-hidden="true"></i></span> &nbsp;
                                                    <span><i class="fa fa-bell-o" aria-hidden="true"></i></span> &nbsp;
                                                </div>
                                            </div>
                                            <div style="height: 150px;width: 100%;">
                                                <!--picture-->
                                                <figure id="awareness_image">
                                                    <a href="javascript:void(0)" style="cursor:auto;">
                                                        <img style="width: 100%;height: 150px;" class="banner_image img" src="<?= base_url() . $banner; ?>" >
                                                    </a>	
                                                </figure>
                                            </div>
                                            <div style="height: 80px;width: 100%;">
                                                <div style="float: left;width: 26%;">
                                                    <img style="width: 60px;border-radius: 50%;top: -20px;left: 10px;height: 60px;position: relative;" class="view_image img" src="<?= (getFieldVal('image', $details) != '') ? base_url(getFieldVal('image', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" >
                                                </div>
                                                <div style="float: left;left: 20px;position: relative;width: 66%;overflow-y: scroll;max-height: 80px;line-height: 15px;">
                                                    <div style="line-height: 14px; "﻿>
                                                        <input type="hidden" class="hospital_name" value="<?php echo isset($details->hospital_name) ? 'HANH PHUC International' : ''; ?>">
                                                        <span class='doctor_name' style="color:#000;font-size: 12px;"></span><br>
                                                        <span class='doctor_specialty' style="color:#000;font-size: 12px;"></span><br><br><!--display: contents;word-break: break-all;-->
                                                        <div class='doctor_dept' style="font-size: 11px;"﻿></div><p style="margin-bottom: 7px !important;"></p>
                                                        <div style="font-size: 11px;"﻿><i class="fa fa-user-md" aria-hidden="true"></i> &nbsp;<span class='profesnl_exp_year' style="font-size: 11px;">Years of professional experience:</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--end picture-->
                                            <div class="education_info" style='padding: 5px 0 0 5px;background-color:#8dc63f;width: 60%;max-height: 45px;font-size: 11px;color: #fff;border-top-right-radius: 28px 20px;'>
                                                Professional Qualifications
                                            </div>
                                            <div class="education" style='padding: 5px 0 0 5px;background-color:#fff;width: 100%;min-height: 70px;max-height: 70px;overflow-y: scroll;font-size: 11px;'>

                                            </div>

                                            <div class="medical_exp_b_app" style='padding: 5px 0 0 5px;background-color:#8dc63f;width: 60%;max-height: 45px;font-size: 11px;color: #fff;border-top-right-radius: 28px 20px;'>
                                                Medical Experience
                                            </div>
                                            <div class="experience" style='padding: 5px 0 0 5px;background-color:#fff;width: 100%;max-height: 120px;overflow-y: scroll;font-size: 11px;'>

                                            </div>

                                            <!--                    <div class="app_discriptiion" style='padding: 5px 0 0 5px;width: 100%;height: 230px;overflow-y: scroll;font-size: 12px;color: #000;'>
                                                                    <p></p>
                                                                </div>-->

                                            <div style="width: 100%;">
                                                <img src="<?php echo base_url() . 'assets/img/footer_app.jpeg'; ?>" style='width:100%'>
                                            </div> 

                                        </div>
                                    </div>
                                    <!-- End upload Image-->
                                </div>

<?php if (empty($ID)) { ?>
                                    <div class="row">
                                        <!--<div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="password" class="">Password *</label>
                                                        <input type="password" class="form-control" id="password" name="password" value="<?php //getFieldVal('password',$details); ?>" data-rule-required="true" data-msg-required="Please include your password">
                                                        <span class="error" style="display: none;">
                                                        <i class="error-log fa fa-exclamation-triangle"></i>
                                                        </span>
                                                </div>
                                        </div>-->
                                    </div>
<?php } ?>
<?php if (1 == 2) { ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email_id" class="">Email address *</label>
                                                <input type="email" class="form-control" id="email_id" name="email_id" value="<?= getFieldVal('email_id', $details); ?>" data-rule-required="true" data-msg-required="Please include your Email address">
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contact_number" class="">Contact number  *</label>
                                                <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= getFieldVal('contact_number', $details); ?>" size="10" minlength="10" maxlength="10" required="required" data-rule-required="true" data-msg-required="Please input contact number.">
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="alternet_contact_number" class="">Alternet contact number</label>
                                                <input type="text" class="form-control" id="alternet_contact_number" name="alternet_contact_number" value="<?= getFieldVal('alternet_number', $details); ?>" size="10" minlength="10" maxlength="10">
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row"> 	
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="blood_group" class="">Blood Group </label>
                                                <select class="form-control" id="blood_group" name="blood_group">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $blood_groups = array('A+', 'AB+', 'O+', 'AB', 'B+', 'A-', 'b-', 'O-');
                                                    if ($blood_groups && count($blood_groups) > 0) {
                                                        foreach ($blood_groups as $blood_group) {
                                                            ?>
                                                            <option value="<?= $blood_group; ?>" <?= ($blood_group == getFieldVal('blood_group', $details)) ? "selected" : ""; ?>><?= $blood_group; ?></option>
        <?php }
    } ?>
                                                </select>
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div>	

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender" class="">Gender *</label>
                                                <select class="form-control" id="gender" name="gender" required="required" data-rule-required="true" data-msg-required="Please select gender.">
                                                    <option value="">Select</option>
                                                    <option value="1" <?= (getFieldVal('gender', $details) == '1') ? "selected" : ""; ?>>Male</option>
                                                    <option value="2" <?= (getFieldVal('gender', $details) == '2') ? "selected" : ""; ?>>Female</option>
                                                    <option value="3" <?= (getFieldVal('gender', $details) == '3') ? "selected" : ""; ?>>Other</option>
                                                </select>
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div> 

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dob" class="">DOB *</label>
                                                <input id="dob" name="dob" class="form-control datepicker" required="required" type="text" value="<?= isset($details->dob) ? date('Y-m-d', strtotime($details->dob)) : date('Y-m-d'); ?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd","endDate":"<?= date('Y-m-d'); ?>"}' data-rule-required="true" data-msg-required="Please select Date Of Birth.">
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span> 
                                            </div>
                                        </div>
                                    </div>  
<?php } ?>

                                <div class="row description_en">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="">Profile Descriptions</label>
                                            <textarea name="description" class="form-control description_profile"  rows="4" placeholder=""><?= (isset($details->description)) ? $details->description : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row description_vi" style="display:none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description_vi" class="">MÔ TẢ HỒ SƠ</label>
                                            <textarea name="description_vi" class="form-control description_profile_vi" rows="4" placeholder=""><?= (isset($details->description_vi)) ? $details->description_vi : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row professional_exp_year">
                                    <div class="col-md-4">
                                        <table class="table table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th class="professional_exp_year_b" style="width: 90%;">YEARS OF PROFESSIONAL EXPERIENCE</th>
                                                    <th class=""></th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                <tr>
                                                    <td><input name="professional_exp_year" class="form-control p_exp_year" value="<?= (isset($details->professional_exp_year)) ? $details->professional_exp_year : ''; ?>" /></td>
                                                    <td class="year_b" style=" line-height: 40px; "﻿>Years</td>
                                                </tr>        
                                            </tbody> 
                                        </table>
                                    </div>
                                </div>                                

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="education" class="education_b">PROFESSIONAL QUALIFICATIONS</label>
                                        <table class="table table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                        <!--<th>From</th>-->
                                                        <!--<th>To</th>-->
                                                    <th class="description_all_b" style="width: 90%;">Description</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody class="add_education">
<?php if (isset($details->educations) && !empty($details->educations)) {
    $i = 0;
    foreach ($details->educations as $edurow) {
        if ($i > 0) { ?>
                                                        <tr>
                                                            <td><input type="hidden" name="education_id[]" value="<?= $edurow->ID; ?>">
                                                                <input type="text" class="form-control education_description" name="education_description[]"  value="<?php echo isset($edurow->description) ? $edurow->description : ''; ?>">
                                                                <input type="text" class="form-control education_description_vi" name="education_description_vi[]"  value="<?php echo isset($edurow->description_vi) ? $edurow->description_vi : ''; ?>" >
                                                            <span class="edu_description_error" style="display: none;">Please enter Description</span>
                                                            </td>
                                                            
                                                        
                                                        </tr>
        <?php } else { ?>
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="education_id[]" value="<?= $edurow->ID; ?>">
                                                                <input type="text" class="form-control education_description" name="education_description[]"  value="<?php echo isset($edurow->description) ? $edurow->description : ''; ?>" >
                                                                <input type="text" class="form-control education_description_vi" name="education_description_vi[]"  value="<?php echo isset($edurow->description_vi) ? $edurow->description_vi : ''; ?>" >
                                                            <span class="edu_description_error" style="display: none;">Please enter Description</span>
                                                            </td>

                                                            
                                                        
                                                        </tr>
        <?php } $i++;
    }
} ?> 
<?php if (!isset($details->educations)) { //add condition  ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control education_description" name="education_description[]"  value="" >
                                                        <input type="text" class="form-control education_description_vi" name="education_description_vi[]"  value="" >
                                                    <span class="edu_description_error" style="display: none;">Please enter Description</span>
                                                    </td>
                                                    
                                                
                                                </tr>
<?php }
if (isset($details->educations) && empty($details->educations) && $ID) {
    ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control education_description" name="education_description[]"  value="" >
                                                        <input type="text" class="form-control education_description_vi" name="education_description_vi[]"  value="" >
                                                        <span class="edu_description_error" style="display: none;">Please enter Description</span>
                                                    </td>
                                                    
                                                
                                                </tr>
<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="experience" class="medical_exp_b">Medical Experience</label>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="from_b" style="width: 20%; ">From</th>
                                                    <th class="to_b" style="width: 20%; ">To</th>
                                                    <th class="description_all_b" style="width: 60%; ">Description</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody class="add_experience">	
<?php if (isset($details->experiences)) {
    $i = 0;
    foreach ($details->experiences as $expurow) {
        if ($i > 0) { ?>
                                                        <tr>
                                                            <td><input type="hidden" name="experience_id[]" value="<?= $expurow->ID; ?>">
                                                                <input type="text" class="form-control" name="experience_from[]" value="<?php echo isset($expurow->from_year) ? $expurow->from_year : ''; ?>" ></td>
                                                            <td>
                                                                <input type="text" class="form-control experience_to" name="experience_to[]" value="<?php echo isset($expurow->to_year) ? $expurow->to_year : ''; ?>" >
                                                                <input type="text" class="form-control experience_to_vi" name="experience_to_vi[]" value="<?php echo isset($expurow->to_year_vi) ? $expurow->to_year_vi : ''; ?>" >
                                                            </td>
                                                            <td>
                                                                <textarea  class="form-control experience_description" name="experience_description[]" >  <?php echo isset($expurow->description) ? $expurow->description : ''; ?></textarea>
                                                                <textarea  class="form-control experience_description_vi" name="experience_description_vi[]" >  <?php echo isset($expurow->description_vi) ? $expurow->description_vi : ''; ?></textarea>
                                                            <span class="medical_description_error" style="display: none;">Please enter Description</span>
                                                            </td>
                                                            
                                                        
                                                        </tr>
        <?php } else { ?>
                                                        <tr>
                                                            <td><input type="hidden" name="experience_id[]" value="<?= $expurow->ID; ?>">
                                                                <input type="text" class="form-control" name="experience_from[]" value="<?php echo isset($expurow->from_year) ? $expurow->from_year : ''; ?>" ></td>
                                                            <td>
                                                                <input type="text" class="form-control experience_to" name="experience_to[]" value="<?php echo isset($expurow->to_year) ? $expurow->to_year : ''; ?>" >
                                                                <input type="text" class="form-control experience_to_vi" name="experience_to_vi[]" value="<?php echo isset($expurow->to_year_vi) ? $expurow->to_year_vi : ''; ?>" >
                                                            </td>
                                                            <td>
                                                                <textarea  class="form-control experience_description" name="experience_description[]" >  <?php echo isset($expurow->description) ? $expurow->description : ''; ?></textarea>
                                                                <textarea  class="form-control experience_description_vi" name="experience_description_vi[]" >  <?php echo isset($expurow->description_vi) ? $expurow->description_vi : ''; ?></textarea>
                                                            <span class="medical_description_error" style="display: none;">Please enter Description</span>
                                                            </td>
                                                            
                                                        
                                                        </tr>

        <?php } $i++;
    }
} ?> 
                                            <?php if (!isset($details->experiences)) { //add condition ?>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="experience_from[]" value="" ></td>
                                                    <td>
                                                        <input type="text" class="form-control experience_to" name="experience_to[]" value="" >
                                                        <input type="text" class="form-control experience_to_vi" name="experience_to_vi[]" value="" >
                                                    </td>
                                                    <td>
                                                        <textarea  class="form-control experience_description" name="experience_description[]" >  </textarea>
                                                        <textarea  class="form-control experience_description_vi" name="experience_description_vi[]" > </textarea>
                                                    <span class="medical_description_error" style="display: none;">Please enter Description</span>
                                                    </td>
                                                    
                                                
                                                </tr>
                                            <?php } ?> 
<?php if (isset($details->experiences) && empty($details->experiences) && $ID) { ?>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="experience_from[]" value=""></td>
                                                    <td>
                                                        <input type="text" class="form-control experience_to" name="experience_to[]" value="" >
                                                        <input type="text" class="form-control experience_to_vi" name="experience_to_vi[]" value="" >
                                                    </td>
                                                    <td>
                                                        <textarea  class="form-control experience_description" name="experience_description[]" >  </textarea>
                                                        <textarea  class="form-control experience_description_vi" name="experience_description_vi[]" > </textarea>
                                                    <span class="medical_description_error" style="display: none;">Please enter Description</span>
                                                    </td>
                                                    
                                                
                                                </tr>
<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>




                                <div class="row" style="display:none;">
                                    <div class="col-sm-12">
                                        <label for="cert_award_year" class="other_cert_award">Others certificate/ awards</label>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="year_b" style="width: 20%;">Year</th>
                                                    <th class="description_all_b" style="width: 77%;">Description</th>
                                                    <th class="add_delete_b" style="text-align: center;">Add/Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody class="add_award">	
                                            <?php if (isset($details->certificate_award)) {
                                                $i = 0;
                                                foreach ($details->certificate_award as $awardrow) {
                                                    if ($i > 0) { ?>
                                                            <tr>
                                                                <td><input type="hidden" name="certificate_award_id[]" value="<?= $awardrow->ID; ?>">
                                                                    <input type="text" class="form-control" name="cert_award_year[]" value="<?php echo isset($awardrow->from_year) ? $awardrow->from_year : ''; ?>" >
                                                                </td>

                                                                <td>
                                                                    <input type="text" class="form-control cert_award_description" name="cert_award_description[]"  value="<?php echo isset($awardrow->description) ? $awardrow->description : ''; ?>" >
                                                                    <input type="text" class="form-control cert_award_description_vi" name="cert_award_description_vi[]"  value="<?php echo isset($awardrow->description_vi) ? $awardrow->description_vi : ''; ?>" >
                                                                <span class="award_description_error" style="display: none;">Please enter description</span>
                                                                </td>
                                                                <td style="text-align: center;"><span award_id="<?= $awardrow->ID; ?>" class="btn btn-sm btn-danger remove_award" style="margin-right: 28px;">-</span></td>
                                                        
                                                        </tr>
        <?php } else { ?>
                                                        <tr>
                                                            <td><input type="hidden" name="certificate_award_id[]" value="<?= $awardrow->ID; ?>">
                                                                <input type="text" class="form-control" name="cert_award_year[]" value="<?php echo isset($awardrow->from_year) ? $awardrow->from_year : ''; ?>"></td>

                                                            <td>
                                                                <input type="text" class="form-control cert_award_description" name="cert_award_description[]"  value="<?php echo isset($awardrow->description) ? $awardrow->description : ''; ?>" >
                                                                <input type="text" class="form-control cert_award_description_vi" name="cert_award_description_vi[]"  value="<?php echo isset($awardrow->description_vi) ? $awardrow->description_vi : ''; ?>">
                                                            <span class="award_description_error" style="display: none;">Please enter description</span>
                                                            </td>
                                                            <td style="text-align: center;"><span award_id="<?= $awardrow->ID; ?>" class="btn btn-sm btn-primary add_more_award" style="margin-right: 28px;">+</span></td>
                                                        
                                                        </tr>

        <?php } $i++;
    }
} ?> 
<?php if (!isset($details->certificate_award)) { //add condition  ?>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="cert_award_year[]" value="" ></td>

                                                    <td>
                                                        <input type="text" class="form-control cert_award_description" name="cert_award_description[]"  value="" >
                                                        <input type="text" class="form-control cert_award_description_vi" name="cert_award_description_vi[]"  value="" >
                                                    <span class="award_description_error" style="display: none;">Please enter description</span>
                                                    </td>
                                                    <td style="text-align: center;"><span class="btn btn-sm btn-primary add_more_award" style="margin-right: 28px;">+</span></td>
                                                
                                                </tr>
                                <?php } ?> 
                                <?php if (isset($details->certificate_award) && empty($details->certificate_award) && $ID) { ?>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="cert_award_year[]" value=""></td>

                                                    <td>
                                                        <input type="text" class="form-control cert_award_description" name="cert_award_description[]"  value="">
                                                        <input type="text" class="form-control cert_award_description_vi" name="cert_award_description_vi[]"  value="">
                                                    <span class="award_description_error" style="display: none;">Please enter description</span>
                                                    </td>
                                                    <td style="text-align: center;"><span class="btn btn-sm btn-primary add_more_award" style="margin-right: 28px;">+</span></td>
                                                
                                                </tr>
<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>      

<?php if (1 == 2) { ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country_code" class="">Country *</label>
                                                <select class="form-control" id="country_code" name="country_code" required="required" data-rule-required="true" data-msg-required="Please select gender.">
                                                    <option value="">Select</option>
    <?php foreach ($countries as $rowc) { ?>
                                                        <option value="<?= $rowc->country_code1; ?>" <?= (getFieldVal('country_code', $details) == $rowc->country_code1) ? "selected" : ""; ?>> <?= $rowc->name; ?></option>
    <?php } ?>
                                                </select>
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district_code" class="">District *</label>
                                                <select class="form-control" id="district_code" name="district_code" required="required" data-rule-required="true" data-msg-required="Please select gender.">
                                                    <option value="">Select</option>
    <?php foreach ($districts as $row) { ?>
                                                        <option value="<?= $row->district_code; ?>" <?= (getFieldVal('district_code', $details) == $row->district_code) ? "selected" : ""; ?>> <?= $row->name; ?></option>
    <?php } ?>
                                                </select>
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label for="postal_code" class="">Postal code *</label>
                                                <input type="text" onkeypress="return isNumberKey(event);" class="form-control number" name="postal_code" id="postal_code" maxlength="6"  value="<?= (isset($details->postal_code)) ? $details->postal_code : ''; ?>" required="required" data-rule-required="true" data-msg-required="Please include your postal code">
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div>

                                    </div>            

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address_line1" class="">Address line 1 *</label>
                                                <textarea class="form-control" id="address_line1" name="address_line1" data-toggle="wysiwyg" required="required" data-rule-required="true" data-msg-required="Please include your Address" ><?= getFieldVal('address_line1', $details); ?></textarea>
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address_line2" class="">address line 2</label>
                                                <textarea class="form-control" id="address_line2" name="address_line2" data-toggle="wysiwyg"><?= getFieldVal('address_line2', $details); ?></textarea>
                                                <span class="error" style="display: none;">
                                                    <i class="error-log fa fa-exclamation-triangle"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div> 	

<?php } ?>	

                                <div class="row save_cancel">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="box-footer text-center">
                                                <a href="javascript:void(0)" class="btn btn-primary no-print" onclick="history.back();">Back</a>
                                                <button type="button" class="btn btn-success no-print save" is_lang="2">Preview</button>
                                                <button type="button" class="btn btn-success submit">Save</button>
                                                <button type="submit" class="btn btn-success submit_save hidden">Save</button>
                                                <!--<a href="<?php // $main_page; ?>" class="btn btn-danger no-print">Cancel</a>-->

                                            </div>
                                        </div>
                                    </div>
                                </div>

<!--                                <div class="row modal_button" style="display: none;pointer-events: auto;">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="box-footer text-center">

                                                <button type="submit" class="btn btn-success submit">Save</button>
                                                <button type="button" class="btn btn-danger no-print cancel">Cancel</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                            </div>


                        </div>
                    </div>
                </div>
            </div>
    </div>
	</form>
	</div>
	<!--for change password Modal -->
	<div class="modal modal-info fade bs-modal-changePassword" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myMediumModalLabel2">Change password</h5>
				</div>
				<form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="<?= base_url('doctor/change_doctor_password_via_admin');?>" autocomplete="off" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "Passwords do not match." : "")'>
				<div class="modal-body">
				<!-- Begin Old Password Field -->
				<div class="">
                    <input type="hidden" name="model_password" value="<?=$curr_url;?>">
                    <input type="hidden" name="ID" value="<?= MD5($ID); ?>">
                    <label for="old_password">old password? *
					<h6 class="fs-subtitle"></h6>
					</label>
					<input type="password" class="form-control old_password" id="old_password" name="old_password" required="required" size="12" minlength="8" maxlength="12" data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				<!-- End Old Password Field -->	

				<!-- Begin Password Field -->
				<div class="">
					<label for="password">new password? *
					<h6 class="fs-subtitle"></h6>
					</label>
					<input id="password" name="password" class="form-control password" required="required" size="12" minlength="8" maxlength="12" type="password"  data-rule-required="true"  data-msg-required="Please enter a valid Password" autocomplete="off">
					<span class="error" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				<!-- End Password Field -->

				<!-- Begin Confirm Password Field -->
				<div class="">
					<label for="confirm_password">Confirm password? *</label>
					<input id="confirm_password" name="confirm_password" class="form-control confirm_password" required="required" size="12" minlength="8" maxlength="12"  type="password" data-rule-equalTo="#password" data-rule-required="true" data-msg-required="Please enter a valid confirm Password" autocomplete="off">
					<span class="error password_msg" style="display: none;">
						<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				<!-- End Password Field -->
				<!-- Begin show/hide Password Field -->
				<div class="" style="display:block;text-align: center !important;">
					<label for="show_password">Show password
					<input id="show_password" name="show_password" class="show_password" type="checkbox"></label>
				</div>
				<!-- End show/hide Field -->	
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-rounded ripple text-left UpdatePassword">Change</button>
					
					<button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Close this</button>
				</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!--end-->
	
	
	<!--review modal-->


	<!--for change password Modal -->
	<div class="modal modal-info fade bs-modal-changePassword reviewmodal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-inverse">
					<button type="button" class="close cancel" aria-hidden="true">×</button>
					<h5 class="modal-title" >Preview</h5>
				</div>
				<div class="modal-body outer_modal_content" style="pointer-events: none;">
				<div class="modalbody">	
				
				</div>
				
				</div>
				
				<div class="modal-footer">
			
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	
</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->

<script>
                                                                            $(document).on("click", ".choose-image-href", function () {
                                                                                $('.choose-image').trigger('click');
                                                                            });

                                                                            $(function () {
                                                                                $('.save').trigger('click');
                                                                                //$('.specialty').select2();
                                                                            });
                                                                            var confirm_bootD = function (title, message, callback) {
                                                                                //setTimeout(function(){$('.bootbox.modal').addClass('show');},200);
                                                                                bootbox.confirm({
                                                                                    title: title,
                                                                                    message: message,
                                                                                    buttons: {
                                                                                        cancel: {
                                                                                            label: '<i class="fa fa-times"></i> Cancel',
                                                                                        },
                                                                                        confirm: {
                                                                                            label: '<i class="fa fa-check"></i> Confirm',
                                                                                        }
                                                                                    },
                                                                                    callback: function (result) {
                                                                                        callback(result);
                                                                                    }
                                                                                });

                                                                            }
</script>

<script>
    $(document).ready(function () {
        $('.add_more_education').click(function () {
            var htmleducation = '<tr><td><input type="text" class="form-control education_description" name="education_description[]" required="required" data-rule-required="true"><input type="text" class="form-control education_description_vi" name="education_description_vi[]"  value="" ></td><td style="width: 120px;position: relative;left: 15px;"><span class="btn btn-sm btn-danger remove_education">-</span></td></tr>';
            $('.add_education').append(htmleducation);
            //$( ".datepicker" ).datepicker({format: 'dd-mm-yyyy'});
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.add_more_experience').click(function () {
            var htmleducation = '<tr><td><input type="text" class="form-control" name="experience_from[]" value="" required="required" data-rule-required="true"></td><td><input type="text" class="form-control experience_to" name="experience_to[]" value="" ><input type="text" class="form-control experience_to_vi" name="experience_to_vi[]" value="" ></td><td><textarea  class="form-control experience_description" name="experience_description[]" >  </textarea> <textarea  class="form-control experience_description_vi" name="experience_description_vi[]" > </textarea></td><td><span class="btn btn-sm btn-danger remove_experience">-</span></td></tr>';
            $('.add_experience').append(htmleducation);
            //$( ".datepicker" ).datepicker({format: 'dd-mm-yyyy'});
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.add_more_award').click(function () {
            var htmlaward = '<tr><td><input type="text"  class="form-control" name="cert_award_year[]" value="" required="required" data-rule-required="true"></td><td><input type="text" class="form-control cert_award_description" name="cert_award_description[]" required="required" data-rule-required="true"><input type="text" class="form-control cert_award_description_vi" name="cert_award_description_vi[]"  value=""></td><td style="text-align: center;"><span class="btn btn-sm btn-danger remove_award" style="margin-right: 28px;">-</span></td></tr>';
            $('.add_award').append(htmlaward);
            //$( ".datepicker" ).datepicker({format: 'dd-mm-yyyy'});
        });
    });
</script>
<script>
    $(document).on('click', '.remove_education', function () {
        var thsedu = $(this);
        var edu_id = parseInt($(this).attr('edu_id'));
        if (edu_id > 0) {
            var title = 'Confirm before delete this record';
            var message = 'Are You sure to delete this record!';
            confirm_bootD(title, message, function (result) {
                if (result) {
                    $.post('<?= base_url(); ?>doctor/removedoctor_education', {id: edu_id}, function (data) {
                        var dt = JSON.parse(data);
                        if (dt.status > 0) {
                            thsedu.closest("tr").remove();
                        }
                    });
                }
            });
        } else {
            thsedu.closest("tr").remove();
        }

    });
</script>
<script>
    $(document).on('click', '.remove_experience', function () {
        var thsexp = $(this);
        var exp_id = parseInt($(this).attr('exp_id'));
        if (exp_id > 0) {
            var title = 'Confirm before delete this record';
            var message = 'Are You sure to delete this record!';
            confirm_bootD(title, message, function (result) {
                if (result) {
                    $.post('<?= base_url(); ?>doctor/removedoctor_experience', {id: exp_id}, function (data) {
                        var dt = JSON.parse(data);
                        if (dt.status > 0) {
                            thsexp.closest("tr").remove();
                        }
                    })
                }
            })
        } else {
            thsexp.closest("tr").remove();
        }


    });

    $(document).on('click', '.remove_award', function () {
        var thsaward = $(this);
        var award_id = parseInt($(this).attr('award_id'));
        if (award_id > 0) {
            var title = 'Confirm before delete this record';
            var message = 'Are You sure to delete this record!';
            confirm_bootD(title, message, function (result) {
                if (result) {
                    $.post('<?= base_url(); ?>doctor/removedoctor_award', {id: award_id}, function (data) {
                        var dt = JSON.parse(data);
                        if (dt.status > 0) {
                            thsaward.closest("tr").remove();
                        }
                    })
                }
            })
        } else {
            thsaward.closest("tr").remove();
        }


    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }

    $(document).on('change', 'select[name="position"]', function () {
        if ($(this).val() == 'Other') {
            $('#position_other').removeClass('hidden');
        } else {
            $('#position_other').addClass('hidden');
        }
    })
    
    $(document).on('change', 'select[name="position_vi"]', function () {
        if ($(this).val() == 'Other') {
            $('#position_other_vi').removeClass('hidden');
        } else {
            $('#position_other_vi').addClass('hidden');
        }
    })

    $(document).on('change', 'select[name="title"]', function () {
        if ($(this).val() == 'Other') {
            $('#title_other').removeClass('hidden');
        } else {
            $('#title_other').addClass('hidden');
        }
    })
    $(document).on('change', 'select[name="title_vi"]', function () {
        if ($(this).val() == 'Other') {
            $('#title_other_vi').removeClass('hidden');
        } else {
            $('#title_other_vi').addClass('hidden');
        }
    })
    // $(document).on('click','.save',function(){
    // //var html=$('.review').clone(true).appendTo('.modalbody');
    // //$('.modalbody').html(html);
    // //$("select").uniform();
    // //$('.reviewmodal').modal('show');

    // //cloning select and textarea
    // var $orginal = $('.review');
    // var $cloned = $orginal.clone();
    // var $originalSelects = $orginal.find('select');
    // $cloned.find('select').each(function(index, item) {
    // $(item).val($originalSelects.eq(index).val() );

    // });
    // var $originalTextareas = $orginal.find('textarea');

    // $cloned.find('textarea').each(function(index, item) {
    // $(item).val($originalTextareas.eq(index).val());
    // }); 
    // //$cloned.appendTo('.modalbody');
    // $('.modalbody').html($cloned);

    // $('.reviewmodal').modal('show');
    // $('.save_cancel').css('display','none');
    // $('.modal_button').css('display','block');
    // //end cloning

    // //$(this).attr('type','submit');

    // })

    $(document).on('click', '.cancel', function () {
        //$('.save').attr('type','button');
        var html = $('.review').html();
        $('.modalbody').html('');
        $('.reviewmodal').modal('hide');
        $('.save_cancel').css('display', 'block');
        $('.modal_button').css('display', 'none');

    })

    $(document).on('click', '.save', function () {
        preview();
        $('html, body').animate({
            scrollTop: $(".language").offset().top
        }, 2000);
        return true;

    });

    
    $(document).on('click', '.language', function () {
        if ($(this).attr('tabval') == 1) {
            $('.save').attr('is_lang', '1');
            $('.label_b').text('HỌC VỊ *');
            $('.position_b').text('CHỨC VỤ *');
            //$('.name_b').text('HỌ VÀ TÊN *');
            //$('.first_name_b').text('TÊN *');
            $('.doctor_mcr').text('SỐ MCR CỦA BÁC SỸ');
            $('.primary_specialty_b').text('KHOA *');
            //$('.specialty_b').text('CHUYÊN KHOA');
            $('.education_b').text('Bằng cấp chuyên môn');
            $('.medical_exp_b').text('KINH NGHIỆM Y KHOA');
            $('.description_all_b').text('MÔ TẢ');
            $('.add_delete_b').text('THÊM/XÓA');
            $('.other_cert_award').text('GIẢI THƯỞNG/BẰNG CẤP KHÁC');
            $('.year_b').text('NĂM');
            $('.from_b').text('TỪ');
            $('.to_b').text('ĐẾN');
            $('.education_info').text('Bằng cấp chuyên môn');
            $('.medical_exp_b_app').text('Kinh nghiệm y khoa');
            $('.professional_exp_year_b').text('Số năm kinh nghiệm trong nghề');

            //$('.middle_name_b').text('Tên đệm');
            //$('.last_name_b').text('Họ');
            $('.description_en').css('display', 'none');
            $('.description_vi').css('display', 'block');

            $('.cert_award_description').hide();
            $('.cert_award_description_vi').show();
            
            $('.specialty_b').hide();
            $('.specialty_b_vi').show();

            $('.experience_description').hide();
            $('.experience_description_vi').show();
            
            $('.experience_to').hide();
            $('.experience_to_vi').show();

            $('.education_description').hide();
            $('.education_description_vi').show();
            
            $('.image_b').text('ẢNH ĐẠI DIỆN');
            $('.year_b').text('NĂM');
            $('.title_en').hide();
            $('.title_vi').show();
            $('.position_en').hide();
            $('.position_vi').show();
            $('.name_b').hide();
            $('.name_b_vi').show();
            $('.level_b').hide();
            $('.level_b_vi').show();

        } else {
            $('.save').attr('is_lang', '2');
            $('.doctor_mcr').text('Doctor MCR');
            $('.primary_specialty_b').text('Primary Specialty *');
            //$('.specialty_b').text('SPECIALTY');
            $('.education_b').text('Professional Qualifications');
            $('.medical_exp_b').text('Medical Experience');
            $('.description_all_b').text('DESCRIPTION');
            $('.add_delete_b').text('Add/Delete');
            $('.other_cert_award').text('OTHER CERTIFICATE/AWARDS');
            $('.year_b').text('YEAR');
            $('.from_b').text('From');
            $('.to_b').text('To');
            $('.education_info').text('Professional Qualifications');
            $('.medical_exp_b_app').text('Medical Experience');
            $('.professional_exp_year_b').text('YEARS OF PROFESSIONAL EXPERIENCE');

            $('.label_b').text('Title *');
            $('.position_b').text('POSITION *');
            //$('.name_b').text('Name *');
            //$('.first_name_b').text('First Name *');
            //$('.middle_name_b').text('Middle Name');
            //$('.last_name_b').text('Last Name');
            //$('.change_eng').css('display','block');
            $('.description_en').css('display', 'block');
            $('.description_vi').css('display', 'none');

            $('.cert_award_description').show();
            $('.cert_award_description_vi').hide();

            $('.experience_to').show();
            $('.experience_to_vi').hide();
            $('.experience_description').show();
            $('.experience_description_vi').hide();

            $('.education_description').show();
            $('.education_description_vi').hide();
            
            $('.image_b').text('PROFILE PICTURE');
            $('.year_b').text('Years');
            $('.title_en').show();
            $('.title_vi').hide();
            $('.position_en').show();
            $('.position_vi').hide();
            
            $('.specialty_b').show();
            $('.specialty_b_vi').hide();
            $('.name_b').show();
            $('.name_b_vi').hide();
            $('.level_b').show();
            $('.level_b_vi').hide();
        }
        preview();

    })

    
   function  preview() {
        var experience_all = '';
        var doctor_name = '';
        var education = '';
        var education = '';
        var year = '';
        //var hospital_name = '';
        var experience_year = '';
        var description_profile = '';
        var profesnl_exp_year = '';
        var experience_description = '';
        var doctor_dept ='';
        var name='';
        var level ='';
        //var title = $('#title').val(); //myContent.replace(/(<([^>]+)>)/ig,"");
        //var position = $('#position :selected').val(); //myContent.replace(/(<([^>]+)>)/ig,"");
        //var name = $('#name').val(); //myContent.replace(/(<([^>]+)>)/ig,"");
        ///var first_name = $('#first_name').val(); //myContent.replace(/(<([^>]+)>)/ig,"");
        //var middle_name = $('#middle_name').val(); //myContent.replace(/(<([^>]+)>)/ig,"");
        //var last_name = $('#last_name').val(); //myContent.replace(/(<([^>]+)>)/ig,"");
        //hospital_name = $('.hospital_name').val(); //myContent.replace(/(<([^>]+)>)/ig,"");
         //myContent.replace(/(<([^>]+)>)/ig,"");
        
       
        //doctor_name = title + ' - ' + position + ' ' + first_name + ' ' + middle_name + ' ' + last_name;
        //var doctor_dept = $('#specialty_code :selected').text(); //myContent.replace(/(<([^>]+)>)/ig,"");
        //var level = $('#level :selected').text(); //myContent.replace(/(<([^>]+)>)/ig,"");
        profesnl_exp_year = $('.p_exp_year').val(); //myContent.replace(/(<([^>]+)>)/ig,"");

        if ($('.save').attr('is_lang') == 2) {
            var title = $('#title').val();
            var position = $('#position :selected').val();
            
            if(position=='Other'){
             position=$('.other_position').val();
            }
            if(title=='Other'){
                 title=$('.other_title').val();
            }
            if(title!=''){
                title=title + ' - ';
            }
           doctor_dept=$('#profile_specialty :selected').text();
            if(doctor_dept=='Other'){
                doctor_dept=$("#profile_specialty_other").val();
            }
            name = $('#name').val();
            doctor_name =  title + position + ' ' +name;
            level = $('#level :selected').text();
            education = $('input[name="education_description[]"]').map(function () {
                return this.value + "<br>";
            }).get();
            experience_description = $('textarea[name="experience_description[]"]').map(function () {
                return this.value;
            }).get();
            experience_to = $('input[name="experience_to[]"]').map(function () {
            return this.value;
            });
            description_profile = $('.description_profile').val();
            experience_year = 'Years of professional experience: ';
            year=' YEARS';
        } else {
            var title_vi = $('#title_vi').val();
            var position_vi = $('#position_vi :selected').val();
            if(position_vi=='Other'){
             position_vi=$('.other_position_vi').val();
            }
            if(title_vi=='Other'){
                 title_vi=$('.other_title_vi').val();
            }
            if(title_vi!=''){
                title_vi=title_vi + ' - ';
            }
            doctor_dept=$('#profile_specialty_vi :selected').text();
            if(doctor_dept=='Other'){
                doctor_dept=$("#profile_specialty_other_vi").val();
            }
            name = $('#name_vi').val();
             doctor_name =  title_vi + position_vi + ' ' +name;
             level = $('#level_vi :selected').text();
            education = $('input[name="education_description_vi[]"]').map(function () {
                return this.value + "<br>";}).get();
            experience_description = $('textarea[name="experience_description_vi[]"]').map(function () {
                return this.value;
            }).get();
            experience_to = $('input[name="experience_to_vi[]"]').map(function () {
            return this.value;
            });
            description_profile = $('.description_profile_vi').val();
            experience_year = 'Số năm kinh nghiệm trong nghề: ';
            year=' NĂM';
        }

        var experience_from = $('input[name="experience_from[]"]').map(function () {
            return this.value;
        }).get();

        


        for (let i = 0; i < experience_from.length; i++) {
            if (experience_from[i]) {
                experience_all += '<p style=" color: #000; margin-bottom: 2px !important;"﻿>' + experience_from[i] + ' - ' + experience_to[i] + '</p>';
            }
            experience_all += '<p>' + experience_description[i] + '</p>';
        }
        //var content='';
        $('.doctor_dept').html('');
        $('.doctor_dept').html('<i class="fa fa-graduation-cap" aria-hidden="true"></i> &nbsp;'+description_profile);
//        content=$('.doctor_dept').find("p:first").text();
//        //alert(content);
//        if(content){
//                $('.doctor_dept').find("p:first").html('<i class="fa fa-graduation-cap" aria-hidden="true"></i> &nbsp;'+content);
//            }else{
//                $('.doctor_dept').html('');
//                $('.doctor_dept').html('<p><i class="fa fa-graduation-cap" aria-hidden="true"></i> '+description_profile+'</p> &nbsp;'); 
//            }
//        
//        //$('.doctor_dept:first').p('<i class="fa fa-graduation-cap" aria-hidden="true"></i> &nbsp;');
        $('.doctor_specialty').html('');
        if(doctor_dept!='Select'){
            var levelval='';
            if(level!='Select'){
                 levelval=' - '+level;
            }
            if(doctor_dept){
            $('.doctor_specialty').html(doctor_dept+levelval);
            }
        }else{
            $('.doctor_specialty').html('');
        }
        
        //$('.doctor_dept').html(description_profile+' '+doctor_dept+', '+hospital_name);
        if (profesnl_exp_year) {
            $('.profesnl_exp_year').html(experience_year + profesnl_exp_year + year);
        }
        $('.doctor_name').html('');
        $('.doctor_name').html(doctor_name);
        $('.education').html('');
        $('.education').html(education);
        $('.experience').html('');
        $('.experience').html(experience_all);
    }
    
    $(document).on('click','.submit',function(){
        if(validationForm()){
            $('.submit_save').trigger('click');
            }
    })

    function validationForm(){
//        if($('#title').val()==''){
//            $('.title_error').show().css('color','red');
//            $('#title').focus();
//        }else{
//            $('.title_error').hide();
//        }
        if($('#position').val()==''){
            $('.position_error').show().css('color','red');
            $('#position').focus();
        }else{
            $('.position_error').hide();
        }
        if($('#name').val()==''){
            $('#name').focus();
            $('.name_error').show().css('color','red');
        }else{
            $('.name_error').hide();
        } 
        
//       if($('.education_description').val()==''){
//            $('.education_description').focus();
//            $('.edu_description_error').show().css('color','red');
//        }else{
//            $('.edu_description_error').hide();
//        }
//        if($('.experience_description').val()==''){
//            $('.experience_description').focus();
//            $('.medical_description_error').show().css('color','red');
//        }else{
//            $('.medical_description_error').hide();
//        }
//        if($('.cert_award_description').val()==''){
//            $('.cert_award_description').focus();
//            $('.award_description_error').show().css('color','red');
//        }else{
//            $('.award_description_error').hide();
//        }
        
        if($('#name').val()=='' || $('#position').val()==''){// || $('.cert_award_description').val()=='' || $('.experience_description').val()=='' || $('.education_description').val()==''){
            return false;
        }else{
            return true;
        }
    }
    
    $(document).on('change','#position',function(){
       if($('#position').val()==''){
            $('.position_error').show().css('color','red');
            $('#position').focus();
        }else{
            $('.position_error').hide();
        }
    });
    
    $(document).on('change','#title',function(){
        if($('#title').val()==''){
            $('.title_error').show().css('color','red');
            $('#title').focus();
        }else{
            $('.title_error').hide();
        }
    });
    
    $(document).on('keyup','#name',function(){
        if($('#name').val()==''){
            $('#name').focus();
            $('.name_error').show().css('color','red');
        }else{
            $('.name_error').hide();
        }
    });
    
    function change_doc_image(){
        $('.doctor_image').trigger('click');
    }
    
    function remove_doc_image(){
        var doctor_id = $('.DID').val();
        var old_img = $('.remove_doc_image').attr('img');
        if (doctor_id > 0) {
            var title = 'Confirm before remove this image';
            var message = 'Are you sure to remove this image!';
            confirm_bootD(title, message, function (result) {
                if (result) {
                    $.post('<?= base_url(); ?>doctor/removedoctor_image', {id: doctor_id,old_img:old_img}, function (data) {
                        var dt = JSON.parse(data);
                        if (dt.status > 0) {
                            alert('Removed successfully');
                            $('.view_image ').attr('src',BASE_URL+'assets/img/icon/not-available.jpg');
                            $('.remove_doc_image').attr('style','');
                            $('.remove_doc_image').attr('style','width: 70px;float: left;pointer-events: none;opacity: .3;');
                            //window.location.reload();
                        }
                    })
                }
            })                                                                                //data/doctor-profile-image/2020/03/20030204042828__(2).png
        }
    }
    
    function remove_active(){
            var doctor_id = $('.DID').val(); 
            setTimeout(function(){
                                $.post('<?= base_url(); ?>doctor/getDoctor_image', {id: doctor_id}, function (data) {
                                                var dt = JSON.parse(data);
                                                if (dt.status > 0) {
                                                    $('.remove_doc_image').attr('img','');
                                                    $('.remove_doc_image').attr('img',dt.image);
                                                }
                                            });
            },2000);
        $('.remove_doc_image').attr('style','');
        $('.remove_doc_image').attr('style','width: 70px;float: left;');
    }
</script>
<script>
    $('.MyForm input,textarea,select,checkbox,radio').attr('disabled', 'disabled');
</script>