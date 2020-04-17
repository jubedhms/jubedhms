<!--Start header-->
<?= $header; ?>
<!--End header-->

<?php
$ID = (isset($details->notification_id)) ? $details->notification_id : "";
?>
<style>
	#select-id-error{
		display:none;	
	}
	
	textarea {
		resize: none;
	}

    .priview-container {
        position: absolute;
        margin: 13px;
        margin-top: 10px;
        width: 134px;
        color: black;
        font-size: 8px;
        border-style: solid;
        border-width: thin;
        border-radius: 13px;
    }

    .lockscreenNotificationRow input,textarea,select {
        width: inherit;
    }

    .inAppNotificationRow input,textarea,select {
        width: inherit;
    }

    .btn-green {
        color: #fff;
        background-color: #028a3b;
        border-color: #037b36;
    }

    .btn-green:hover {
        color: #fff;
        background-color: #015f28;
        border-color: #01421c;
    }

</style>
<style>
	.actionURL {
		border: 1px rgb(169, 169, 169) solid;
	}
	
	.actionURL input {
		width: 80%;
		border: 0px;
		outline: none;
		margin: 0 0 0 10px;
	}
	
	.actionclear:hover {
	  background: #ccc;
	}
	
	.inAppActionClear{
		margin-left:10%;
	}
