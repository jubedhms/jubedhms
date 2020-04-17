<!--Start header-->
<?= $header; ?>
<!--End header-->
<?php
$ID = (isset($details->ID)) ? $details->ID : "";
$url1 = ($this->uri->segment(1) != '') ? $this->uri->segment(1) : '';
$curr_url = $url1;
//print_r($details);die;
?>
<!-- Start page-->
<style>
.vscroll {
    height: 410px;
    overflow: scroll;
}
    #overlay {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;
  padding-top: 25%;
  opacity: .80;
}
button {
  margin: 40px;
  padding: 5px 20px;
  cursor: pointer;
}
.spinner {
    margin: 0 auto;
    height: 64px;
    width: 64px;
    animation: rotate 0.8s infinite linear;
    border: 5px solid firebrick;
    border-right-color: transparent;
    border-radius: 50%;
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
    
    .txt  {
        font-weight: bold;
        font-size: 12px;
        line-height: 32px;
    }
    .modal-content .modal-header {
        background:#17bff0;
    }
    .badge1::before { content: none !important;right:0 !important;left:0 !important;}
    .badge1::after{content: none !important;right:0 !important;left:0 !important;}
    .badge1{border-top-right-radius: 6.25rem !important;top: 1px !important;background: #00b1f3;padding: 4px !important;
           border-bottom-right-radius: 6.25rem !important;left: unset !important;right: 0px !important;position: absolute;}
    .blog-post-new .card-header::before {   right: unset !important;}
    .pleft{padding-left:2.14286em;}
    .tourg_box_tab { background:#ccc;}
    .patient_dashboard_tab { background:#ccc;}
    .haw_tab { background:#ccc;}
    .doctor_profile_tab { background:#ccc;}
    .doctor_detail_tab { background:#ccc;}
    .shop_tab { background:#ccc;}
    .pregnancy_tab { background:#ccc;}
    .fertility_tab { background:#ccc;}
    .tourg_box{background: #fff;}
    
select.dropdown {
    -webkit-appearance: none;       
    -moz-appearance: none;    
    appearance: none;    
    background-position: 22px 3px;                
    background-size: 13px 13px; 
    width: 20px;
    height: 20px;
    margin-left: 8px;
    /*position: absolute;*/
    cursor: pointer;
    background-color: transparent;
    border: 1px solid #00b1f359;
    
}
.blog-post-new .card-body {
    padding-left: 3px !important;
    padding-right: 3px !important;
}
.badge1 {
    top: 3px !important;
    right: 3px !important;
}

.badge1{pointer-events: none;}
.change_order{color:#fff;}
.new_order{
    width: 30px;
    height: 30px;
    text-align: center;
    color: #fff;
}
.btn-outline-primary {
    color: #00b1f3 !important;
    border-color: #00b1f3 !important;
}
.pleft a{color: #00b1f3 !important;}
</style>

<main class="main-wrapper clearfix">
    <span class="action-message"><?= getFlashMsg('success_message'); ?></span>

    <!-- Page Title Area -->

    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->

    <div class="row page-title clearfix">
        <div class="page-title-left">
                <!--<h6 class="page-title-heading mr-0 mr-r-5"><?php // $mode.' '.$heading;  ?></h6>-->
            <h6 class="page-title-heading mr-0 mr-r-5">APP Image Management</h6>

        </div>

        <!-- /.page-title-left -->
        <!-- <div class="page-title-right d-none d-sm-inline-flex">
                <span>
        <?php if (checkModulePermission($MODULEID, 'add_btn')) { ?>
                    <a href="<?= base_url('patient/addedit_patient'); ?>" class="btn btn-info btn-sm">Add</a>
        <?php } if (checkModulePermission($MODULEID, 'delete_btn')) { ?>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm bulk_delete" id="<?= base_url('patient/deleteData'); ?>" title="Delete selected rows">Delete All</a>
        <?php } ?>
                </span>
        </div> -->
        <!-- /.page-title-right -->
    </div>
    <div class="widget-list tourg_box_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                
<!--<button>Load Spinner</button>-->
<div id="overlay" style="display:none;">
    <div class=""></div>
    <img src="<?php base_url(); ?>assets/img/Ajax-loader.gif" style="width: 150px;">
    <br/>
    Loading...
</div>
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Tour Guide (default 6 photos)</h5>
                        <div class="row" >
                            <?php $id_with_row=0;
                            $tour_guide=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'tour_guide'))->result();
                            $id_with_row=$this->db->where(array('src!='=>'','module_name'=>'tour_guide'))->count_all_results('app_banner_setting');
                            $i=1;$more=0;
                            foreach ($tour_guide as $rowtour) {
                                if($rowtour->src!=''){
                            ?>
                                <div class="col-md-3 mr-b-30 tourg_box">
                                    <div class="card blog-post-new">
                                        <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $rowtour->module_name; ?>" class="upload_img_btn" data-id="<?= md5($rowtour->ID) ?>" wth="<?php echo isset($rowtour->width) ? $rowtour->width : ''; ?>" hth="<?php echo isset($rowtour->height) ? $rowtour->height : ''; ?>"></span>
                                                        <a href="javascript:void(0);" data-dir="<?php echo $rowtour->module_name; ?>" <?php echo ($rowtour->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($rowtour->ID) ?>" image_size="1" >
                                                        <img src="<?php echo ($rowtour->src)?$rowtour->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($rowtour->width) ? $rowtour->width : ''; ?>" hth="<?php echo isset($rowtour->height) ? $rowtour->height : ''; ?>">
                                                </a>
                                            </figure>
                                                <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($rowtour->short_by))?$rowtour->short_by:''; ?>
                                                </span>
<!--                                                <span class="badge1 btn-rounded">
                                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($rowtour->ID) ?>" title="Click to change order">
                                                        <option value="" disabled selected hidden>Change order</option>
                                                        <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                                        <option value="<?=$j; ?>" <?=(isset($rowtour->short_by) && $rowtour->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </span>-->
                                        </div>
                                        <?php if (!empty($rowtour->src)) { ?>											
                                            <div class="pleft" >
                                                <a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($rowtour->updater_date)); ?></a></div>
                                            <div class="card-body sub-heading-font-family">
                                                <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($rowtour->ID) ?>" image_size="1" >Remove</a> 
                                                <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($rowtour->ID) ?>" image_size="1" >Change Image</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }  ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $rowtour->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $rowtour->module_name; ?>" class="upload_img_btn" data-id="<?= md5($rowtour->ID) ?>" wth="<?php echo isset($rowtour->width) ? $rowtour->width : ''; ?>" hth="<?php echo isset($rowtour->height) ? $rowtour->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" style="cursor:auto" data-dir="<?php echo $rowtour->module_name; ?>" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($rowtour->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($rowtour->width) ? $rowtour->width : ''; ?>" hth="<?php echo isset($rowtour->height) ? $rowtour->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if (!empty($rowtour->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($rowtour->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($rowtour->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($rowtour->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                                <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="widget-list login_box_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">

                        <div class="row">
                            <div class="col-md-3 mr-b-30 tourg_box">
                                <h5 class="box-title" align="center">Login (1 photos)</h5>
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[6]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(7) ?>" wth="<?php echo isset($details[6]->width) ? $details[6]->width : ''; ?>" hth="<?php echo isset($details[6]->height) ? $details[6]->height : ''; ?>"></span>
                                        <a href="javascript:void(0);" data-dir="<?php echo $details[6]->module_name; ?>" <?php echo ($details[6]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(7) ?>" image_size="1" >
                                            <img src="<?php echo ($details[6]->src)?$details[6]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[6]->src)?'150':'240'; ?>" wth="<?php echo isset($details[6]->width) ? $details[6]->width : ''; ?>" hth="<?php echo isset($details[6]->height) ? $details[6]->height : ''; ?>">
                                        </a>
                                        </figure>

                                </div>
                        <?php if (!empty($details[6]->src)) { ?>
                                <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[6]->updater_date)); ?></a></div>
                                <div class=" card-body sub-heading-font-family" >
                                        <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(7) ?>">Remove</a> 
                                        <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(7) ?>"  style="float:right" >Change Image</a>
                                </div>
                        <?php } ?>
                                </div>
                            </div>  
                            <div class="col-md-3 mr-b-30 tourg_box">
                                <h5 class="box-title" align="center">Registration (1 photos))</h5>
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                        <span style="display: none;" data-dir="<?php echo $details[7]->module_name; ?>" data-toggle="modal" class="upload_img_btn" data-id="<?= md5(8) ?>" wth="<?php echo isset($details[7]->width) ? $details[7]->width : ''; ?>" hth="<?php echo isset($details[7]->height) ? $details[7]->height : ''; ?>"></span>
                                        <a href="javascript:void(0);" data-dir="<?php echo $details[7]->module_name; ?>" <?php echo ($details[7]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(8) ?>" image_size="1" >
                                        <img src="<?php echo ($details[7]->src)?$details[7]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[7]->src)?'150':'240'; ?>" wth="<?php echo isset($details[7]->width) ? $details[7]->width : ''; ?>" hth="<?php echo isset($details[7]->height) ? $details[7]->height : ''; ?>">
                                                </a>
                                        </figure>

                                </div>
                                        <?php if (!empty($details[7]->src)) { ?>
                                                <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[7]->updater_date)); ?></a></div>
                                                <div class=" card-body sub-heading-font-family" >
                                                        <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(8) ?>">Remove</a> 
                                                        <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(8) ?>"  style="float:right" >Change Image</a>
                                                </div>
                                        <?php } ?>
                                </div>
                            </div>  
                            
                            <div class="col-md-3 mr-b-30 tourg_box">
                                    <h5 class="box-title" align="center">Send OTP (1 photos)</h5>
                                    <div class="card blog-post-new">
                                    <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                            <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[38]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(39) ?>" wth="<?php echo isset($details[38]->width) ? $details[38]->width : ''; ?>" hth="<?php echo isset($details[38]->height) ? $details[38]->height : ''; ?>"></span>

                                            <a href="javascript:void(0);" data-dir="<?php echo $details[38]->module_name; ?>" <?php echo ($details[38]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(39) ?>" image_size="1" >
                                            <img src="<?php echo ($details[38]->src)?$details[38]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[38]->src)?'150':'240'; ?>" wth="<?php echo isset($details[38]->width) ? $details[38]->width : ''; ?>" hth="<?php echo isset($details[38]->height) ? $details[38]->height : ''; ?>">
                                                    </a>
                                            </figure>

                                    </div>
                                    <?php if (!empty($details[38]->src)) { ?>
                                            <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[38]->updater_date)); ?></a></div>
                                            <div class=" card-body sub-heading-font-family" >
                                                    <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(39) ?>">Remove</a> 
                                                    <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(39) ?>"  style="float:right" >Change Image</a>
                                            </div>
                                    <?php } ?>
                                    </div>
                            </div>  
                            
                            <div class="col-md-3 mr-b-30 tourg_box">
                                <h5 class="box-title" align="center">Match OTP (1 photos)</h5>
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[39]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(40) ?>" wth="<?php echo isset($details[39]->width) ? $details[39]->width : ''; ?>" hth="<?php echo isset($details[39]->height) ? $details[39]->height : ''; ?>"></span>

                                        <a href="javascript:void(0);" data-dir="<?php echo $details[39]->module_name; ?>" <?php echo ($details[39]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(40) ?>" image_size="1" >
                                        <img src="<?php echo ($details[39]->src)?$details[39]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[39]->src)?'150':'240'; ?>" wth="<?php echo isset($details[39]->width) ? $details[39]->width : ''; ?>" hth="<?php echo isset($details[39]->height) ? $details[39]->height : ''; ?>">
                                                </a>
                                        </figure>

                                </div>
                                    <?php if (!empty($details[39]->src)) { ?>
                                            <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[39]->updater_date)); ?></a></div>
                                            <div class=" card-body sub-heading-font-family" >
                                                    <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(40) ?>">Remove</a> 
                                                    <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(40) ?>"  style="float:right" >Change Image</a>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>  
                            
                        <div class="col-md-3 mr-b-30 tourg_box">
                                <h5 class="box-title" align="center">Reset Password OTP <br>(1 photos)</h5>
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[40]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(41) ?>" wth="<?php echo isset($details[40]->width) ? $details[40]->width : ''; ?>" hth="<?php echo isset($details[40]->height) ? $details[40]->height : ''; ?>"></span>

                                        <a href="javascript:void(0);" data-dir="<?php echo $details[40]->module_name; ?>" <?php echo ($details[40]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(41) ?>" image_size="1" >
                                        <img src="<?php echo ($details[40]->src)?$details[40]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[40]->src)?'150':'240'; ?>" wth="<?php echo isset($details[40]->width) ? $details[40]->width : ''; ?>" hth="<?php echo isset($details[40]->height) ? $details[40]->height : ''; ?>">
                                                </a>
                                        </figure>

                                </div>
                                    <?php if (!empty($details[40]->src)) { ?>
                                            <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[40]->updater_date)); ?></a></div>
                                            <div class=" card-body sub-heading-font-family" >
                                                    <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(41) ?>">Remove</a> 
                                                    <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(41) ?>"  style="float:right" >Change Image</a>
                                            </div>
                                    <?php } ?>
                                </div>
                        </div>  
                            
                            
                            <div class="col-md-3 mr-b-30 tourg_box">
                                    <h5 class="box-title" align="center">Reset Password Match OTP<br> (1 photos)</h5>
                                    <div class="card blog-post-new">
                                    <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                            <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[41]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(42) ?>" wth="<?php echo isset($details[41]->width) ? $details[41]->width : ''; ?>" hth="<?php echo isset($details[41]->height) ? $details[41]->height : ''; ?>"></span>

                                            <a href="javascript:void(0);" data-dir="<?php echo $details[41]->module_name; ?>" <?php echo ($details[41]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(42) ?>" image_size="1" >
                                            <img src="<?php echo ($details[41]->src)?$details[41]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[41]->src)?'150':'240'; ?>" wth="<?php echo isset($details[41]->width) ? $details[41]->width : ''; ?>" hth="<?php echo isset($details[41]->height) ? $details[41]->height : ''; ?>">
                                                    </a>
                                            </figure>
                                    </div>
                                        <?php if (!empty($details[41]->src)) { ?>
                                                <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[41]->updater_date)); ?></a></div>
                                                <div class=" card-body sub-heading-font-family" >
                                                        <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(42) ?>">Remove</a> 
                                                        <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(42) ?>"  style="float:right" >Change Image</a>
                                                </div>
                                        <?php } ?>
                                    </div>
                            </div>  
                            
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>                    
        </div>
    </div>
    <div class="widget-list patient_dashboard_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Patient Dashboard (default 3 photos)</h5>
                        <div class="row" >
                                <?php $id_with_row=0;
                                $patient_dashboard=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'patient_dashboard'))->result();
                                $id_with_row=$id_with_row=$this->db->where(array('src!='=>'','module_name'=>'patient_dashboard'))->count_all_results('app_banner_setting');
                                $i=1;$more=0;
                                foreach ($patient_dashboard as $pasntrow) {
                                    if($pasntrow->src!=''){
                                ?>
                                        <div class="col-md-3 mr-b-30 tourg_box">
                                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                                <figure>
                                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $pasntrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($pasntrow->ID) ?>" wth="<?php echo isset($pasntrow->width) ? $pasntrow->width : ''; ?>" hth="<?php echo isset($pasntrow->height) ? $pasntrow->height : ''; ?>"></span>
                                                        <a href="javascript:void(0);" data-dir="<?php echo $pasntrow->module_name; ?>" <?php echo ($pasntrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($pasntrow->ID) ?>" image_size="1" >
                                                        <img src="<?php echo ($pasntrow->src)?$pasntrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($pasntrow->width) ? $pasntrow->width : ''; ?>" hth="<?php echo isset($pasntrow->height) ? $pasntrow->height : ''; ?>">
                                                        </a>
                                                </figure>
                                                <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($pasntrow->short_by))?$pasntrow->short_by:''; ?>
                                                </span>
<!--                                                <span class="badge1 btn-rounded">
                                                        <select class="dropdown change_order" name="short_by" data-id="<?= md5($pasntrow->ID) ?>" title="Click to change order">
                                                        <option value="" disabled selected hidden>Change order</option>
                                                        <?php for($j=1;$j<=count($patient_dashboard);$j++){ ?>
                                                        <option value="<?=$j; ?>" <?=(isset($pasntrow->short_by) && $pasntrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                        <?php } ?>
                                                        </select>
                                                </span>-->
                                </div>
                                <?php if (!empty($pasntrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($pasntrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($pasntrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($pasntrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                                </div>
                                        </div>
                                <?php } ?>
                             <!--TO ADD MORE-->
                                <?php if($more==0 && $pasntrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $pasntrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($pasntrow->ID) ?>" wth="<?php echo isset($pasntrow->width) ? $pasntrow->width : ''; ?>" hth="<?php echo isset($pasntrow->height) ? $pasntrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $pasntrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($pasntrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($pasntrow->width) ? $pasntrow->width : ''; ?>" hth="<?php echo isset($pasntrow->height) ? $pasntrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if (!empty($pasntrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($pasntrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($pasntrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($pasntrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                                <?php }  ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <div class="widget-list hs_map_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Hospital Map (default 3 photos)</h5>
                       <div class="row" >
                            <?php $id_with_row=0;
                            $hospital_map=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'hospital_map'))->result();
                            $id_with_row=$id_with_row=$this->db->where(array('src!='=>'','module_name'=>'hospital_map'))->count_all_results('app_banner_setting');
                            $i=1;$more=0;
                            foreach ($hospital_map as $hrow) {
                                if($hrow->src!=''){
                            ?>
                            <div class="col-md-3 mr-b-30 tourg_box">
                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $hrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($hrow->ID) ?>" wth="<?php echo isset($hrow->width) ? $hrow->width : ''; ?>" hth="<?php echo isset($hrow->height) ? $hrow->height : ''; ?>"></span>
                                                    <a href="javascript:void(0);" data-dir="<?php echo $hrow->module_name; ?>" <?php echo ($hrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($hrow->ID) ?>" image_size="1" >
                                                    <img src="<?php echo ($hrow->src)?$hrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($hrow->width) ? $hrow->width : ''; ?>" hth="<?php echo isset($hrow->height) ? $hrow->height : ''; ?>">
                                                    </a>
                                            </figure>
                                            <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($hrow->short_by))?$hrow->short_by:''; ?>
                                            </span>
<!--                                            <span class="badge1 btn-rounded">
                                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($hrow->ID) ?>" title="Click to change order">
                                                    <option value="" disabled selected hidden>Change order</option>
                                                    <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                                    <option value="<?=$j; ?>" <?=(isset($hrow->short_by) && $hrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </span>-->
                            </div>
                            <?php if (!empty($hrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($hrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                    <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($hrow->ID) ?>" image_size="1" >Remove</a> 
                                    <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($hrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                            </div>
                            </div>
                            <?php } ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $hrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $hrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($hrow->ID) ?>" wth="<?php echo isset($hrow->width) ? $hrow->width : ''; ?>" hth="<?php echo isset($hrow->height) ? $hrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $hrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($hrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($hrow->width) ? $hrow->width : ''; ?>" hth="<?php echo isset($hrow->height) ? $hrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if(!empty($hrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($hrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($hrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($hrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                            <?php } ?>
                            </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>	
    <div class="widget-list haw_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <div class="row">
                            
                            <div class="col-md-3 mr-b-30 haw_box">
                                        <h5 class="box-title" align="center">Health Awareness <br>(1 photos)</h5>
                                        <div class="card blog-post-new">
                                        <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                                <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[34]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(35) ?>" wth="<?php echo isset($details[34]->width) ? $details[34]->width : ''; ?>" hth="<?php echo isset($details[34]->height) ? $details[34]->height : ''; ?>"></span>

                                                <a href="javascript:void(0);" data-dir="<?php echo $details[34]->module_name; ?>" <?php echo ($details[34]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(35) ?>" image_size="1" >
                                                <img src="<?php echo ($details[34]->src)?$details[34]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[34]->src)?'150':'240'; ?>" wth="<?php echo isset($details[34]->width) ? $details[34]->width : ''; ?>" hth="<?php echo isset($details[34]->height) ? $details[34]->height : ''; ?>">
                                                        </a>
                                                </figure>

                                        </div>
                                <?php if (!empty($details[34]->src)) { ?>
                                        <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[34]->updater_date)); ?></a></div>
                                        <div class=" card-body sub-heading-font-family" >
                                                <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(35) ?>">Remove</a> 
                                                <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(35) ?>"  style="float:right" >Change Image</a>
                                        </div>
                                <?php } ?>
                                        </div>
                            </div>  


                            
                            <div class="col-md-3 mr-b-30 haw_box">
                                <h5 class="box-title" align="center">Due Date <br>(1 photos)</h5>
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[8]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(9) ?>" wth="<?php echo isset($details[8]->width) ? $details[8]->width : ''; ?>" hth="<?php echo isset($details[8]->height) ? $details[8]->height : ''; ?>"></span>

                                        <a href="javascript:void(0);" data-dir="<?php echo $details[8]->module_name; ?>" <?php echo ($details[8]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(9) ?>" image_size="1" >
                                                                <img src="<?php echo ($details[8]->src)?$details[8]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[8]->src)?'150':'240'; ?>" wth="<?php echo isset($details[8]->width) ? $details[8]->width : ''; ?>" hth="<?php echo isset($details[8]->height) ? $details[8]->height : ''; ?>">
                                                </a>
                                        </figure>

                                </div>
                                    <?php if (!empty($details[8]->src)) { ?>
                                            <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[8]->updater_date)); ?></a></div>
                                            <div class=" card-body sub-heading-font-family" >
                                                    <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(9) ?>">Remove</a> 
                                                    <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(9) ?>"  style="float:right" >Change Image</a>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>  


                            
                            <div class="col-md-3 mr-b-30 haw_box">
                                <h5 class="box-title" align="center">Home Screen<br>(1 photos)</h5>
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[9]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(10) ?>" wth="<?php echo isset($details[9]->width) ? $details[9]->width : ''; ?>" hth="<?php echo isset($details[9]->height) ? $details[9]->height : ''; ?>"></span>

                                        <a href="javascript:void(0);" data-dir="<?php echo $details[9]->module_name; ?>" <?php echo ($details[9]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(10) ?>" image_size="1" >
                                        <img src="<?php echo ($details[9]->src)?$details[9]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[9]->src)?'150':'240'; ?>" wth="<?php echo isset($details[9]->width) ? $details[9]->width : ''; ?>" hth="<?php echo isset($details[9]->height) ? $details[9]->height : ''; ?>">
                                                </a>
                                        </figure>

                                </div>
                                    <?php if (!empty($details[9]->src)) { ?>
                                            <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[9]->updater_date)); ?></a></div>
                                            <div class=" card-body sub-heading-font-family" >
                                                    <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(10) ?>">Remove</a> 
                                                    <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(10) ?>"  style="float:right" >Change Image</a>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>  

	
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <div class="widget-list book_app_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Booking Appointment (default 4 photos)</h5>
                        <div class="row" >
                            <?php $id_with_row=0;
                            $booking_appointment=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'booking_appointment'))->result();
                            $id_with_row=$id_with_row=$this->db->where(array('src!='=>'','module_name'=>'booking_appointment'))->count_all_results('app_banner_setting');
                            $i=1;$more=0;
                            foreach ($booking_appointment as $bookrow) {
                                if($bookrow->src!=''){
                            ?>
                                    <div class="col-md-3 mr-b-30 book_app_box">
                                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $bookrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($bookrow->ID) ?>" wth="<?php echo isset($bookrow->width) ? $bookrow->width : ''; ?>" hth="<?php echo isset($bookrow->height) ? $bookrow->height : ''; ?>"></span>
                                                    <a href="javascript:void(0);" data-dir="<?php echo $bookrow->module_name; ?>" <?php echo ($bookrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($bookrow->ID) ?>" image_size="1" >
                                                    <img src="<?php echo ($bookrow->src)?$bookrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($bookrow->width) ? $bookrow->width : ''; ?>" hth="<?php echo isset($bookrow->height) ? $bookrow->height : ''; ?>">
                                                    </a>
                                            </figure>
                                             <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($bookrow->short_by))?$bookrow->short_by:''; ?>
                                            </span>
<!--                                            <span class="badge1 btn-rounded">
                                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($bookrow->ID) ?>" title="Click to change order">
                                                    <option value="" disabled selected hidden>Change order</option>
                                                    <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                                    <option value="<?=$j; ?>" <?=(isset($bookrow->short_by) && $bookrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </span>-->
                            </div>
                            <?php if (!empty($bookrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($bookrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                    <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($bookrow->ID) ?>" image_size="1" >Remove</a> 
                                    <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($bookrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                                </div>
                            </div>
                            
                            <?php } ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $bookrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $bookrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($bookrow->ID) ?>" wth="<?php echo isset($bookrow->width) ? $bookrow->width : ''; ?>" hth="<?php echo isset($bookrow->height) ? $bookrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $bookrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($bookrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($bookrow->width) ? $bookrow->width : ''; ?>" hth="<?php echo isset($bookrow->height) ? $bookrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if(!empty($bookrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($bookrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($bookrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($bookrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                            
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <div class="widget-list doctor_profile_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Doctor Profile (default 4 photos)</h5>
                       <div class="row" >
                            <?php $id_with_row=0;
                            $doctor_profile=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'doctor_profile'))->result();
                            $id_with_row=$id_with_row=$this->db->where(array('src!='=>'','module_name'=>'doctor_profile'))->count_all_results('app_banner_setting');
                            $i=1;$more=0;
                            foreach ($doctor_profile as $doctorrow) {
                                if($doctorrow->src!=''){
                            ?>
                                    <div class="col-md-3 mr-b-30 doctor_profile_box">
                                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $doctorrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($doctorrow->ID) ?>" wth="<?php echo isset($doctorrow->width) ? $doctorrow->width : ''; ?>" hth="<?php echo isset($doctorrow->height) ? $doctorrow->height : ''; ?>"></span>
                                                    <a href="javascript:void(0);" data-dir="<?php echo $doctorrow->module_name; ?>" <?php echo ($doctorrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($doctorrow->ID) ?>" image_size="1" >
                                                    <img src="<?php echo ($doctorrow->src)?$doctorrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($doctorrow->width) ? $doctorrow->width : ''; ?>" hth="<?php echo isset($doctorrow->height) ? $doctorrow->height : ''; ?>">
                                                    </a>
                                            </figure>
                                            <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($doctorrow->short_by))?$doctorrow->short_by:''; ?>
                                            </span>
<!--                                            <span class="badge1 btn-rounded">
                                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($doctorrow->ID) ?>" title="Click to change order">
                                                    <option value="" disabled selected hidden>Change order</option>
                                                    <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                                    <option value="<?=$j; ?>" <?=(isset($doctorrow->short_by) && $doctorrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </span>-->
                            </div>
                            <?php if (!empty($doctorrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($doctorrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                    <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($doctorrow->ID) ?>" image_size="1" >Remove</a> 
                                    <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($doctorrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                                </div>
                            </div>
                           
                           
                           <?php } ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $doctorrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $doctorrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($doctorrow->ID) ?>" wth="<?php echo isset($doctorrow->width) ? $doctorrow->width : ''; ?>" hth="<?php echo isset($doctorrow->height) ? $doctorrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $doctorrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($doctorrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($doctorrow->width) ? $doctorrow->width : ''; ?>" hth="<?php echo isset($doctorrow->height) ? $doctorrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if(!empty($doctorrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($doctorrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($doctorrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($doctorrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                           
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <div class="widget-list all_doctor_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">All Doctors (default 3 photos)</h5>
                        <div class="row" >
                            <?php $id_with_row=0;
                            $all_doctor=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'all_doctor'))->result();
                            $id_with_row=$id_with_row=$this->db->where(array('src!='=>'','module_name'=>'all_doctor'))->count_all_results('app_banner_setting');
                            $i=1;$more=0;
                            foreach ($all_doctor as $alldoctorrow){
                                if($alldoctorrow->src!=''){
                            ?>
                                    <div class="col-md-3 mr-b-30 all_doctor_box">
                                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $alldoctorrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($alldoctorrow->ID) ?>" wth="<?php echo isset($alldoctorrow->width) ? $alldoctorrow->width : ''; ?>" hth="<?php echo isset($alldoctorrow->height) ? $alldoctorrow->height : ''; ?>"></span>
                                                    <a href="javascript:void(0);" data-dir="<?php echo $alldoctorrow->module_name; ?>" <?php echo ($alldoctorrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($alldoctorrow->ID) ?>" image_size="1" >
                                                    <img src="<?php echo ($alldoctorrow->src)?$alldoctorrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($alldoctorrow->width) ? $alldoctorrow->width : ''; ?>" hth="<?php echo isset($alldoctorrow->height) ? $alldoctorrow->height : ''; ?>">
                                                    </a>
                                            </figure>
                                            <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($alldoctorrow->short_by))?$alldoctorrow->short_by:''; ?>
                                            </span>
<!--                                            <span class="badge1 btn-rounded">
                                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($alldoctorrow->ID) ?>" title="Click to change order">
                                                    <option value="" disabled selected hidden>Change order</option>
                                                    <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                                    <option value="<?=$j; ?>" <?=(isset($alldoctorrow->short_by) && $alldoctorrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </span>-->
                            </div>
                            <?php if (!empty($alldoctorrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($alldoctorrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                    <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($alldoctorrow->ID) ?>" image_size="1" >Remove</a> 
                                    <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($alldoctorrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                                </div>
                            </div>
                            
                            <?php }  ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $alldoctorrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $alldoctorrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($alldoctorrow->ID) ?>" wth="<?php echo isset($alldoctorrow->width) ? $alldoctorrow->width : ''; ?>" hth="<?php echo isset($alldoctorrow->height) ? $alldoctorrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $alldoctorrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($alldoctorrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($alldoctorrow->width) ? $alldoctorrow->width : ''; ?>" hth="<?php echo isset($alldoctorrow->height) ? $alldoctorrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if (!empty($alldoctorrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($alldoctorrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($alldoctorrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($alldoctorrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                            
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>	
    <div class="widget-list doctor_detail_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Doctors Details (default 3 photos)</h5>
                        <div class="row" >
                                <?php $id_with_row=0;
                                $doctor_details=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'doctor_details'))->result();
                                $id_with_row=$id_with_row=$this->db->where(array('src!='=>'','module_name'=>'doctor_details'))->count_all_results('app_banner_setting');
                                $i=1;$more=0;
                                foreach ($doctor_details as $docdtrow) {
                                    if($docdtrow->src!=''){
                                ?>
                                        <div class="col-md-3 mr-b-30 doctor_detail_box">
                                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                                <figure>
                                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $docdtrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($docdtrow->ID) ?>" wth="<?php echo isset($docdtrow->width) ? $docdtrow->width : ''; ?>" hth="<?php echo isset($docdtrow->height) ? $docdtrow->height : ''; ?>"></span>
                                                        <a href="javascript:void(0);" data-dir="<?php echo $docdtrow->module_name; ?>" <?php echo ($docdtrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($docdtrow->ID) ?>" image_size="1" >
                                                        <img src="<?php echo ($docdtrow->src)?$docdtrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($docdtrow->width) ? $docdtrow->width : ''; ?>" hth="<?php echo isset($docdtrow->height) ? $docdtrow->height : ''; ?>">
                                                        </a>
                                                </figure>
                                                <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($docdtrow->short_by))?$docdtrow->short_by:''; ?>
                                                </span>
<!--                                                <span class="badge1 btn-rounded">
                                                        <select class="dropdown change_order" name="short_by" data-id="<?= md5($docdtrow->ID) ?>" title="Click to change order">
                                                        <option value="" disabled selected hidden>Change order</option>
                                                        <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                                        <option value="<?=$j; ?>" <?=(isset($docdtrow->short_by) && $docdtrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                        <?php } ?>
                                                        </select>
                                                </span>-->
                                </div>
                                <?php if (!empty($docdtrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($docdtrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($docdtrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($docdtrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                    </div>
                                </div>
                            
                                <?php }  ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $docdtrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $docdtrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($docdtrow->ID) ?>" wth="<?php echo isset($docdtrow->width) ? $docdtrow->width : ''; ?>" hth="<?php echo isset($docdtrow->height) ? $docdtrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $docdtrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($docdtrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($docdtrow->width) ? $docdtrow->width : ''; ?>" hth="<?php echo isset($docdtrow->height) ? $docdtrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if (!empty($docdtrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($docdtrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($docdtrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($docdtrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                            
                                <?php } ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <div class="widget-list vaccination_detail_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Vaccination (default 4 photos)</h5>
                       <div class="row" >
                            <?php $id_with_row=0;
                            $vaccination=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'vaccination'))->result();
                            $id_with_row=$this->db->where(array('src!='=>'','module_name'=>'vaccination'))->count_all_results('app_banner_setting');
                            $i=1;$more=0;
                            foreach ($vaccination as $vacntrow) {
                                if($vacntrow->src!=''){
                            ?>
                                    <div class="col-md-3 mr-b-30 vaccination_box">
                                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $vacntrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($vacntrow->ID) ?>" wth="<?php echo isset($vacntrow->width) ? $vacntrow->width : ''; ?>" hth="<?php echo isset($vacntrow->height) ? $vacntrow->height : ''; ?>"></span>
                                                    <a href="javascript:void(0);" data-dir="<?php echo $vacntrow->module_name; ?>" <?php echo ($vacntrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($vacntrow->ID) ?>" image_size="1" >
                                                    <img src="<?php echo ($vacntrow->src)?$vacntrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($vacntrow->width) ? $vacntrow->width : ''; ?>" hth="<?php echo isset($vacntrow->height) ? $vacntrow->height : ''; ?>">
                                                    </a>
                                            </figure>
                                            <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($vacntrow->short_by))?$vacntrow->short_by:''; ?>
                                            </span>
<!--                                            <span class="badge1 btn-rounded">
                                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($vacntrow->ID) ?>" title="Click to change order">
                                                    <option value="" disabled selected hidden>Change order</option>
                                                    <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                                    <option value="<?=$j; ?>" <?=(isset($vacntrow->short_by) && $vacntrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </span>-->
                            </div>
                            <?php if (!empty($vacntrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($vacntrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                    <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($vacntrow->ID) ?>" image_size="1" >Remove</a> 
                                    <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($vacntrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                                </div>
                            </div>
                           
                           <?php }  ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $vacntrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $vacntrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($vacntrow->ID) ?>" wth="<?php echo isset($vacntrow->width) ? $vacntrow->width : ''; ?>" hth="<?php echo isset($vacntrow->height) ? $vacntrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $vacntrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($vacntrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($vacntrow->width) ? $vacntrow->width : ''; ?>" hth="<?php echo isset($vacntrow->height) ? $vacntrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if (!empty($vacntrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($vacntrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($vacntrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($vacntrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                           
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <div class="widget-list shop_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Shop (default 6 photos)</h5>
                       <div class="row" >
                            <?php $id_with_row=0;
                            $shop=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'shop'))->result();
                            $id_with_row=$id_with_row=$this->db->where(array('src!='=>'','module_name'=>'shop'))->count_all_results('app_banner_setting');
                            $i=1;$more=0;
                            foreach ($shop as $shoptrow) {
                                if($shoptrow->src!=''){
                            ?>
                            <div class="col-md-3 mr-b-30 shop_box">
                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $shoptrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($shoptrow->ID) ?>" wth="<?php echo isset($shoptrow->width) ? $shoptrow->width : ''; ?>" hth="<?php echo isset($shoptrow->height) ? $shoptrow->height : ''; ?>"></span>
                                                    <a href="javascript:void(0);" data-dir="<?php echo $shoptrow->module_name; ?>" <?php echo ($shoptrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($shoptrow->ID) ?>" image_size="1" >
                                                    <img src="<?php echo ($shoptrow->src)?$shoptrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($shoptrow->width) ? $shoptrow->width : ''; ?>" hth="<?php echo isset($shoptrow->height) ? $shoptrow->height : ''; ?>">
                                                    </a>
                                            </figure>
                                            <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($shoptrow->short_by))?$shoptrow->short_by:''; ?>
                                            </span>
<!--                                            <span class="badge1 btn-rounded">
                                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($shoptrow->ID) ?>" title="Click to change order">
                                                    <option value="" disabled selected hidden>Change order</option>
                                                    <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                                    <option value="<?=$j; ?>" <?=(isset($shoptrow->short_by) && $shoptrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </span>-->
                            </div>
                            <?php if (!empty($shoptrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($shoptrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                    <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($shoptrow->ID) ?>" image_size="1" >Remove</a> 
                                    <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($shoptrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                                </div>
                            </div>
                           
                           <?php }  ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $shoptrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $shoptrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($shoptrow->ID) ?>" wth="<?php echo isset($shoptrow->width) ? $shoptrow->width : ''; ?>" hth="<?php echo isset($shoptrow->height) ? $shoptrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $shoptrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($shoptrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($shoptrow->width) ? $shoptrow->width : ''; ?>" hth="<?php echo isset($shoptrow->height) ? $shoptrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if (!empty($shoptrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($shoptrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($shoptrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($shoptrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                           
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>	
    <div class="widget-list about_us_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">About Us (default 3 photos)</h5>
                        <div class="row" >
                            <?php $id_with_row=0;
                            $about_us=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'about_us'))->result();
                            $i=1;$more=0;
                            foreach ($about_us as $aboutrow) {
                                if($aboutrow->src!=''){
                            ?>
                                    <div class="col-md-3 mr-b-30 about_us_box">
                                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $aboutrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($aboutrow->ID) ?>" wth="<?php echo isset($aboutrow->width) ? $aboutrow->width : ''; ?>" hth="<?php echo isset($aboutrow->height) ? $aboutrow->height : ''; ?>"></span>
                                                    <a href="javascript:void(0);" data-dir="<?php echo $aboutrow->module_name; ?>" <?php echo ($aboutrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($aboutrow->ID) ?>" image_size="1" >
                                                    <img src="<?php echo ($aboutrow->src)?$aboutrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($aboutrow->width) ? $aboutrow->width : ''; ?>" hth="<?php echo isset($aboutrow->height) ? $aboutrow->height : ''; ?>">
                                                    </a>
                                            </figure>
                                            <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($aboutrow->short_by))?$aboutrow->short_by:''; ?>
                                            </span>
<!--                                            <span class="badge1 btn-rounded">
                                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($aboutrow->ID) ?>" title="Click to change order">
                                                    <option value="" disabled selected hidden>Change order</option>
                                                    <?php for($j=1;$j<=count($about_us);$j++){ ?>
                                                    <option value="<?=$j; ?>" <?=(isset($aboutrow->short_by) && $aboutrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </span>-->
                            </div>
                            <?php if (!empty($aboutrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($aboutrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                    <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($aboutrow->ID) ?>" image_size="1" >Remove</a> 
                                    <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($aboutrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                                </div>
                            </div>
                            
                             <?php }  ?>
                            <!--TO ADD MORE-->
                                <?php if($more==0 && $aboutrow->src==''){ $more++;  //89 is last id of pregnancy?>
                                <div class="col-md-3 mr-b-30 pregnancy_box">
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                                <span style="display: none;" data-toggle="modal" data-dir="<?php echo $aboutrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($aboutrow->ID) ?>" wth="<?php echo isset($aboutrow->width) ? $aboutrow->width : ''; ?>" hth="<?php echo isset($aboutrow->height) ? $aboutrow->height : ''; ?>"></span>
                                                <a href="javascript:void(0);" data-dir="<?php echo $aboutrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($aboutrow->ID) ?>" image_size="1" >
                                                <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($aboutrow->width) ? $aboutrow->width : ''; ?>" hth="<?php echo isset($aboutrow->height) ? $aboutrow->height : ''; ?>">
                                                </a>
                                        </figure>
                                </div>
                                <?php if (!empty($shoptrow->src)) { ?>											
                                <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($aboutrow->updater_date)); ?></a></div>
                                <div class="card-body sub-heading-font-family">
                                        <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($aboutrow->ID) ?>" image_size="1" >Remove</a> 
                                        <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($aboutrow->ID) ?>" image_size="1" >Change Image</a>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } ?>
                                <!--END TO ADD MORE-->
                            
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>	
    <div class="widget-list pregnancy_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <h5 class="box-title">Pregnancy (default 40 photos)</h5>
                        <div class="row" >
                            <?php $id_with_row=0;
                            $pregnancy=$this->db->order_by('short_by','asc')->get_where('app_banner_setting',array('module_name'=>'pregnancy'))->result();//,'src!='=>''
                            $id_with_row=$this->db->where(array('src!='=>'','module_name'=>'pregnancy'))->count_all_results('app_banner_setting');
                            $i=1;$more=0;
                            foreach ($pregnancy as $pregnancyrow) {
                                if($pregnancyrow->src!=''){
                            ?>
                            <div class="col-md-3 mr-b-30 pregnancy_box">
                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                <figure>
                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $pregnancyrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($pregnancyrow->ID) ?>" wth="<?php echo isset($pregnancyrow->width) ? $pregnancyrow->width : ''; ?>" hth="<?php echo isset($pregnancyrow->height) ? $pregnancyrow->height : ''; ?>"></span>
                                    <a href="javascript:void(0);" data-dir="<?php echo $pregnancyrow->module_name; ?>" <?php echo ($pregnancyrow->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5($pregnancyrow->ID) ?>" image_size="1" >
                                    <img src="<?php echo ($pregnancyrow->src)?$pregnancyrow->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="150" wth="<?php echo isset($pregnancyrow->width) ? $pregnancyrow->width : ''; ?>" hth="<?php echo isset($pregnancyrow->height) ? $pregnancyrow->height : ''; ?>">
                                    </a>
                                </figure>
                                 <span class="badge1 btn-rounded new_order ">
                                                    <?=(isset($pregnancyrow->short_by))?$pregnancyrow->short_by:''; ?>
                                </span>
<!--                                <span class="badge1 btn-rounded">
                                    <select class="dropdown change_order" name="short_by" data-id="<?= md5($pregnancyrow->ID) ?>" title="Click to change order">
                                    <option value="" disabled selected hidden>Change order</option>
                                    <?php for($j=1;$j<=$id_with_row;$j++){ ?>
                                    <option value="<?=$j; ?>" <?=(isset($pregnancyrow->short_by) && $pregnancyrow->short_by==$j)?"selected":"";?>><?=$j; ?></option>
                                    <?php } ?>
                                    </select>
                                </span>-->
                            </div>
                            <?php if (!empty($pregnancyrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($pregnancyrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($pregnancyrow->ID) ?>" image_size="1" >Remove</a> 
                                <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($pregnancyrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                            </div>
                            </div>
                             <?php } ?>
                            <!--TO ADD MORE-->
                            <?php if($more==0 && $pregnancyrow->src==''){ $more++;  //89 is last id of pregnancy?>
                            <div class="col-md-3 mr-b-30 pregnancy_box">
                            <div class="card blog-post-new">
                            <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                <figure>
                                    <span style="display: none;" data-toggle="modal" data-dir="<?php echo $pregnancyrow->module_name; ?>" class="upload_img_btn" data-id="<?= md5($pregnancyrow->ID) ?>" wth="<?php echo isset($pregnancyrow->width) ? $pregnancyrow->width : ''; ?>" hth="<?php echo isset($pregnancyrow->height) ? $pregnancyrow->height : ''; ?>"></span>
                                    <a href="javascript:void(0);" data-dir="<?php echo $pregnancyrow->module_name; ?>" style="cursor:auto" data-toggle="modal" class="upload_img_btn" title="Click to add more image"  data-id="<?= md5($pregnancyrow->ID) ?>" image_size="1" >
                                    <img src="<?php echo base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="240" wth="<?php echo isset($pregnancyrow->width) ? $pregnancyrow->width : ''; ?>" hth="<?php echo isset($pregnancyrow->height) ? $pregnancyrow->height : ''; ?>">
                                    </a>
                                </figure>
                            </div>
                            <?php if (!empty($pregnancyrow->src)) { ?>											
                            <div class="pleft" ><a href="javascript:void(0);"  ><?= date("M d,Y", strtotime($pregnancyrow->updater_date)); ?></a></div>
                            <div class="card-body sub-heading-font-family">
                                <a href="javascript:void(0);" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5($pregnancyrow->ID) ?>" image_size="1" >Remove</a> 
                                <a href="javascript:void(0);" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  style="float:right" data-id="<?= md5($pregnancyrow->ID) ?>" image_size="1" >Change Image</a>
                            </div>
                            <?php } ?>
                            </div>
                            </div>
                            <?php } ?>
                            <!--END TO ADD MORE-->
                            
                            
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <div class="widget-list fertility_tab">
        <div class="row">
            <!-- Card with Image -->
            <div class="col-md-12 widget-holder">
                <div class="widget-bg-transparent">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-3 mr-b-30 fertility_box">
                                <h5 class="box-title" align="center">Fertility <br>(1 photos)</h5>
                                <div class="card blog-post-new">
                                    <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                            <figure>
                                            <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[89]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(90) ?>" wth="<?php echo isset($details[89]->width) ? $details[89]->width : ''; ?>" hth="<?php echo isset($details[89]->height) ? $details[89]->height : ''; ?>"></span>

                                            <a href="javascript:void(0);" data-dir="<?php echo $details[89]->module_name; ?>" <?php echo ($details[89]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(90) ?>" image_size="1" >
                                            <img src="<?php echo ($details[89]->src)?$details[89]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[89]->src)?'150':'240'; ?>" wth="<?php echo isset($details[89]->width) ? $details[89]->width : ''; ?>" hth="<?php echo isset($details[89]->height) ? $details[89]->height : ''; ?>">
                                                    </a>
                                            </figure>

                                    </div>
                                        <?php if (!empty($details[89]->src)) { ?>
                                                <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[89]->updater_date)); ?></a></div>
                                                <div class=" card-body sub-heading-font-family" >
                                                        <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(90) ?>">Remove</a> 
                                                        <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(90) ?>"  style="float:right" >Change Image</a>
                                                </div>
                                        <?php } ?>
                                </div>
                            </div> 
                            
                            <div class="col-md-3 mr-b-30 haw_box">
                                <h5 class="box-title" align="center">Reset Password<br>(1 photos)</h5>
                                <div class="card blog-post-new">
                                <div class="card-header sub-heading-font-family border-bottom-0 p-0">
                                        <figure>
                                        <span style="display: none;" data-toggle="modal" data-dir="<?php echo $details[90]->module_name; ?>" class="upload_img_btn" data-id="<?= md5(91) ?>" wth="<?php echo isset($details[90]->width) ? $details[90]->width : ''; ?>" hth="<?php echo isset($details[90]->height) ? $details[90]->height : ''; ?>"></span>

                                        <a href="javascript:void(0);" data-dir="<?php echo $details[90]->module_name; ?>" <?php echo ($details[90]->src)?'style="cursor:auto"':'data-toggle="modal" class="upload_img_btn" title="Click to change image"'?>  data-id="<?= md5(91) ?>" image_size="1" >
                                        <img src="<?php echo ($details[90]->src)?$details[90]->src:base_url('assets/img/icon/upload-picture.png'); ?>" class="card-img-top"  height="<?php echo ($details[90]->src)?'150':'240'; ?>" wth="<?php echo isset($details[90]->width) ? $details[90]->width : ''; ?>" hth="<?php echo isset($details[90]->height) ? $details[90]->height : ''; ?>">
                                        </a>
                                        </figure>

                                </div>
                                    <?php if (!empty($details[90]->src)) { ?>
                                            <div class="pleft" ><a href="javascript:void(0);" class="card-link fw-300 mr-auto mr-0-rtl ml-auto-rtl"><?= date("M d,Y", strtotime($details[90]->updater_date)); ?></a></div>
                                            <div class=" card-body sub-heading-font-family" >
                                                    <a href="#" class="remove_img btn btn-xs btn-outline-primary btn-rounded choose-image-href" data-id="<?= md5(91) ?>">Remove</a> 
                                                    <a href="#" data-toggle="modal" class="upload_img_btn_click btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left" data-id="<?= md5(91) ?>"  style="float:right" >Change Image</a>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Blog Posts -->

            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>			
    <div class="widget-list txt">
        <div class="widget-body clearfix">
            <div class="overflow" style="overflow-x:hidden">
                <!--image width check-->
                <img src="#" id="imgwidthcheck" style="display:none;">
            <!--end image width check-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" action="<?= $curr_url ?>/change_image">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        
                            <div class="modal-header text-inverse">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h5 class="modal-title" id="myMediumModalLabel2">Image</h5>
                            </div>
                        
                        
                        <!--image history-->
                         <div class="row" style="padding:8px">	
                            <div class="col-md-3 ">
                                <a href="javascript:void(0);" class="actv active all_history btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  >All Images Uploaded</a>
                            </div>
                            <div class="col-md-3 ">
                                <a href="javascript:void(0);" class="actv latest_history btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  >Recent Uploaded</a>
                            </div>
                            <div class="col-md-3 ">
                                <a href="javascript:void(0);" class="actv upload_new_image btn btn-xs btn-outline-primary btn-rounded choose-image-href pull-left"  >Upload New Image</a>
                            </div>
                        </div>
                        <div class="row image_history">
                                <div class="col-md-7 ">
                                <div class="row vscroll">
                                
                                </div>
                                </div>
            <div class="col-md-1"></div>
            <!-- mobile preview-->
            <div class="col-md-4">
                    <div class="text-inverse col-md-12" style="background: #00b1f3;">
                            <span><i class="feather feather-menu list-icon fs-20"></i> &nbsp;Preview on App</span>
                            <span><i class="" aria-hidden="true"></i></span>
                            <div class="pull-right">
                                <span><i class="fa fa-phone" aria-hidden="true"></i></span> &nbsp;
                                <span><i class="fa fa-bell-o" aria-hidden="true"></i></span> &nbsp;
                            </div>
                    </div>
                    <div style="height: 150px;">
                        <figure>
                            <img style="width: 100%;border: 1px solid #ede9e0;" id='imgpreviewmobile' class="img" src="<?=base_url().'assets/img/icon/not-available.jpg';?>" >
                            <div class="">
                            </div>
                        </figure>
                    </div>
                                <div class="preiview_save" style=" margin: 53px 40px 0 85px; ">
                                    <input type="hidden" id="image_id" value=""  >
                                    <span class="btn btn-success btn-rounded ripple text-left upload_image">Save</span>
                                </div>
            </div>
            <!--end mobile preview-->
                        </div>
                        <p style="padding-top:20px"> </p>
                         
                        <!--end image history-->
                        <div class="row image_upload_row" style="display:none;">
                        <div class="col-md-7 border">
                            <form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="<?= $curr_url ?>/change_image">
                                <div class="">
                                    <div class="blog-post blog-post-card text-center">
                                    </div>	
                                    <input type="hidden" name="model_image" value="<?= rtrim($curr_url, "/") ?>">
                                    <input type="hidden"  id="bann_id" name="ID" value=""  >
                                    <input type="hidden"  id="dir_name" name="dir_name" value=""  >
                                    <input type="hidden" id="file_name" name="file_name" value="src">
                                    <input type="hidden" id="width" name="width" value="src">
                                    <input type="hidden" id="height" name="height" value="src">
                                    <div>
                                        <label>banner image? * </label><span align="center">
                                            <img style="width:85px;float:right;height:60px;border: 1px solid;" class="img" src="#" id="imgpreview" wth='' hth=''>
                                        </span>
                                    </div><p></p>
                                    <p class="imagemsg">Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB.</p>
                                    <input id="imagesrc" name="src" class="src imagesrc"  type="file"  data-rule-required="true" data-msg-required="Please select Image." >
                                    <span class="errorfile" style="display: none;color: #f00;">Please select image
                                    </span>	
                                </div>
                                <div class="modal-footer">
                                    <!--<span class="btn btn-success btn-rounded ripple text-left submit">Save</span>-->
                                    <button type="button" class="btn btn-success btn-rounded ripple text-left saveimage_n upload_save">Save</button>
                                    <button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                            
                        </div>
                            <div class="col-md-1"></div>
                        <div class="col-md-4 border">
                                <div class="text-inverse col-md-12" style="background: #00b1f3;">
					<span><i class="feather feather-menu list-icon fs-20"></i> &nbsp;Preview on App</span>
					<span><i class="" aria-hidden="true"></i></span>
                                        <div class="pull-right">
                                            <span><i class="fa fa-phone" aria-hidden="true"></i></span> &nbsp;
                                            <span><i class="fa fa-bell-o" aria-hidden="true"></i></span> &nbsp;
                                        </div>
				</div>
                                <div style="height: 150px;">
                                    <figure>
                                        <img style="width: 100%;border: 1px solid #ede9e0;" id='imgpreviewmobile2' class="img" src="<?=base_url().'assets/img/icon/not-available.jpg';?>" >
                                        <div class="">
                                        </div>
                                    </figure>
                                </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /.widget-body -->
        </div>
        </div>
        <!-- /.widget-holder -->
</main>
<!-- /.main-wrappper -->	
<!-- end page-->		

<!--Start footer-->
<div style="position:relative">
<?= $footer; ?>
</div>
<!--for change awarenes image Modal -->
<div class="modal modal-info fade bs-modal-changebannerImage" id="changebannerImage" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel2" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-inverse">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myMediumModalLabel2">Image</h5>
            </div>
            <form class="" accept-charset="UTF-8" enctype="multipart/form-data" method="post" action="<?= $curr_url ?>/change_image">
                <div class="modal-body">
                    <!-- Begin awarenes Image Field -->

                    <input type="hidden" name="model_image" value="<?= rtrim($curr_url, "/") ?>">
                    <input type="text"  id="bannid" name="ID"   >
                    <input type="text"  id="bann_id" name="ID" value=""  >
                    <input type="hidden" id="file_name" name="file_name" value="src">
                    <label for="src">banner image? * </label>
                    <p>Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB.</p>

                    <input id="src" name="src" class="src"  type="file"  data-rule-required="true" data-msg-required="Please select Image." >
                    <span class="error" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>					
                    <!-- End awarenes Image Field -->	
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded ripple text-left">Change</button>
                    <button type="button" class="btn btn-danger btn-rounded ripple text-left" data-dismiss="modal">Close this</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--end-->
<!--End footer-->


<script>
    $('#myModal').on('show.bs.modal', function (e) {
        var myRoomNumber = $(e.relatedTarget).attr('data-id');
        $("#bann_id").val(myRoomNumber);
    });

        $(document).on('click','.upload_img',function(){
        var ths = $(this);
        var wth = (ths.find('img').attr('wth')) ? ths.find('img').attr('wth') : '';
        var hth = (ths.find('img').attr('hth')) ? ths.find('img').attr('hth') : '';
        $("#imgpreview").attr('src', '');
        $("#imgpreview").attr('src', $(this).find('img').attr('src'));
        $("#imgpreview").attr('src', $(this).find('img').attr('src'));
        setTimeout(function () {
            $('#bann_id').val(ths.data('id'));
            $('#image_id').val(ths.data('id'));
            $('#imgpreview').attr('wth', wth);
            $('#imgpreview').attr('hth', hth);
        }, 200);
        $(".imagemsg").text('');
        $(".imagemsg").text('Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB. Image dimension must be ' + wth + 'X' + hth);
        $("#myModal").modal('show');
    });

    $(document).on('click','.upload_img_btn',function(){
        var ths = $(this);
        //directory image list
        var image_dir=ths.data('dir');
        $('#dir_name').val(image_dir);
            $('#overlay').fadeIn();
            $.post(BASE_URL+'App_banner_setting/get_image',{image_dir:image_dir},function(data){
                if(data){
                    $('#overlay').fadeOut();
                    $('.vscroll').html('');
                    $('.vscroll').html(data);
                }
            })
        //directory image list end
        
        $('#width').val('');
        $('#height').val('');
        var wth = (ths.parent().find('img').attr('wth')) ? ths.parent().find('img').attr('wth') : '';
        var hth = (ths.parent().find('img').attr('hth')) ? ths.parent().find('img').attr('hth') : '';
        if(hth=='500'){
                    hthpreview='200px';
            }else{
                    hthpreview='150px';
            }
        $("#imgpreviewmobile").css('height',hthpreview);
        $("#imgpreview").attr('src', '');
        $("#imgpreview").attr('src', $(this).parent().find('img').attr('src'));
        $("#imgpreviewmobile").attr('src', $(this).parent().find('img').attr('src'));
        $("#imgpreviewmobile2").attr('src', $(this).parent().find('img').attr('src'));
        setTimeout(function () {
            $('#bann_id').val(ths.data('id'));
            $('#image_id').val(ths.data('id'));
            $('#imgpreview').attr('wth', wth);
            $('#imgpreview').attr('hth', hth);
            $('#width').val(wth);
            $('#height').val(hth);
        }, 200);
        $(".imagemsg").text('');
        $(".imagemsg").text('Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB. Image dimension must be ' + wth + 'X' + hth);
        $("#myModal").modal('show');
    });
    
  $(document).on('click','.history_image',function(){
        var src=$(this).attr('src');
        $('#imgpreviewmobile').attr('');
        $('#imgpreviewmobile').attr('src',src);
      
    })
    
  $(document).on('click','.upload_img_btn_click',function(){
//      var image_dir=$(this).data('dir');
//    $('#overlay').fadeIn();
//    $.post(BASE_URL+'App_banner_setting/get_image',{image_dir:image_dir},function(data){
//        if(data){
//            $('#overlay').fadeOut();
//            $('.vscroll').html('');
//            $('.vscroll').html(data);
//        }
//    })
      $(this).parent().parent().find('.upload_img_btn').trigger('click');
	  setTimeout(function(){$('.all_history ').trigger('click');},100);
  });
    
    $(document).on('click','.remove_img',function(){
        var ths = $(this);
        var defaultimg='assets/img/icon/upload-picture.png';
        var conf=confirm('Are you sure to remove this image');
        if(conf){
            $('#overlay').fadeIn();
            $.post(BASE_URL+'App_banner_setting/remove_image',{id:ths.data('id')},function(data){
                var dt=JSON.parse(data);
                if(dt.status>0){
                    $('#overlay').fadeOut();
                    alert(dt.msg);
                    window.location.reload();
                    ths.parent().parent().find('img').attr('src',defaultimg);
                    ths.parent().parent().find('a').hide();
                    ths.parent().closest('div').find('.pleft a').hide();
                }else{
                    alert(dt.msg);
                }
            })
        }else{
        }
        
    });
    $(document).on('click','.upload_image',function(){
        var conf=confirm('Are you sure to save this image');
        if(conf){
            $.post(BASE_URL+'App_banner_setting/save_image',{id:$('#image_id').val(),src:$('#imgpreviewmobile').attr('src')},function(data){
                var dt=JSON.parse(data);
                if(dt.status>0){
                    alert(dt.msg);
                    window.location.reload();
                }else{
                    alert(dt.msg);
                }
            })
        }else{
        }
        
    });
    $(function () {
        $('.modal').on('hidden.bs.modal', function () {
            $(".imagemsg").text('');
            $(".imagesrc").val('');
            $('.errorfile').css('display', 'none');
            $(".imagemsg").text('Note: Image should be in .jpeg format, min size 10 KB and max size 100 KB. Image dimension must be 500X250.');
        });
    })
</script>
<script>
    function readURL(input) {
        $("#imgwidthcheck").attr('src', '#');
        if (input.files && input.files[0]) {
            $('.errorfile').css('display', 'none');
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#imgpreview").attr('src', e.target.result);
                $("#imgpreviewmobile2").attr('src', e.target.result);
                //dimention check
                var $imaged = $("#imgwidthcheck").attr('src', e.target.result);
                $imaged.on('load', function () {
                    var ewidth = $("#imgpreview").attr('wth');
                    var eheight = $("#imgpreview").attr('hth');
                    //if ($imaged.width() == ewidth && $imaged.height() == eheight) {

                    //} else {
                       // $(".imagesrc").val('');
                       // alert('Image dimention is not correct. Please upload the exact dimensions(' + ewidth + 'X' + eheight + ') image.');
                    //}
                });
                //end
            }
            reader.readAsDataURL(input.files[0]);
            $("#imgpreview").show();
        }
    }

    $(".imagesrc").change(function () {
        readURL(this);
    });
</script>
<script>
    $(function () {
        $('.submit').click(function () {
            if (document.getElementById('imagesrc').files.length != 0) {
                $('.saveimage').trigger('click');
            } else {
                $('.errorfile').css('display', 'block');
            }
        });
    })
</script>
<script>
    //all_history latest_history upload_new_image
    $(document).on('click','.all_history',function(){
        $('.actv').removeClass('active');
        $(this).addClass('active');
        
        var image_dir=$('#dir_name').val();
        $('#overlay').fadeIn();
        $.post(BASE_URL+'App_banner_setting/get_image',{image_dir:image_dir},function(data){
            if(data){
                $('#overlay').fadeOut();
                $('.vscroll').html('');
                $('.vscroll').html(data);
            }else{
                $('.vscroll').html('');
                $('#overlay').fadeOut();
            }
        });      
        
        $('.image_history').show();
        $('.image_upload_row').hide();
    });
    
    $(document).on('click','.latest_history',function(){
        $('.actv').removeClass('active');
        $(this).addClass('active');
        var image_dir=$('#dir_name').val();
        $('#overlay').fadeIn();
        $.post(BASE_URL+'App_banner_setting/get_image',{image_dir:image_dir,recent:1},function(data){
            if(data){
                $('#overlay').fadeOut();
                $('.vscroll').html('');
                $('.vscroll').html(data);
            }else{
                $('.vscroll').html('');
                $('#overlay').fadeOut();
            }
        });      
        $('.image_history').show();
        $('.image_upload_row').hide();
    });
    $(document).on('click','.upload_new_image',function(){
        $('.actv').removeClass('active');
        $(this).addClass('active');
        $('.image_history').hide();
        $('.image_upload_row').show();
    });
    
    $(document).on('change','.change_order',function(){
        var conf=confirm('Are you sure to change order');
        if(conf){
            $('#overlay').fadeIn();
            $.post(BASE_URL+'App_banner_setting/change_order',{id:$(this).data('id'),order:$(this).val()},function(data){
                var dt=JSON.parse(data);
                if(dt.status>0){
                    $('#overlay').fadeOut();
                    alert(dt.msg);
                    window.location.reload();
                }else{
                    alert(dt.msg);
                }
            });
        }else{
        }
    });
</script>
<script>
    $(document).on('click','.upload_save',function(){
        var formdata=new FormData();
        formdata.append('filepic',$('.imagesrc')[0].files[0]);
        formdata.append('dir_name',$('#dir_name').val());
        formdata.append('width',$('input[name="width"]').val());
        formdata.append('height',$('input[name="height"]').val());
        $.ajax({
            type:'post',
            url:BASE_URL+'app_banner_setting/history_image',
            data:formdata,
            contentType:false,
            processData:false,
            success:function(data){                                                
                if(data){
					alert('Image uploaded successfully');
                    //var dt=JSON.parse(data);
                    //if(dt.status>0){
                        //$('#overlay').fadeOut();
                        //alert(dt.msg);
						$('.latest_history ').trigger('click');
                        //window.location.reload();
                    ///}else{
                    //    alert(dt.msg);
                    //}
                }else{
					alert('Image upload Failed');
				}
            }
        });
        });
       //remove history image  data/app/tour_guide/19121808080712_our3.png
        $(document).on('click','.remove_history_image',function(){
        var ths = $(this);
        var conf=confirm('Are you sure to remove this image from history!');
        if(conf){
            $.post(BASE_URL+'App_banner_setting/remove_history_image',{image_dir:ths.data('src')},function(data){
                var dt=JSON.parse(data);
                if(dt.status>0){
                    alert(dt.msg);
                    $('.all_history').trigger('click');
                }else{
                    alert(dt.msg);
                }
            })
        }else{
        }
        
    });
</script>