</style>
<main class="main-wrapper clearfix">
    <span class="action-message"><?= getFlashMsg('success_message'); ?></span>

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5"> <?= $mode . ' ' . $heading; ?></h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $main_page; ?>"><?= $mode . ' ' . $heading; ?></a>
                </li>
                <li class="breadcrumb-item active"><?= $mode . ' ' . $heading; ?></li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <!--start tab-->
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
    <!--end tab-->
    <div class="review">
        <form class=" MyForm" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="" method="post" autocomplete="off">

            <div class="widget-list">
                <div class="row">
                    <div class="col-md-12 widget-holder">
                        <div class="widget-bg">
                            <div class="widget-body clearfix">
                                <div class="row en">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="ID" value="<?= ($ID != '') ? md5($ID) : ''; ?>">
                                            <label for="name" class="">Campaign Name *</label>
                                            <input type="text" id="name" name="name" class="form-control" value="<?= isset($details->name) ? $details->name : ''; ?>" required="required" data-rule-required="true" data-msg-required="Please input name.">
                                            <span class="error" style="display: none;">
                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row vi" style="display:none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name_vi" class="">Chiến dịch Tên *</label>
                                            <input type="text" id="name_vi" name="name_vi" class="form-control" value="<?= isset($details->name_vi) ? $details->name_vi : ''; ?>" required="required" data-rule-required="true" data-msg-required="Please input name.">
                                            <span class="error" style="display: none;">
                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title" class="">Campaign Duration *</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date" class="">Start Date *  </label>
                                            <input type="text" class="form-control start_date datepicker" id="start_date" name="start_date" required="required" value="<?= isset($details->start_date) ? date('Y-m-d', strtotime($details->start_date)) : date('Y-m-d'); ?>"
                                                   data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd","startDate":"<?= date('Y-m-d'); ?>"}' data-rule-required="true" data-msg-required="Please select Start Date.">
                                            <span class="error" style="display: none;">
                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date" class="">End Date *  </label>
                                            <input type="text" class="form-control end_date datepicker" id="end_date" name="end_date" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd","startDate":"<?= date('Y-m-d'); ?>"}' required="required" value="<?= isset($details->end_date) ? date('Y-m-d', strtotime($details->end_date)) : date('Y-m-d'); ?>"
                                                   data-rule-required="true" data-msg-required="Please select End Date.">
                                            <span class="error" style="display: none;">
                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category" class="">Category *  </label>
                                            <select class="form-control category" id="category" name="category" required="required" data-rule-required="true" data-msg-required="Please select category.">
                                                <?php
                                                $categories = [
                                                    '' => 'Select',
                                                    'awareness' => 'Awareness',
                                                    'doctor_appointment' => 'Doctor Appointment',
                                                    'vaccine_appointment' => 'Vaccine Appointment',
                                                    'pregnancy_period' => 'Pregnancy Period',
                                                    'special_offer' => 'Special Offer',
                                                    'product' => 'Product',
                                                    'service' => 'Service',
                                                    'food_beverage' => 'Food and Beverage'
                                                ];
                                                if ($categories && count($categories) > 0) {
                                                    foreach ($categories as $key => $value) {
                                                        ?>
                                                        <option value="<?= $key; ?>" <?= ($key == getFieldVal('category', $details)) ? "selected" : ""; ?>><?= $value; ?></option>
														<?php }
													} ?>
                                            </select>
                                            <span class="error" style="display: none;">
                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team" class="">Team *  </label>
                                            <select id="team" name="team" class="form-control team" required="required" data-rule-required="true" data-msg-required="Please select team.">
                                            <?php
                                                $teams = ['' => 'Select', 'IT' => 'IT', 'Marketing' => 'Marketing', 'Operation' => 'Operation', 'Customer Service' => 'Customer Service', 'Front office' => 'Front office', 'Pharmacy' => 'Pharmacy'];
                                                if ($teams && count($teams) > 0) {
                                                    foreach ($teams as $key => $value) {
                                                        ?>
                                                        <option value="<?= $key; ?>" class="<?= $key; ?>" <?= ($key == getFieldVal('team', $details)) ? "selected" : ""; ?>><?= $value; ?></option>
                                            <?php   }
                                                } ?>
                                            </select>
                                            <span class="error" style="display: none;">
                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title" class="">Notification Type *</label>
                                    </div>
                                </div>

                                <!-- Lockscreen Notification -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="lockscreenNotificationTemplate" class="">Lockscreen Notification</label>
                                        <input type="checkbox" class="lockscreenNotificationTemplate"  id="lockscreenNotificationTemplate" name="lockscreenNotificationTemplate" value="1" <?= (getFieldVal('lockscreenNotificationTemplate', $details) == 1) ? "checked" : ""; ?>/>
                                    </div>
                                </div>

                                <div class="row lockscreenNotificationRow" <?= (getFieldVal('lockscreenNotificationTemplate', $details) == 1) ? '' : 'style="display:none"'; ?>>
                                    <div class="col-md-9" style="border-style:solid; height: 330px;">
                                        <div class="row">
                                            <div class="col-sm-12 text-center"><label></label></div>
                                        </div>

                                        <div class="row en">
                                            <label for="lockscreen_title" class="col-sm-4">Title</label>
                                            <div class="col-sm-8 ">
                                                <input type="text" class="lockscreen_title" id="lockscreen_title" name="lockscreen_title" value="<?= getFieldVal('lockscreen_title', $details); ?>">
                                            </div>
                                        </div>

                                        <div class="row en">
                                            <label for="lockscreen_message" class="col-sm-4">Message</label>
                                            <div class="col-sm-8">
                                                <textarea class="lockscreen_message" id="lockscreen_message" name="lockscreen_message" rows="4"><?= getFieldVal('lockscreen_message', $details); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row vi" style="display:none">
                                            <label for="lockscreen_title_vi" class="col-sm-4">Tiêu đề</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="lockscreen_title_vi" id="lockscreen_title_vi" name="lockscreen_title_vi" value="<?= getFieldVal('lockscreen_title_vi', $details); ?>">
                                            </div>
                                        </div>

                                        <div class="row vi" style="display:none">
                                            <label for="lockscreen_message_vi" class="col-sm-4">Thông điệp</label>
                                            <div class="col-sm-8">
                                                <textarea class="lockscreen_message_vi" id="lockscreen_message_vi" name="lockscreen_message_vi" rows="4"><?= getFieldVal('lockscreen_message_vi', $details); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="lockscreen_image_src" class="col-sm-4">Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="lockscreen_image_src" id="lockscreen_image_src" name="lockscreen_image_src" accept=".JPG,.JPEG,.jpg,.jpeg,.png,.PNG" data-min-size="1" data-max-size="1000" style="font-size: smaller;">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="lockscreen_image_src" class="col-sm-4">Logo</label>
                                            <div class="col-sm-8">
                                                <img class="logo" src="<?= base_url('assets/img/icon-bottom.png'); ?>" width="40px">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="lockscreen_action_first" class="col-sm-4">Action</label>
                                            <div class="col-sm-8">
                                                <select class="lockscreen_action_first" id="lockscreen_action_first" name="lockscreen_action_first" style="font-size: smaller;height: 30px; <?= (getFieldVal('lockscreen_action_first', $details) == 2) ? 'display: none' : ''; ?> ">
                                                    <option value="">Close the Notification</option>
													<option value="1" <?= (getFieldVal('lockscreen_action_first', $details) == 1) ? "selected" : ""; ?>>Go to In-App notification</option>
                                                    <option value="2" <?= (getFieldVal('lockscreen_action_first', $details) == 2) ? "selected" : ""; ?> >Website URL</option>													
                                                </select>
                                                
												<div class="actionURL" id="lockscreenActionFirstURL" style="<?= (getFieldVal('lockscreen_action_first', $details) != 2) ? 'display: none' : ''; ?>" >
													<input type="url" class="lockscreen_action_first_url" id="lockscreen_action_first_url" name="lockscreen_action_first_url" value="<?= getFieldVal('lockscreen_action_first_url', $details); ?>" placeholder="Please input Website Link.">
													<i class="fa fa-times actionclear inAppActionClear" id="closeLockscreenActionURL" aria-hidden="true" title="Close"></i>
												</div>
											</div>
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="height: fit-content;">
                                    </div>
									
									<!-- Lockscreen Priview-->
                                    <div class="col-md-2" style="background-image: url(<?= base_url('assets/img/iphone-x.png'); ?>); background-repeat: no-repeat;height:330px;">
                                        <div class="row">
											<div class="col-md-12" style="color:black; font-size:1.2vw; font-family: 'Orbitron', sans-serif; margin-left:40px; margin-top:70px;"><?= date("h:i A");?></div>
										</div>
										<div class="row priview-container">
                                            <div class="col-md-12">
                                                <figure>
													<img class="logo" src="<?= base_url('assets/img/icon-bottom.png'); ?>" style=" margin-top: 5px; width: 15px;">
													<span><?=  $this->WEBSITE_NAME;?></span>
												</figure>
												
											</div>
                                            <div class="row">
												<div class="col-md-9" style="padding: 5px;">
													<b><div id="lockscreen_priview_title"><?= (getFieldVal('lockscreen_title', $details) != '') ? getFieldVal('lockscreen_title', $details) : 'Example title'; ?></div></b>
													<div id="lockscreen_priview_message"><?= (getFieldVal('lockscreen_message', $details) != '') ? getFieldVal('lockscreen_message', $details) : 'Example message'; ?></div>
												</div>
												<div class="col-md-3">
													<figure>
														<img class="lockscreen_priview_image" id="lockscreen_priview_image" src="<?= (getFieldVal('lockscreen_image_src', $details) != '') ? base_url(getFieldVal('lockscreen_image_src', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" style="max-width: 28px;max-height: 28px;">
													</figure>
												</div>
											</div>
                                        </div>
                                    </div>
									<!-- End -->
									
                                </div>
                                <!-- End -->

                                <!-- In-App Notification -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="inAppNotificationTemplate" class="">In-App Notification</label>
                                        <input type="checkbox" class="inAppNotificationTemplate"  id="inAppNotificationTemplate" name="inAppNotificationTemplate" value="1" <?= (getFieldVal('inAppNotificationTemplate', $details) == 1) ? 'checked' : ''; ?>/>
                                    </div>
                                </div>

                                <div class="row inAppNotificationRow" <?= (getFieldVal('inAppNotificationTemplate', $details) == 1) ? '' : 'style="display:none"'; ?>>
                                    <div class="col-md-9">
                                        <div class="row">
                                            
                                            <!-- in App Notification Template Text -->
                                            <div class="col-md-4" style="border-style:solid; height: 330px; border-right: hidden;">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <label>
                                                            <span>Text</span>
                                                            <input type="checkbox" class="inAppNotification inAppTextNotification"  id="inAppTextNotification" name="inAppTextNotification" value="1" <?= (getFieldVal('in_app_template_type', $details) == 1) ? "checked" : ""; ?>/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_title1" class="col-sm-4">Title</label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input type="text" class="in_app_title1" id="in_app_title1" name="in_app_title1" value="<?= (getFieldVal('in_app_template_type', $details) == 1)?getFieldVal('in_app_title', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_message1" class="col-sm-4">Message</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message1" id="in_app_message1" name="in_app_message1" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 1)?getFieldVal('in_app_message', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_title_vi1" class="col-sm-4">Tiêu đề</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_title_vi1" id="in_app_title_vi1" name="in_app_title_vi1" value="<?= (getFieldVal('in_app_template_type', $details) == 1)?getFieldVal('in_app_title_vi', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_message_vi1" class="col-sm-4">Thông điệp</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message_vi1" id="in_app_message_vi1" name="in_app_message_vi1" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 1)?getFieldVal('in_app_message_vi', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- End -->
                                            
                                            <!-- in App Notification Template Text + Picture -->
                                            <div class="col-md-4" style="border-style:solid; height: 330px; border-right: hidden;">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <label>
                                                            <span>Text + Picture</span>
                                                            <input type="checkbox" class="inAppNotification inAppTextPictureNotification"  id="inAppTextPictureNotification" name="inAppTextPictureNotification" value="1" <?= (getFieldVal('in_app_template_type', $details) == 2) ? "checked" : ""; ?>/>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row en">
                                                    <label for="in_app_title2" class="col-sm-4">Title</label>
                                                    <div class="col-sm-8 ">
                                                        <input type="text" class="in_app_title2" id="in_app_title2" name="in_app_title2" value="<?= (getFieldVal('in_app_template_type', $details) == 2) ?getFieldVal('in_app_title', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_message2" class="col-sm-4">Message</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message2" id="in_app_message2" name="in_app_message2" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 2) ?getFieldVal('in_app_message', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_title_vi2" class="col-sm-4">Tiêu đề</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_title_vi2" id="in_app_title_vi2" name="in_app_title_vi2" value="<?= (getFieldVal('in_app_template_type', $details) == 2) ?getFieldVal('in_app_title_vi', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_message_vi2" class="col-sm-4">Thông điệp</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message_vi2" id="in_app_message_vi2" name="in_app_message_vi2" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 2) ?getFieldVal('in_app_message_vi', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="in_app_image_src2" class="col-sm-4">Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="in_app_image_src2" id="in_app_image_src2" name="in_app_image_src2" accept=".JPG,.JPEG,.jpg,.jpeg,.png,.PNG" data-min-size="1" data-max-size="1000" style="font-size: smaller;">
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            <!-- end -->
                                            
                                            <!-- in App Notification Template Text + Picture + Options -->
                                            <div class="col-md-4" style="border-style:solid; height: 330px;">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <label>
                                                            <span>Text + Picture + Options</span>
                                                            <input type="checkbox" class="inAppNotification inAppTextPictureOptionNotification"  id="inAppTextPictureOptionNotification" name="inAppTextPictureOptionNotification" value="1" <?= (getFieldVal('in_app_template_type', $details) == 3) ? "checked" : ""; ?>/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_title3" class="col-sm-4">Title</label>
                                                    <div class="col-sm-8 ">
                                                        <input type="text" class="in_app_title3" id="in_app_title3" name="in_app_title3" value="<?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_title', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_message3" class="col-sm-4">Message</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message3" id="in_app_message3" name="in_app_message3" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_message', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_title_vi3" class="col-sm-4">Tiêu đề</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_title_vi3" id="in_app_title_vi3" name="in_app_title_vi3" value="<?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_title_vi', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_message_vi3" class="col-sm-4">Thông điệp</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message_vi3" id="in_app_message_vi3" name="in_app_message_vi3" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_message_vi', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="in_app_image_src3" class="col-sm-4">Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="in_app_image_src3" id="in_app_image_src3" name="in_app_image_src3" accept=".JPG,.JPEG,.jpg,.jpeg,.png,.PNG" data-min-size="1" data-max-size="1000" style="font-size: smaller;">
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_action_btn_text_first3" class="col-sm-4">Button 1</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_first3" id="in_app_action_btn_text_first3" name="in_app_action_btn_text_first3" value="<?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_action_btn_text_first', $details):''; ?>" placeholder="Ok">
                                                    </div>
                                                </div>
												
												<div class="row vi" style="display:none">
                                                    <label for="in_app_action_btn_text_first_vi3" class="col-sm-4">Button 1</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_first_vi3" id="in_app_action_btn_text_first_vi3" name="in_app_action_btn_text_first_vi3" value="<?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_action_btn_text_first', $details):''; ?>" placeholder="Ok">
                                                    </div>
                                                </div>
																								
                                                <div class="row">
                                                    <label for="in_app_action_btn_first3" class="col-sm-4">Action</label>
                                                    <div class="col-sm-8">
                                                        <select class="in_app_action_btn_first3" id="in_app_action_btn_first3" name="in_app_action_btn_first3" style="font-size: smaller; height: 30px; <?= ((getFieldVal('in_app_template_type', $details) == 3) && (getFieldVal('in_app_action_btn_first', $details) == 2)) ? 'display: none' : ''; ?>">
                                                            <option value="">Close the Notification</option>
															<option value="1" <?= ((getFieldVal('in_app_template_type', $details) == 3) && (getFieldVal('in_app_action_btn_first', $details)) == 1) ? "selected" : ""; ?>>Go to In-App notification</option>
															<option value="2" <?= ((getFieldVal('in_app_template_type', $details) == 3) && (getFieldVal('in_app_action_btn_first', $details)) == 2) ? "selected" : ""; ?> >Website URL</option>
                                                        </select>
                                                        
														<div class="actionURL inAppActionFirstUrl3" id="inAppActionFirstUrl3" style="<?= ((getFieldVal('in_app_template_type', $details) == 3) && (getFieldVal('in_app_action_btn_first', $details) == 2)) ? '' : 'display: none'; ?>" >
															<input type="url" class="in_app_action_btn_url_first3" id="in_app_action_btn_url_first3" name="in_app_action_btn_url_first3" value="<?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_action_btn_url_first', $details):''; ?>" placeholder="Please input Website Link.">
															<i class="fa fa-times actionclear" id="closeInAppActionFirstUrl3" aria-hidden="true" title="Close"></i>
														</div>
                                                    </div>
                                                </div>
												
												<div class="row en">
                                                    <label for="in_app_action_btn_text_second3" class="col-sm-4">Button 2</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_second3" id="in_app_action_btn_text_second3" name="in_app_action_btn_text_second3" value="<?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_action_btn_text_second', $details):''; ?>" placeholder="Later">
                                                    </div>
                                                </div>
												
												<div class="row vi" style="display:none">
                                                    <label for="in_app_action_btn_text_second_vi3" class="col-sm-4">Button 2</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_second_vi3" id="in_app_action_btn_text_second_vi3" name="in_app_action_btn_text_second_vi3" value="<?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_action_btn_text_second_vi', $details):''; ?>" placeholder="Ok">
                                                    </div>
                                                </div>
												
                                                <div class="row">
                                                    <label for="in_app_action_btn_second3" class="col-sm-4">Action</label>
                                                    <div class="col-sm-8">
                                                        <select class="in_app_action_btn_second3" id="in_app_action_btn_second3" name="in_app_action_btn_second3" style="font-size: smaller; height: 30px; <?= ((getFieldVal('in_app_template_type', $details) == 3) && (getFieldVal('in_app_action_btn_second', $details) == 2)) ? 'display: none' : ''; ?>">
                                                            <option value="">Close the Notification</option>
															<option value="1" <?= ((getFieldVal('in_app_template_type', $details) == 3) && (getFieldVal('in_app_action_btn_second', $details) == 1)) ? "selected" : ""; ?>>Go to In-App notification</option>
															<option value="2" <?= ((getFieldVal('in_app_template_type', $details) == 3) && (getFieldVal('in_app_action_btn_second', $details) == 2)) ? "selected" : ""; ?> >Website URL</option>
                                                        </select>
                                                        <div class="actionURL inAppActionSecondUrl3" id="inAppActionSecondUrl3" style="<?= ((getFieldVal('in_app_template_type', $details) == 3) && (getFieldVal('in_app_action_btn_second', $details) == 2)) ? '' : 'display: none'; ?>" >
															<input type="url" class="in_app_action_btn_url_second3" id="in_app_action_btn_url_second3" name="in_app_action_btn_url_second3" value="<?= (getFieldVal('in_app_template_type', $details) == 3) ?getFieldVal('in_app_action_btn_url_second', $details):''; ?>" placeholder="Please input Website Link.">
															<i class="fa fa-times actionclear" id="closeInAppActionSecondUrl3" aria-hidden="true" title="Close"></i>
														</div>
													</div>
                                                </div>
                                            </div>
											<!-- end -->
                                        </div>
                                        <!-- end -->
                                        
                                        
                                        <div class="row" style="margin-bottom: 50px;">
                                            <!-- Text + Options -->
											<div class="col-md-4" style="border-style:solid; height: 330px; border-top: hidden; border-right: hidden;">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <label>
                                                            <span>Text + Options</span>
                                                            <input type="checkbox" class="inAppNotification inAppTextOptionNotification"  id="inAppTextOptionNotification" name="inAppTextOptionNotification" value="1" <?= (getFieldVal('in_app_template_type', $details) == 4) ? "checked" : ""; ?>/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_title4" class="col-sm-4">Title</label>
                                                    <div class="col-sm-8 ">
                                                        <input type="text" class="in_app_title4" id="in_app_title4" name="in_app_title4" value="<?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_title', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_message4" class="col-sm-4">Message</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message4" id="in_app_message4" name="in_app_message4" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_message', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_title_vi4" class="col-sm-4">Tiêu đề</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_title_vi4" id="in_app_title_vi4" name="in_app_title_vi4" value="<?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_title_vi', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_message_vi4" class="col-sm-4">Thông điệp</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message_vi4" id="in_app_message_vi4" name="in_app_message_vi4" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_message_vi', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_action_btn_text_first4" class="col-sm-4">Button 1</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_first4" id="in_app_action_btn_text_first4" name="in_app_action_btn_text_first4" value="<?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_action_btn_text_first', $details):''; ?>" placeholder="Ok">
                                                    </div>
                                                </div>
												
												<div class="row vi" style="display:none">
                                                    <label for="in_app_action_btn_text_first_vi4" class="col-sm-4">Button 1</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_first_vi4" id="in_app_action_btn_text_first_vi4" name="in_app_action_btn_text_first_vi4" value="<?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_action_btn_text_first_vi', $details):''; ?>" placeholder="Ok">
                                                    </div>
                                                </div>
												
                                                <div class="row">
                                                    <label for="in_app_action_btn_first4" class="col-sm-4">Action</label>
                                                    <div class="col-sm-8">
                                                        <select class="in_app_action_btn_first4" id="in_app_action_btn_first4" name="in_app_action_btn_first4" style="font-size: smaller; height: 30px; <?= ((getFieldVal('in_app_template_type', $details) == 4) && (getFieldVal('in_app_action_btn_first', $details) == 2)) ? 'display: none' : ''; ?>">
                                                            <option value="">Close the Notification</option>
															<option value="1" <?= ((getFieldVal('in_app_template_type', $details) == 4) && (getFieldVal('in_app_action_btn_first', $details)) == 1) ? "selected" : ""; ?>>Go to In-App notification</option>
															<option value="2" <?= ((getFieldVal('in_app_template_type', $details) == 4) && (getFieldVal('in_app_action_btn_first', $details)) == 2) ? "selected" : ""; ?> >Website URL</option>
                                                        </select>
                                                        
														<div class="actionURL inAppActionFirstUrl4" id="inAppActionFirstUrl4" style="<?= ((getFieldVal('in_app_template_type', $details) == 4) && (getFieldVal('in_app_action_btn_first', $details) == 2)) ? '' : 'display: none'; ?>" >
															<input type="url" class="in_app_action_btn_url_first4" id="in_app_action_btn_url_first4" name="in_app_action_btn_url_first4" value="<?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_action_btn_url_first', $details):''; ?>" placeholder="Please input Website Link.">
															<i class="fa fa-times actionclear" id="closeInAppActionFirstUrl4" aria-hidden="true" title="Close"></i>
														</div>
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_action_btn_text_second4" class="col-sm-4">Button 2</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_second4" id="in_app_action_btn_text_second4" name="in_app_action_btn_text_second4" value="<?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_action_btn_text_second', $details):''; ?>" placeholder="Later">
                                                    </div>
                                                </div>
												
												<div class="row vi" style="display:none">
                                                    <label for="in_app_action_btn_text_second_vi4" class="col-sm-4">Button 2</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_second_vi4" id="in_app_action_btn_text_second_vi4" name="in_app_action_btn_text_second_vi4" value="<?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_action_btn_text_second_vi', $details):''; ?>" placeholder="Later">
                                                    </div>
                                                </div>
												
                                                <div class="row">
                                                    <label for="in_app_action_btn_second4" class="col-sm-4">Action</label>
                                                    <div class="col-sm-8">
                                                        <select class="in_app_action_btn_second4" id="in_app_action_btn_second4" name="in_app_action_btn_second4" style="font-size: smaller; height: 30px; <?= ((getFieldVal('in_app_template_type', $details) == 4) && (getFieldVal('in_app_action_btn_second', $details) == 2)) ? 'display: none' : ''; ?>">
                                                           <option value="">Close the Notification</option>
															<option value="1" <?= ((getFieldVal('in_app_template_type', $details) == 4) && (getFieldVal('in_app_action_btn_second', $details)) == 1) ? "selected" : ""; ?>>Go to In-App notification</option>
															<option value="2" <?= ((getFieldVal('in_app_template_type', $details) == 4) && (getFieldVal('in_app_action_btn_second', $details)) == 2) ? "selected" : ""; ?> >Website URL</option>
                                                        </select>
                                                        
														<div class="actionURL inAppActionSecondUrl4" id="inAppActionSecondUrl4" style="<?= ((getFieldVal('in_app_template_type', $details) == 4) && (getFieldVal('in_app_action_btn_second', $details) == 2)) ? '' : 'display: none'; ?>" >
															<input type="url" class="in_app_action_btn_url_second4" id="in_app_action_btn_url_second4" name="in_app_action_btn_url_second4" value="<?= (getFieldVal('in_app_template_type', $details) == 4) ?getFieldVal('in_app_action_btn_url_second', $details):''; ?>" placeholder="Please input Website Link.">
															<i class="fa fa-times actionclear" id="closeInAppActionSecondUrl4" aria-hidden="true" title="Close"></i>
														</div>
													</div>
                                                </div>
                                            </div>
											<!-- end -->
											
											<!-- Text + Alerts -->
                                            <div class="col-md-4" style="border-style:solid; height: 330px; border-top: hidden; border-right: hidden;">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <label>
                                                            <span>Text + Alerts</span>
                                                            <input type="checkbox" class="inAppNotification inAppTextAlertNotification"  id="inAppTextAlertNotification" name="inAppTextAlertNotification" value="1" <?= (getFieldVal('in_app_template_type', $details) == 5) ? "checked" : ""; ?>/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_title5" class="col-sm-4">Title</label>
                                                    <div class="col-sm-8 ">
                                                        <input type="text" class="in_app_title5" id="in_app_title5" name="in_app_title5" value="<?= (getFieldVal('in_app_template_type', $details) == 5) ?getFieldVal('in_app_title', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_message5" class="col-sm-4">Message</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message5" id="in_app_message5" name="in_app_message5" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 5) ?getFieldVal('in_app_message', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_title_vi5" class="col-sm-4">Tiêu đề</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_title_vi5" id="in_app_title_vi5" name="in_app_title_vi5" value="<?= (getFieldVal('in_app_template_type', $details) == 5) ?getFieldVal('in_app_title_vi', $details):''; ?>">
                                                    </div>
                                                </div>

                                                <div class="row vi" style="display:none">
                                                    <label for="in_app_message_vi5" class="col-sm-4">Thông điệp</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="in_app_message_vi5" id="in_app_message_vi5" name="in_app_message_vi5" rows="4"><?= (getFieldVal('in_app_template_type', $details) == 5) ?getFieldVal('in_app_message_vi', $details):''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row en">
                                                    <label for="in_app_action_btn_text_second5" class="col-sm-4">Button 2</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_second5" id="in_app_action_btn_text_second5" name="in_app_action_btn_text_second5" value="<?= (getFieldVal('in_app_template_type', $details) == 5) ?getFieldVal('in_app_action_btn_text_second', $details):''; ?>" placeholder="Ok">
                                                    </div>
                                                </div>
												
												<div class="row vi" style="display:none">
                                                    <label for="in_app_action_btn_text_second_vi5" class="col-sm-4">Button 2</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="in_app_action_btn_text_second_vi5" id="in_app_action_btn_text_second_vi5" name="in_app_action_btn_text_second_vi5" value="<?= (getFieldVal('in_app_template_type', $details) == 5) ?getFieldVal('in_app_action_btn_text_second_vi', $details):''; ?>" placeholder="Ok">
                                                    </div>
                                                </div>
												
                                            </div>
											<!-- end -->	
											
											<!-- start -->	
											<div class="col-md-4" style="height: 330px; border-left: solid;">
											
											</div>
											<!-- end -->		
                                        </div>
                                    </div>
									<div class="col-md-1" style="height: fit-content;">
                                    </div>
                                    <div class="col-md-2" style="background-image: url(<?= base_url('assets/img/iphone-x.png'); ?>); background-repeat: no-repeat;height:330px;">
                                        <div class="row priview-container" style="margin-top: 75px;">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <div class="text-right" id="in_app_priview_close">
                                                    <span><i class="fa fa-times" title="Close"></i></span>
                                                </div>
                                   
                                                <b><div id="in_app_priview_title"><?= (getFieldVal('in_app_title', $details) != '') ? getFieldVal('in_app_title', $details) : 'Example title'; ?></div></b>
                                                <div id="in_app_priview_message"><?= (getFieldVal('in_app_message', $details) != '') ? getFieldVal('in_app_message', $details) : 'Example message'; ?></div>
                                                <figure id="inAppPriviewImg" style="<?= (getFieldVal('in_app_image_src', $details) != '') ?'':'display:none';?>">
                                                    <img id="in_app_priview_image" src="<?= (getFieldVal('in_app_image_src', $details) != '') ? base_url(getFieldVal('in_app_image_src', $details)) : base_url('assets/img/icon/not-available.jpg'); ?>" style="max-width: 70px;margin:5px;">
                                                </figure>
                                                <div id="in_app_priview_btn" style="margin-bottom: 5px; text-align: center;">
                                                    <button type="button" class="btn btn-success btn-xs in_app_priview_btn1 no-print" id="in_app_priview_btn1" style="font-size: 0.4rem; <?= (getFieldVal('in_app_action_btn_text_first', $details) != '') ?'':'display:none;';?>"><?= (getFieldVal('in_app_action_btn_text_first', $details) != '') ? getFieldVal('in_app_action_btn_text_first', $details) : 'Ok'; ?></button>
                                                    <button type="button" class="btn btn-danger btn-xs in_app_priview_btn2 no-print" id="in_app_priview_btn2" style="font-size: 0.4rem; <?= (getFieldVal('in_app_action_btn_text_second', $details) != '') ?'':'display:none;';?>" ><?= (getFieldVal('in_app_action_btn_text_second', $details) != '') ? getFieldVal('in_app_action_btn_text_second', $details) : 'Later'; ?></button>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end -->
								
								<div class="row">
									<!-- Customer Group -->
									<div class="col-md-6">
										<div class="form-group">
											<label for="customer_group" class="">Customer Group *</label>
											<select class="form-control select2 customer_group" id="select-id"  name="customer_group[]" required="required" multiple>
											<optgroup label="Select All">
												<?php 
														$customer_group=['1'=>'Pregnancy','2'=>'Non-Pregnancy','3'=>'Mom with first kid','4'=>'Mom with Kids+'];
														if($customer_group && count($customer_group)>0){
														$cgroup=isset($details->customer_group)?explode(',',$details->customer_group):array();
														foreach($customer_group as $key=>$value){
												?>
														<option value="<?=$key;?>" <?=(in_array($key,$cgroup))?"selected":"";?>><?=$value; ?></option>
												<?php $i++; }}?>
												</optgroup>
											</select>
											<span class="customer_group_error" style="display: none; color:red;">Please select customer group.</span>
											<!--<span class="error" style="display: none;">
												<i class="error-log fa fa-exclamation-triangle"></i>
											</span>-->
										</div>
									</div>
								<!-- End -->
								
                                <!-- Demographics -->
									<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="demographics" class="">Demographics </label>
                                            <select class="form-control select3 demographic" id="select2-id" name="demographics[]"  multiple>                                                                        
                                                <optgroup label="Select All">	
                                                    <?php
                                                    $demographics = array('Ages', 'Income', 'Relationship', 'Location', 'Gender', 'Delivery at HPH');
                                                    if ($demographics && count($demographics) > 0) {
                                                        $i = 1;
                                                        $dgraphic = isset($details->demographics) ? explode(',', $details->demographics) : array();
                                                        foreach ($demographics as $demographc) {
                                                            ?>
                                                            <option value="<?= $i; ?>" <?= (in_array($i, $dgraphic)) ? "selected" : ""; ?>><?= $demographc; ?></option>
                                                            <?php $i++;
                                                        }
                                                    } ?>									
                                                </optgroup>
                                            </select>
                                            <span class="demographics_error" style="display: none; color:red;">Please select demographic.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 age" style="<?= (isset($details->ages) && $details->ages) ? 'display:block' : 'display:none'; ?>">
                                        <div class="form-group">
                                            <label for="ages" class="">Ages </label>
                                            <select class="form-control select3 childdemo ages_select" name="ages[]" multiple>
                                                <?php
                                                $ages = array('Under 18 years old', '18-24 years old', '25-34 years old', '35-44 years old', 'Over 45 years old');
                                                if ($ages && count($ages) > 0) {
                                                    $i = 1;
                                                    $agearr = isset($details->ages) ? explode(',', $details->ages) : array();
                                                    foreach ($ages as $age) {
                                                        ?>
                                                        <option value="<?= $i; ?>" <?= (in_array($i, $agearr)) ? "selected" : ""; ?>><?= $age; ?></option>
                                                            <?php $i++;
                                                        }
                                                    } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 income" style="<?= (isset($details->income) && $details->income) ? 'display:block' : 'display:none'; ?>">
                                        <div class="form-group">
                                            <label for="income" class="">Income </label>
                                            <select class="form-control select2 childdemo income_select" name="income[]" multiple>
                                                <?php
                                                $incomes = array('< 10 mil/month', '10-15 mil/month', '16-20 mil/month', '21-30 mil/month', '31-40 mil/month', '41-50 mil/month', '> 50 mil/month');
                                                if ($incomes && count($incomes) > 0) {
                                                    $i = 1;
                                                    $incom = isset($details->income) ? explode(',', $details->income) : array();
                                                    foreach ($incomes as $income) {
                                                        ?>
                                                        <option value="<?= $i; ?>" <?= (in_array($i, $incom)) ? "selected" : ""; ?>><?= $income; ?></option>
                                                        <?php $i++;
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 relationship" style="<?= (isset($details->relationship) && $details->relationship) ? 'display:block' : 'display:none'; ?>">
                                        <div class="form-group">
                                            <label for="relationship" class="">Relationship </label>
                                            <select class="form-control select2 childdemo relationship_select" name="relationship[]" multiple>
                                            <?php
                                            $relationship = array('Single', 'Married', 'Divorced');
                                            if ($relationship && count($relationship) > 0) {
                                                $i = 1;
                                                $reltnship = isset($details->relationship) ? explode(',', $details->relationship) : array();
                                                foreach ($relationship as $rship) {
                                                    ?>
                                                    <option value="<?= $i; ?>" <?= (in_array($i, $reltnship)) ? "selected" : ""; ?>><?= $rship; ?></option>
                                                    <?php $i++;
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 city" style="<?= (isset($details->province) && $details->province) ? 'display:block' : 'display:none'; ?>">
                                        <div class="form-group">
                                            <label for="provnce" class="">Province </label>
                                            <select class="form-control select2 childdemo province_select" name="province[]" multiple>
                                            <?php
                                            if ($provinces && count($provinces) > 0) {
                                                $aprovince = isset($details->province) ? explode(',', $details->province) : array();
                                                foreach ($provinces as $province) {
                                                    ?>
                                                    <option value="<?= $province->ID; ?>" <?= (in_array($province->ID, $aprovince)) ? "selected" : ""; ?>><?= $province->name; ?></option>
                                            <?php }
                                                    } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 city" style="<?= (isset($details->city) && $details->city) ? 'display:block' : 'display:none'; ?>">
                                        <div class="form-group">
                                            <label for="city" class="">City </label>
                                            <div class="city_select_div">
                                                <select class="form-control select2 childdemo city_select" name="city[]" multiple>
                                                <?php
                                                if ($cities && count($cities) > 0) {
                                                    $awcity = isset($details->city) ? explode(',', $details->city) : array();
                                                    foreach ($cities as $city) {
                                                        if (in_array($city->ID, $awcity)) {
                                                            ?>
                                                                <option value="<?= $city->ID; ?>" <?= (in_array($city->ID, $awcity)) ? "selected" : ""; ?>><?= $city->name; ?></option>
                                                            <?php }
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 district" style="<?= (isset($details->district) && $details->district) ? 'display:block' : 'display:none'; ?>">
                                        <div class="form-group">
                                            <label for="district" class="">District </label>
                                            <div class="district_select">
                                                <select class="form-control select2 childdemo district_select" name="district[]" multiple>
                                                <?php
                                                if (isset($details->district)) {
                                                    if ($districts && count($districts) > 0) {
                                                        $awdistrict = isset($details->district) ? explode(',', $details->district) : array();
                                                        foreach ($districts as $district) {
                                                            if (in_array($district->ID, $awdistrict)) {
                                                                ?>
                                                            <option value="<?= $district->ID; ?>" <?= (in_array($district->ID, $awdistrict)) ? "selected" : ""; ?>><?= $district->name; ?></option>
                                                            <?php }
                                                        }
                                                    }
                                                } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 gender" style="<?= (isset($details->gender) && $details->gender) ? 'display:block' : 'display:none'; ?>">
                                        <div class="form-group">
                                            <label for="gender" class="">Gender </label>
                                            <select class="form-control select2 childdemo gender_select" name="gender[]" multiple>								
                                            <?php
                                            $genders = array('Male', 'Female', 'Other');
                                            if ($genders && count($genders) > 0) {
                                                $i = 1;
                                                $gendr = isset($details->gender) ? explode(',', $details->gender) : array();
                                                foreach ($genders as $gender) {
                                                    ?>
                                                    <option value="<?= $i; ?>" <?= (in_array($i, $gendr)) ? "selected" : ""; ?>><?= $gender; ?></option>
                                                    <?php $i++;
                                                }
                                            } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 deliveryathph" style="<?= (isset($details->deliveryathph) && $details->deliveryathph) ? 'display:block' : 'display:none'; ?>">
                                        <div class="form-group">
                                            <label for="deliveryathph" class="">Delivery at HPH </label>
                                            <select class="form-control select2 childdemo deliveryathph_select" name="deliveryathph">
                                                <option value="">Select</option>
                                                <option value="Yes" <?= (isset($details->deliveryathph) && $details->deliveryathph == 'Yes') ? "selected" : ""; ?>>Yes</option>
                                                <option value="No" <?= (isset($details->deliveryathph) && $details->deliveryathph == 'No') ? "selected" : ""; ?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- end-->

                                <div class="row btn-save-group" style="<?= (isset($details->action_status) && $details->action_status=='3')?'display:none':'';?>">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="box-footer text-center">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-Preview no-print preview" >Preview</a>
                                                <button type="submit" class="btn btn-success btn-save-draft no-print submit" name="btn_save_draft">Save as Draft</button>
                                                <button type="submit" class="btn btn-green btn-save no-print submit" name="btn_save">Send it now</button>
                                                <button type="button" class="btn btn-success btn-Schedule no-print">Schedule</button>
                                                <a href="<?= $main_page; ?>" class="btn btn-danger btn-Cancel no-print">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Scheduler-->
                                <div class="row Scheduler" style="<?= (isset($details->action_status) && $details->action_status=='3')?'':'display:none';?>">
                                    <div class="col-sm-12 widget-holder">
                                        <div class="widget-bg">
                                            <div class="widget-body clearfix">
                                                <div class="row scheduler-onetime">
													<div class="col-sm-12">
														<h5 class="box-title">
															<span>One Time</span>
															<input type="checkbox" class="scheduler-choice scheduler-choice-1"  id="scheduler-choice-1" name="schedule_single_time" value="1" <?= (isset($details->scheduler_type) && $details->scheduler_type=='1')?'checked':'';?>/>
														</h5>
													</div>
												</div>
												
												<div class="row scheduler-choice-1-div" style="<?= (isset($details->scheduler_type) && $details->scheduler_type=='1')?'':'display:none';?>">
													<div class="col-md-6">
														<div class="form-group">
															<label for="one_time_start_date" class="">Date *  </label>
															<input id="one_time_start_date" name="one_time_start_date" class="form-control one_time_start_date datepicker" required="required" type="text" 
																   value="<?= (isset($details->one_time_start_date) && $details->one_time_start_date!='0000-00-00') ? date('Y-m-d', strtotime($details->one_time_start_date)) : date('Y-m-d'); ?>" data-plugin-options='{"autoclose": true,"format": "yyyy-mm-dd","startDate":"<?= date('Y-m-d'); ?>"}' data-rule-required="true" data-msg-required="Please select Start Date.">
															<span class="error" style="display: none;">
																<i class="error-log fa fa-exclamation-triangle"></i>
															</span>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label for="one_time_start_time" class="">Time *  </label>
															<input type="text" class="form-control timepicker" id="one_time_start_time" name="one_time_start_time" value="<?= isset($details->one_time_start_time) ? date('H:i:s', strtotime($details->one_time_start_time)) : '01:00 AM'; ?>" aria-invalid="false">
															<span class="error" style="display: none;">
																<i class="error-log fa fa-exclamation-triangle"></i>
															</span>
														</div>
													</div>
												</div>
												
												<div class="rows scheduler-periodical">
													<div class="col-md-12">	
														<h5 class="box-title">
															<span>Periodical</span>
															<input type="checkbox" class="scheduler-choice scheduler-choice-2"  id="scheduler-choice-2" name="schedule_periodical_time" value="1" <?= (isset($details->scheduler_type) && $details->scheduler_type=='2')?'checked':'';?>/>
														</h5>
													</div>	
												</div>
												
                                                <div class="tabs tabs-bordered scheduler-choice-2-div" style="<?= (isset($details->scheduler_type) && $details->scheduler_type=='2')?'':'display:none';?>">
                                                    <input type="hidden" class="periodical_type" id="periodical_type" name="periodical_type" value="<?= isset($details->periodical_type) ? $details->periodical_type : '1'; ?>">
													<input type="hidden" id="weekly_day" name="weekly_day" value="<?= isset($details->weekly_day) ? $details->weekly_day: '' ?>">
                                                    <input type="hidden" id="monthly_day" name="monthly_day" value="<?= isset($details->monthly_day) ? $details->monthly_day: '' ?>">
															
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item <?= (isset($details->periodical_type) && $details->periodical_type=='1')?'active':((!isset($details->periodical_type) || (isset($details->periodical_type) && $details->periodical_type=='0'))?'active':'');?>">
															<a class="nav-link periodical-link" id="periodical-daily" href="#daily-tab-bordered-1" data-toggle="tab" aria-expanded="true">Daily</a>
                                                        </li>
                                                        <li class="nav-item <?= (isset($details->periodical_type) && $details->periodical_type=='2')?'active':'';?>">
															<a class="nav-link periodical-link" id="periodical-weekly" href="#weekly-tab-bordered-1" data-toggle="tab" aria-expanded="true">Weekly</a>
                                                        </li>
                                                        <li class="nav-item <?= (isset($details->periodical_type) && $details->periodical_type=='3')?'active':'';?> ">
															<a class="nav-link periodical-link" id="periodical-monthly" href="#monthly-tab-bordered-1" data-toggle="tab" aria-expanded="true">Monthly</a>
                                                        </li>

                                                    </ul>
                                                    <!-- /.nav-tabs -->
                                                    <div class="tab-content">
                                                        <div class="tab-pane <?= (isset($details->periodical_type) && $details->periodical_type=='1')?'active':((!isset($details->periodical_type) || (isset($details->periodical_type) && $details->periodical_type=='0'))?'active':'');?>" id="daily-tab-bordered-1">

                                                        </div>
                                                        <div class="tab-pane <?= (isset($details->periodical_type) && $details->periodical_type=='2')?'active':'';?>" id="weekly-tab-bordered-1">
                                                            <div class="btn-group">
                                                            <?php
                                                            $currentWeekNumber = date('w');
                                                            $weeks = ['1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thuresday', '5' => 'Friday', '6' => 'Saturday', '0' => 'Sunday'];
                                                            foreach ($weeks as $key => $value) {
                                                                ?>
                                                                <button type="button" class="btn btn-outline-default btn-sm btn-weekly <?= (isset($details->weekly_day) && $details->weekly_day !='' && $details->weekly_day == $key) ? 'btn-primary' : ((isset($details->weekly_day)   && $details->weekly_day =='' && $currentWeekNumber == $key) ? 'btn-primary':
((!isset($details->weekly_day) && $currentWeekNumber == $key) ? 'btn-primary' : '')); ?>" id="<?= $key; ?>" ><?= $value; ?></button>
                                                            <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane <?= (isset($details->periodical_type) && $details->periodical_type=='3')?'active':'';?>" id="monthly-tab-bordered-1">
                                                            <div class="btn-group">
                                                            <?php
                                                            $maxDays = date('t');
                                                            $currentDayOfMonth = date('j');
                                                            for ($i = 1; $i <= $maxDays; $i++) {
                                                                if ($i == 18) {
                                                                    echo "<br/><br/>";
                                                                }
                                                                ?>
                                                                <button type="button" class="btn btn-outline-default btn-sm btn-monthly <?= (isset($details->monthly_day) && $details->monthly_day == $i) ? 'btn-primary' : ((isset($details->monthly_day) && $details->monthly_day=='' && $i == $currentDayOfMonth) ? 'btn-primary' :((!isset($details->monthly_day) && $i == $currentDayOfMonth) ? 'btn-primary':'')); ?>" id="<?= $i; ?>"><?= $i; ?></button>
                                                            <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div>
                                                <!-- /.tabs -->

                                                <div class="col-sm-3 scheduler-choice-2-div" style="<?= (isset($details->scheduler_type) && $details->scheduler_type=='2')?'':'display:none';?>">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control timepicker" id="periodical_start_time" name="periodical_start_time" value="<?= isset($details->periodical_start_time) ? date('H:i:s', strtotime($details->periodical_start_time)) : '01:00 AM'; ?>" aria-invalid="false">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="box-footer text-center">
															<a href="javascript:void(0)" class="btn btn-primary no-print preview" >Preview</a>
															<button type="submit" class="btn btn-success btn-Schedule-save submit" name="btn_schedule_save">Save</button>
                                                            <button type="button" class="btn btn-danger btn-Schedule-cancel">Cancel</button>
                                                        </div>
                                                    </div>	
                                                </div>										
                                            </div>
                                            <!-- /.widget-body -->
                                        </div>
                                        <!-- /.widget-bg -->
                                    </div>
                                </div>
                                <!-- end -->



                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
<script>

    $(document).ready(function () {
       $( ".datepicker" ).datepicker({
		//dateFormat: 'yy-mm-dd',
		//autoclose: true,
		}).on('changeDate', function (ev) {
			if($('.scheduler').css('display')!= "none"){
				var start_date= $("#start_date").val();
				var end_date= $("#end_date").val();
				var dateDiff=date_diff(start_date,end_date);
				
				if(dateDiff < 0 ){
					$("#end_date").datepicker('setDate',start_date); 
				}	
				
				if(dateDiff < 1 ){ 
					$('.scheduler-choice-2').prop('checked', false);
					$('.scheduler-choice-1').prop('checked', true);
					$('.scheduler-periodical').hide();
					$('.scheduler-choice-2-div').hide();
					$('.scheduler-choice-1-div').show();
				} else{
					$('.scheduler-periodical').show();
				}
			}
		});	
    });

// for demographic select box

// end

    $(document).on('click', '.language', function () {
        if ($(this).attr('tabval') == 1) {
            $('.en').hide();
            $('.vi').show();
            //$('.app_discriptiion').html($('.description_vi').val());
        } else {
            $('.en').show();
            $('.vi').hide();
            //$('.app_discriptiion').html($('.description_en').val());
        }
    });
    
    $(document).on('change', '.lockscreen_action_first', function () {
        if ($(this).val() == '2') {
            $('#lockscreen_action_first').hide();
			$('#lockscreenActionFirstURL').show();
		}
    });
    
	$(document).on('click', '#closeLockscreenActionURL', function () {
		$('#lockscreenActionFirstURL').hide();
		$('#lockscreen_action_first').show();
		$('#lockscreen_action_first_url, #lockscreen_action_first').val('');
    });
	
    $(document).on('change', '.in_app_action', function () {
        if ($(this).val() == '2') {
            $('#' + $(this).attr('id') + '_url').show();
        } else {
            $('#' + $(this).attr('id') + '_url').hide();
        }
    });

    $(document).on('click', '.lockscreenNotificationTemplate', function () {
        if ($(this).prop('checked') == true) {
            $('.lockscreenNotificationRow').show();
        } else {
            $('.lockscreenNotificationRow').hide();
            //$('.lockscreenNotificationRow :input').val('');
        }
    });

    $(document).on('click', '.inAppNotificationTemplate', function () {
        if ($(this).prop('checked') == true) {
            $('.inAppNotificationRow').show();
        } else {
            $('.inAppNotificationRow').hide();
            //$('.inAppNotificationRow :input').val('');
            $('.inAppNotification').prop('checked', false);
        }
    });

    $('.inAppNotification').on('click', function () {
        $('.inAppNotification').not(this).prop('checked', false);
        //$('.inAppNotificationRow :input').not(this).val('');
    });
    
    $(document).on('change', '.in_app_action_btn_first3', function () {
        if ($(this).val() == '2') {
			$('.in_app_action_btn_first3').hide();
            $('#inAppActionFirstUrl3').show();
        }
    });
    
	$(document).on('click', '#closeInAppActionFirstUrl3', function () {
		$('#inAppActionFirstUrl3').hide();
		$('.in_app_action_btn_first3').show();
		$('#in_app_action_btn_url_first3, .in_app_action_btn_first3').val('');
    });
	
    $(document).on('change', '.in_app_action_btn_first4', function () {
        if ($(this).val() == '2') {
			$('.in_app_action_btn_first4').hide();
            $('#inAppActionFirstUrl4').show();
        }
    });
    
	$(document).on('change', '.in_app_action_btn_second3', function () {
        if ($(this).val() == '2') {
			$('.in_app_action_btn_second3').hide();
            $('#inAppActionSecondUrl3').show();
        }
    });
    
	$(document).on('click', '#closeInAppActionSecondUrl3', function () {
		$('#inAppActionSecondUrl3').hide();
		$('.in_app_action_btn_second3').show();
		$('#in_app_action_btn_url_second3, .in_app_action_btn_second3').val('');
    });
	
	$(document).on('click', '#closeInAppActionFirstUrl4', function () {
		$('#inAppActionFirstUrl4').hide();
		$('.in_app_action_btn_first4').show();
		$('#in_app_action_btn_url_first4, .in_app_action_btn_first4').val('');
    });
	
	$(document).on('change', '.in_app_action_btn_second4', function () {
        if ($(this).val() == '2') {
			$('.in_app_action_btn_second4').hide();
            $('#inAppActionSecondUrl4').show();
        }
    });
    
	$(document).on('click', '#closeInAppActionSecondUrl4', function () {
		$('#inAppActionSecondUrl4').hide();
		$('.in_app_action_btn_second4').show();
		$('#in_app_action_btn_url_second4, .in_app_action_btn_second4').val('');
    });
	
	$(document).on('click', '.preview', function () {
       setLockScreenPreview();
       setInAppNotificationPreview();
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });
    
    function setLockScreenPreview(){
        if ($('.en').css('display') === "flex" || $('.en').css('display') === "block") { 
            $('#lockscreen_priview_title').html($('.lockscreen_title').val()); 
            $('#lockscreen_priview_message').html($('.lockscreen_message').val());
        } else {
            $('#lockscreen_priview_title').html($('.lockscreen_title_vi').val());
            $('#lockscreen_priview_message').html($('.lockscreen_message_vi').val());
        }
        
        var lockscreen_image = $('.lockscreen_image_src').get(0);
        if(lockscreen_image.files[0]){
            var lockScreenImgTempPath = URL.createObjectURL(lockscreen_image.files[0]); 
            if(lockScreenImgTempPath){
                $('#lockscreen_priview_image').attr('src',lockScreenImgTempPath);
            }
        }
    }
     
    function setInAppNotificationPreview(){
        var title,message,btn1,btn2='';
        $('#inAppPriviewImg').hide();
        $('#in_app_priview_image').attr('src','');
        $('#in_app_priview_btn1').hide().text('Ok');
        $('#in_app_priview_btn2').hide().text('Later');
        
        if($('.inAppTextNotification').prop('checked') == true) {
            if ($('.en').css('display') === "flex" || $('.en').css('display') === "block") { 
                title=$('.in_app_title1').val(); 
                message=$('.in_app_message1').val();
            } else {
                title=$('.in_app_title_vi1').val();
                message=$('.in_app_message_vi1').val();
            }
        } else if($('.inAppTextPictureNotification').prop('checked') == true) {
            if ($('.en').css('display') === "flex" || $('.en').css('display') === "block") { 
                title=$('.in_app_title2').val(); 
                message=$('.in_app_message2').val();
            } else {
                title=$('.in_app_title_vi2').val();
                message=$('.in_app_message_vi2').val();
            }
            
            var img = $('.in_app_image_src2').get(0); 
            if(img.files[0]){
                var imgTempPath = URL.createObjectURL(img.files[0]); 
                if(imgTempPath){
                    $('#inAppPriviewImg').show();
                    $('#in_app_priview_image').attr('src',imgTempPath);
                }
            }
             
        } else if($('.inAppTextPictureOptionNotification').prop('checked') == true) {
            if ($('.en').css('display') === "flex" || $('.en').css('display') === "block") { 
                title=$('.in_app_title3').val(); 
                message=$('.in_app_message3').val();
				btn1=$('#in_app_action_btn_text_first3').val();
				btn2=$('#in_app_action_btn_text_second3').val();
            } else {
                title=$('.in_app_title_vi3').val();
                message=$('.in_app_message_vi3').val();
				btn1=$('#in_app_action_btn_text_first_vi3').val();
				btn2=$('#in_app_action_btn_text_second_vi3').val();
            }
            
            var img = $('.in_app_image_src3').get(0);
            if(img.files[0]){
                var imgTempPath = URL.createObjectURL(img.files[0]); 
                if(imgTempPath){
                    $('#inAppPriviewImg').show();
                    $('#in_app_priview_image').attr('src',imgTempPath);
                }
            }
            
			$('#in_app_priview_btn1').show().text(btn1);
            $('#in_app_priview_btn2').show().text(btn2);
        } else if($('.inAppTextOptionNotification').prop('checked') == true) {
            if ($('.en').css('display') === "flex" || $('.en').css('display') === "block") { 
                title=$('.in_app_title4').val(); 
                message=$('.in_app_message4').val();
				btn1=$('#in_app_action_btn_text_first4').val();
				btn2=$('#in_app_action_btn_text_second4').val();
            } else {
                title=$('.in_app_title_vi4').val();
                message=$('.in_app_message_vi4').val();
				btn1=$('#in_app_action_btn_text_first_vi4').val();
				btn2=$('#in_app_action_btn_text_second_vi4').val();
            }
            
            $('#in_app_priview_btn1').show().text(btn1);
            $('#in_app_priview_btn2').show().text(btn2);
            
        } else if($('.inAppTextAlertNotification').prop('checked') == true) {
            if ($('.en').css('display') === "flex" || $('.en').css('display') === "block") { 
                title=$('.in_app_title5').val(); 
                message=$('.in_app_message5').val();
				btn2=$('#in_app_action_btn_text_second5').val();
            } else {
                title=$('.in_app_title_vi5').val();
                message=$('.in_app_message_vi5').val();
				btn2=$('#in_app_action_btn_text_second_vi5').val();
            }
           
            $('#in_app_priview_btn2').show().text(btn2);
        }
        
        
        $('#in_app_priview_title').html(title);
        $('#in_app_priview_message').html(message);
    }   
    
	$(document).on('click', '.btn-Schedule', function () {
        $('.btn-save-group').hide();
        $('.Scheduler').show();
		
		$('.scheduler-choice-1').prop('checked', true);
		$('.scheduler-choice-1-div').show();
		
		var start_date= $("#start_date").val();
		var end_date= $("#end_date").val();
		var dateDiff=date_diff(start_date,end_date);
		
		if(dateDiff < 1 ){
			$('.scheduler-choice-2').prop('checked', false);
			$('.scheduler-choice-1').prop('checked', true);
			$('.scheduler-periodical').hide();
			$('.scheduler-choice-2-div').hide();
			$('.scheduler-choice-1-div').show();
		} else{	
			$('.scheduler-periodical').show();
		}
		
    });

	//difference in days between two dates
	function date_diff(start_date,end_date){
		if(start_date!='' && end_date!=''){
			// end - start returns difference in milliseconds 
			var diff = new Date(end_date) - new Date(start_date);
			
			// get days
			var days = diff/1000/60/60/24;
			return Math.round(days);
		}
	}
	//end
	
    $('.scheduler-choice').on('click', function () {
        $('.scheduler-choice').not(this).prop('checked', false);
    });

    $('.scheduler-choice-1').on('click', function () {
        if ($(this).prop('checked') == true) {
            $('.scheduler-choice-1-div').show();
            $('.scheduler-choice-2-div').hide();
        } else {
            $('.scheduler-choice-1').prop('checked', true);
        }
    });

    $('.scheduler-choice-2').on('click', function () {
        if ($(this).prop('checked') == true) {
            $('.scheduler-choice-2-div').show();
            $('.scheduler-choice-1-div').hide();
        } else {
            $('.scheduler-choice-2').prop('checked', true);
        }
    });
	
    $(document).on('click', '.btn-Schedule-cancel', function () {
        $('.Scheduler').hide();
       
		$('.scheduler-choice-1').prop('checked', false);
		$('.scheduler-choice-2').prop('checked', false);
		
		$('.btn-save-group').show();
    });

    $(document).on('click', '.btn-weekly', function () {
        $('.btn-weekly').removeClass('btn-primary');
        $('.btn-weekly').addClass('btn-outline-default');
        $(this).removeClass('btn-outline-default');
        $(this).addClass('btn-primary');
		
		var ID=$(this).attr('id');
		$('#weekly_day').val(ID);
	});

    $(document).on('click', '.btn-monthly', function () {
        $('.btn-monthly').removeClass('btn-primary');
        $('.btn-monthly').addClass('btn-outline-default');
        $(this).removeClass('btn-outline-default');
        $(this).addClass('btn-primary');
		
		var ID=$(this).attr('id');
		$('#monthly_day').val(ID);
	});
	
	$(document).on('click', '.periodical-link', function () {
		var d = new Date();
		var ID=$(this).attr('id');
		if(ID == 'periodical-daily'){ 
			$('#periodical_type').val('1');
			$('#weekly_day').val('');
			$('#monthly_day').val('');
		} else if(ID == 'periodical-weekly'){
			$('#periodical_type').val('2');
			$('#weekly_day').val(d.getDay());
			$('#monthly_day').val('');
		}else if(ID == 'periodical-monthly'){
			$('#periodical_type').val('3');
			$('#weekly_day').val('');
			$('#monthly_day').val(d.getDate());
		}
    });
	
</script>

<!-- Copy from Awareness for demographic-->
<script>
$(document).on('click','.submit',function(){
	$('.show_status').val('0');
	if(validationForm()){
		$('.submit_click').trigger('click');
	}
	setTimeout(function(){$('.select2.select2-container.select2-container--default').css('display','block');},500);
});

function validationForm(){
    if($('.customer_group').val()==''){
    $('.customer_group_error').show();
    $('.customer_group').focus();
    }else{
        $('.customer_group_error').hide();
    }

	if($('#name').val()==''){
		$('.name_error').show();
		$('#name').focus();
    }else{
        $('.name_error').hide();
    }
    
	if($('#name').val()=='' || $('.customer_group').val()==''){
		return false;
    }else{
        return true;
    }
}

    function RunSelect2() {
        $('#select-id').select2({
            placeholder: "Select",
            allowClear: true,
            closeOnSelect: false
        }).on('select2:open', function () {
            setTimeout(function () {
                $(".select2-results__option .select2-results__group").bind("click", selectAlllickHandler);
            }, 0);
        });
    }
    RunSelect2();
    var selectAlllickHandler = function () {
        $(".select2-results__option .select2-results__group").unbind("click", selectAlllickHandler);
        $('#select-id').select2('destroy').find('option').prop('selected', 'selected').end();
        RunSelect2();
    };

    function RunSelect3() {
        $('#select2-id').select2({
            placeholder: "Select",
            allowClear: true,
            closeOnSelect: false,
        }).on('select2:open', function () {
            setTimeout(function () {
                $(".select2-results__option .select2-results__group").bind("click", selectAlllickHandler2);
            }, 0);
        });
        $('.demographic').trigger('change');
    }
    RunSelect3();
    var selectAlllickHandler2 = function () {
        $(".select2-results__option .select2-results__group").unbind("click", selectAlllickHandler2);
        $('#select2-id').select2('destroy').find('option').prop('selected', 'selected').end();
        RunSelect3();
    };

    $(document).on('change', '.province_select', function () {
        var province_id = '';
        province_id = $(this).val().toString();
        //province_id=JSON.stringify(province_id)
        var city_html = '<select class="form-control select2 childdemo city_select" name="city[]" multiple>';
        var district_html = '<select class="form-control select2 childdemo" name="district[]" multiple>';
        $.post(BASE_URL + 'awareness/getCity_byProvinceId', {province_id: province_id}, function (data) {
            if (data) {
                var dt = JSON.parse(data);
                for (let i = 0; i < dt.cities.length; i++) {
                    city_html += '<option value="' + dt.cities[i].ID + '">' + dt.cities[i].name + '</option>';
                }
                city_html += '</select>';
                $('.city_select_div').html('');
                $('.city_select_div').html(city_html);
            } else {
                city_html += '</select>';
                $('.city_select_div').html('');
                $('.city_select_div').html(city_html);
            }
            district_html += '</select>';
            $('.district_select').html('');
            $('.district_select').html(district_html);
            $(".select2").select2();
        });
    });

    $(document).on('change', '.city_select', function () {
        var city_id = $(this).val().toString();
        var district_html = '<select class="form-control select2 childdemo" name="district[]" multiple>';
        $.post(BASE_URL + 'awareness/getDistrict_byCityId', {city_id: city_id}, function (data) {
            if (data) {
                var dt = JSON.parse(data);
                for (let i = 0; i < dt.districts.length; i++) {
                    district_html += '<option value="' + dt.districts[i].ID + '">' + dt.districts[i].name + '</option>';
                }
                district_html += '</select>';
                $('.district_select').html('');
                $('.district_select').html(district_html);
            } else {
                district_html += '</select>';
                $('.district_select').html('');
                $('.district_select').html(district_html);
            }
            $(".select2").select2();
        });
    });


    $(document).on('change', '.demographic', function () {
        var arrId = [];
        arrId = $(this).val();
        if ($.inArray('1', arrId) > -1) {
            $('.age').css('display', 'block');
        } else {
            $('.age').css('display', 'none');
            $(".ages_select option").prop("selected", false);
        }
        if ($.inArray('2', arrId) > -1) {
            $('.income').css('display', 'block');
        } else {
            $('.income').css('display', 'none');
            $(".income_select option").prop("selected", false);
        }
        if ($.inArray('3', arrId) > -1) {
            $('.relationship').css('display', 'block');
        } else {
            $('.relationship').css('display', 'none');
            $(".relationship_select option").prop("selected", false);
        }
        if ($.inArray('4', arrId) > -1) {
            //$('.location').css('display','block');
            $('.city').css('display', 'block');
            $('.district').css('display', 'block');
        } else {
            //$('.location').css('display','none');
            $('.city').css('display', 'none');
            $('.district').css('display', 'none');
            $(".city_select option").prop("selected", false);
            $(".district_select option").prop("selected", false);
        }
        if ($.inArray('5', arrId) > -1) {
            $('.gender').css('display', 'block');
        } else {
            $('.gender').css('display', 'none');
            $(".gender_select option").prop("selected", false);
        }
        if ($.inArray('6', arrId) > -1) {
            $('.deliveryathph').css('display', 'block');
        } else {
            $('.deliveryathph').css('display', 'none');
            $(".deliveryathph_select option").prop("selected", false);
        }
    });

    $(document).on('click', '.publish', function () {
        $('.show_status').val('1');
        if (validationForm()) {
            $('.publish_click').trigger('click');
        }
    });

//New 12-02-20
    $(document).on('click', '.submit', function () {
        $('.show_status').val('0');
        if (validationForm()) {
            $('.submit_click').trigger('click');
        }
        setTimeout(function () {
            $('.select2.select2-container.select2-container--default').css('display', 'block');
        }, 500);
    });

    function validationForm() {
        if ($('.customer_group').val() == '') {
            $('.customer_group_error').show();
            $('.customer_group').focus();
        } else {
            $('.customer_group_error').hide();
        }

        if ($('#name').val() == '') {
            $('.name_error').show();
            $('#name').focus();
        } else {
            $('.name_error').hide();
        }

        if ($('#name').val() == '' || $('.customer_group').val() == '') {
            return false;
        } else {
            return true;
        }
    }

    /*$(document).on('change', '.demographic', function () {
        if ($('.demographic').val() == '') {
            $('.demographics_error').show();
            $('.demographic').focus();
        } else {
            $('.demographics_error').hide();
        }
    });
	*/
    $(document).on('change', '.customer_group', function () {
        if ($('.customer_group').val() == '') {
            $('.customer_group_error').show();
            $('.customer_group').focus();
        } else {
            $('.customer_group_error').hide();
        }
    });

    $(function () {
        $('#end_date').datepicker({
            startDate: '-0d',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#start_date').datepicker({
            startDate: '-0d',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

    });

    $(document).ready(function () {
        $(".category").select2();
        $(".childdemo").select2();
        $(".demographic").select2();
    });

</script>

<!-- end -->