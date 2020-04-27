<!--Start header-->
<?=$header;?>
<!--End header-->
<?php $ID= (isset($details->ID))?$details->ID:""; ?>
<style>.dose_name_vi_b{display:none;}</style>
<main class="main-wrapper clearfix">
	<span class="action-message"><?= getFlashMsg('success_message'); ?></span>
	<div class="row page-title clearfix">
		<div class="page-title-left">
			<h6 class="page-title-heading mr-0 mr-r-5"><?= $mode.' '.$heading; ?></h6>
			<p class="page-title-description mr-0 d-none d-md-inline-block"><!-- discription about page--></p>
		</div>
		<div class="page-title-right d-none d-sm-inline-flex">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= $main_page;?>">User</a>
			</li>
			<li class="breadcrumb-item active"><?= $mode.' '.$heading; ?></li>
			</ol>
		</div>
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
        
	<form class="MyForm" accept-charset="UTF-8" novalidate="" method="post">
	<div class="widget-list">
	<div class="row">
	<div class="<?= ($ID!='')?'col-md-10':'col-md-10'?> widget-holder">
	<div class="widget-bg">
	<div class="widget-body clearfix">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group vaccine_name_b">
                                        <?php if($ID!=''){ ?>
                                        <input type="hidden" name="ID" value="<?=$ID; ?>">
                                        <?php } ?>
					<label for="vaccine_name" class="">Vaccine Name *</label>
					<input type="text" class="form-control" id="vaccine_name" name="vaccine_name" value="<?= getFieldVal('vaccine_name',$details);?>" data-rule-required="true" data-msg-required="Please include vaccine name  ">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
				<div class="form-group vaccine_name_vi_b" style="display:none;">
					<label for="vaccine_name" class="">TÊN VACCINE</label>
					<input type="text" class="form-control" id="vaccine_name_vi" name="vaccine_name_vi" value="<?= getFieldVal('vaccine_name_vi',$details);?>">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
                    <div class="col-md-6">
				<div class="form-group">
					<label for="vaccine_code" class="vaccine_code_b">Vaccine Code *</label>
					<input type="text" class="form-control" id="vaccine_code" name="vaccine_code" value="<?= getFieldVal('vaccine_code',$details);?>" data-rule-required="true" data-msg-required="Please include vaccine code.">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
                    </div>
                </div>
		<div class="row ">
			<div class="col-md-6 vaccine_short_name_b">
				<div class="form-group">
					<label for="vaccine_short_name" class="">Vaccine Short Name *</label>
					<input type="text" class="form-control" id="vaccine_short_name" name="vaccine_short_name" value="<?= getFieldVal('vaccine_short_name',$details);?>" data-rule-required="true" data-msg-required="Please include vaccine short name  ">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			<div class="col-md-6 vaccine_short_name_vi_b" style="display:none;">
				<div class="form-group">
					<label for="vaccine_short_name_vi" class="">TÊN VIẾT TẮT</label>
					<input type="text" class="form-control" id="vaccine_short_name_vi" name="vaccine_short_name_vi" value="<?= getFieldVal('vaccine_short_name_vi',$details);?>">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
                        <div class="col-md-6">
				<div class="form-group">
                                <label for="vaccine_package_code" class="vaccine_package_code">Vaccine Package Code</label>
				<select class="form-control" id="vaccine_package_code" name="vaccine_package_code">
					<option value="">Select</option>
					<?php if(!empty($vaccine_package_code)){ foreach ($vaccine_package_code as $vacrow){ ?>
                                        <option value="<?php echo $vacrow->code ;?>" <?php echo (getFieldVal('vaccine_package_code',$details)==$vacrow->code)?"selected":"";?>><?php echo $vacrow->code ?></option>
                                        <?php } } ?>
				</select>
                                </div>
			</div>
                    </div>
		<div class="row vaccine_short_name_vi_b" style="display:none;">
			<div class="col-md-12">
				<div class="form-group">
					<label for="vaccine_short_name_vi" class="">TÊN VIẾT TẮT</label>
					<input type="text" class="form-control" id="vaccine_short_name_vi" name="vaccine_short_name_vi" value="<?= getFieldVal('vaccine_short_name_vi',$details);?>">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
                </div>
		<div class="row ">
			<div class="col-md-12 disease_name_b">
				<div class="form-group">
					<label for="disease_name" class="">Disease Name *</label>
					<input type="text" class="form-control" id="disease_name" name="disease_name" value="<?= getFieldVal('disease_name',$details);?>" data-rule-required="true" data-msg-required="Please include disease name  ">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			<div class="col-md-12 disease_name_vi_b" style="display:none;">
				<div class="form-group">
					<label for="disease_name_vi" class="">PHÒNG BỆNH</label>
					<input type="text" class="form-control" id="disease_name_vi" name="disease_name_vi" value="<?= getFieldVal('disease_name_vi',$details);?>">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
                </div>
		<div class="row ">
			<div class="col-md-6 origin_b">
				<div class="form-group">
					<label for="origin" class="">Origin *</label>
					<input type="text" class="form-control" id="vaccine_origin" name="vaccine_origin" value="<?= getFieldVal('vaccine_origin',$details);?>" data-rule-required="true" data-msg-required="Please include vaccine origin.">
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
			<div class="col-md-6 origin_vi_b" style="display:none;">
				<div class="form-group">
					<label for="vaccine_origin_vi" class="">XUẤT XỨ</label>
					<input type="text" class="form-control" id="vaccine_origin_vi" name="vaccine_origin_vi" value="<?= getFieldVal('vaccine_origin_vi',$details);?>" >
					<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
					</span>
				</div>
			</div>
                    
			<div class="col-md-6">
				<div class="form-group">
                                <label for="available_status" class="available_status_b">Status  *</label>
				<select class="form-control" id="available_status" name="available_status" required="required" data-rule-required="true" data-msg-required="Please select available status.">
					<option value="">Select</option>
					<option value="1" <?php echo (getFieldVal('available_status',$details)=='1')?"selected":"";?>>Available</option>
					<option value="2" <?php echo (getFieldVal('available_status',$details)=='2')?"selected":"";?>>Unavailable</option>
				</select>
				<span class="error" style="display: none;">
					<i class="error-log fa fa-exclamation-triangle"></i>
				</span>
                                </div>
			</div>
                </div>
            
            <div class="row">
                <label for="dose_name" class="dose_note" style="color: #8cc63f;">NOTE: </label>&nbsp; 
                <small class="dose_note" style="color: #8cc63f;">Dose duration 'FROM MONTH' and 'TO MONTH' must be in month(s) only, not in year(s).</small>
                
                <label for="dose_note_vi" class="dose_note_vi" style="color: #8cc63f;display:none;">Lưu ý: </label>&nbsp; 
                <small class="dose_note_vi" style="color: #8cc63f;display:none;">Khoảng cách giữa các liều là TỪ THÁNG TUỔI- ĐẾN THÁNG TUỔI.</small>
                <table class="table table-striped table-responsive">
			<thead>
				<tr>
					<th class="dose_name_h_b">Dose Name</th>
					<th class="dose_gender_b">Gender</th>
					<th class="dose_frommonth_b">From Month</th>
					<th class="dose_tomonth_b">To Month</th>
				</tr>
			</thead>
                        <tbody class="add_dose">
                            <?php  if(isset($dose) && !empty($dose)){ $i=0; foreach($dose as $row){ if($i>0) {?>
				<tr>
                                        <td>
                                            <input type="hidden" name="dose_id[]" value="<?=$row->ID; ?>">
                                            <input type="text" maxlength="20" class="form-control dose_name_b" name="dose_name[]"   value="<?php echo isset($row->dose_name)?$row->dose_name:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include dose name ">
                                            <input type="text" maxlength="20" class="form-control dose_name_vi_b" name="dose_name_vi[]" value="<?php echo isset($row->dose_name_vi)?$row->dose_name_vi:''; ?>">
                                        </td>
                                        <td>
                                            <select class="form-control" id="gender" name="gender[]" required="required" data-rule-required="true" data-msg-required="Please select patient gender.">
                                                    <option value="">Select</option>
                                                    <option value="1" <?= ($row->gender=='1')?"selected":"";?>>Male</option>
                                                    <option value="2" <?= ($row->gender=='2')?"selected":"";?>>Female</option>
                                                    <option value="3" <?= ($row->gender=='3')?"selected":"";?>>Both</option>
                                            </select>
                                        </td>
                                        <td><input type="text" maxlength="5" onkeypress="return isNumberKey(event);" class="form-control" name="from_month[]"  value="<?php echo isset($row->from_month)?$row->from_month:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include from month"></td>
					<td><input type="text" maxlength="5" onkeypress="return isNumberKey(event);" class="form-control" name="to_month[]"  value="<?php echo isset($row->to_month)?$row->to_month:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include to month"></td>
                                        
                                </tr>
                            <?php }else{ ?>
				<tr>
                                        <td><input type="hidden" name="dose_id[]" value="<?=$row->ID; ?>">
                                        <input type="text" maxlength="20" class="form-control dose_name_b" name="dose_name[]"   value="<?php echo isset($row->dose_name)?$row->dose_name:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include dose name ">
                                        <input type="text" maxlength="20" class="form-control dose_name_vi_b" name="dose_name_vi[]"   value="<?php echo isset($row->dose_name_vi)?$row->dose_name_vi:''; ?>">
                                        </td>
                                        <td>
                                            <select class="form-control" id="gender" name="gender[]" required="required" data-rule-required="true" data-msg-required="Please select patient gender.">
                                                    <option value="">Select</option>
                                                    <option value="1" <?= ($row->gender=='1')?"selected":"";?>>Male</option>
                                                    <option value="2" <?= ($row->gender=='2')?"selected":"";?>>Female</option>
                                                    <option value="3" <?= ($row->gender=='3')?"selected":"";?>>Both</option>
                                            </select>
                                        </td>
                                        <td><input type="text" maxlength="5" onkeypress="return isNumberKey(event);" class="form-control" name="from_month[]"  value="<?php echo isset($row->from_month)?$row->from_month:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include from month"></td>
					<td><input type="text" maxlength="5" onkeypress="return isNumberKey(event);" class="form-control" name="to_month[]"  value="<?php echo isset($row->to_month)?$row->to_month:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include to month"></td>
                                        
                                </tr>
                                <?php } $i++; } } ?> 
                                    <?php if(!isset($dose)){ //add condition ?>
                                <tr>
                                        <td>
                                        <input type="text" maxlength="20" class="form-control dose_name_b" name="dose_name[]"   value="<?php echo isset($row->dose_name)?$row->dose_name:''; ?>" required="required" data-rule-required="true" data-msg-required="Please include dose name ">
                                        <input type="text" maxlength="20" class="form-control dose_name_vi_b" name="dose_name_vi[]"   value="<?php echo isset($row->dose_name_vi)?$row->dose_name_vi:''; ?>">
                                        </td>
                                        <td>
                                            <select class="form-control" id="gender" name="gender[]" required="required" data-rule-required="true" data-msg-required="Please select patient gender.">
                                                    <option value="">Select</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Both</option>
                                            </select>
                                        </td>
                                        <td><input type="text" maxlength="5" onkeypress="return isNumberKey(event);" class="form-control" name="from_month[]" required="required" data-rule-required="true" data-msg-required="Please include from month"></td>
					<td><input type="text" maxlength="5" onkeypress="return isNumberKey(event);" class="form-control" name="to_month[]" required="required" data-rule-required="true" data-msg-required="Please include to month"></td>
                                        
                                </tr>
                            <?php } ?> 
                                <?php if(empty($dose)){  ?>
                                <tr>
                                        <td>
                                        <input type="text" maxlength="20" class="form-control dose_name_b" name="dose_name[]"  required="required" data-rule-required="true" data-msg-required="Please include dose name ">
                                        <input type="text" maxlength="20" class="form-control dose_name_vi_b" name="dose_name_vi[]">
                                        </td>
                                        <td>
                                            <select class="form-control" id="gender" name="gender[]" required="required" data-rule-required="true" data-msg-required="Please select patient gender.">
                                                    <option value="">Select</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Both</option>
                                            </select>
                                        </td>
                                        <td><input type="text" maxlength="5" onkeypress="return isNumberKey(event);" class="form-control" name="from_month[]" required="required" data-rule-required="true" data-msg-required="Please include from month"></td>
					<td><input type="text" maxlength="5" onkeypress="return isNumberKey(event);" class="form-control" name="to_month[]"  required="required" data-rule-required="true" data-msg-required="Please include to month"></td>
                                        
                                </tr>
                            <?php }  ?>
			</tbody>
                    </table>
                
                
                </div>

            
            <!--button-->
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="box-footer text-center">
					<!--<button type="submit" class="btn btn-success no-print submit">Save</button>-->
					<!--<a href="<?php //$main_page;?>" class="btn btn-danger no-print">Cancel</a>-->
					<button class="btn btn-primary no-print" onclick="history.back();">Back</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</form>
</main>
<?= $footer; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
<script>
    var confirm_bootD = function(title, message, callback) {
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
                                    callback: function(result){
                                        callback(result);
                                    }
                                });

    }
</script>

<script>
    $(document).on('click', '.language', function () {
        if ($(this).attr('tabval') == 1) {
            $('.vaccine_code_b').text('MÃ VACCINE');
            $('.available_status_b').text('TÌNH TRẠNG');
            $('.dose_name_h_b').text('Liều');
            $('.dose_gender_b').text('Giới tính');
            $('.dose_frommonth_b').text('Từ tháng');
            $('.dose_tomonth_b').text('Đến tháng');
            $('.dose_adddelete_b').text('Thêm/ Xóa');
            $('.vaccine_package_code').text('MÃ GÓI VACCINE');
            
            $('.vaccine_name_b').hide();
            $('.vaccine_name_vi_b').show();
            $('.vaccine_short_name_b').hide();
            $('.vaccine_short_name_vi_b').show();
            $('.disease_name_b').hide();
            $('.disease_name_vi_b').show();
            $('.origin_b').hide();
            $('.origin_vi_b').show();
            $('.dose_note').hide();
            $('.dose_note_vi').show();
            $('.dose_name_b').hide();
            $('.dose_name_vi_b').show();
        } else {
            $('.vaccine_code_b').text('VACCINE CODE *');
            $('.available_status_b').text('STATUS *');
            $('.dose_name_h_b').text('Dose Name');
            $('.dose_gender_b').text('Gender');
            $('.dose_frommonth_b').text('From Month');
            $('.dose_tomonth_b').text('To Month');
            $('.dose_adddelete_b').text('Add/Delete');
            $('.vaccine_package_code').text('VACCINE PACKAGE CODE ');
            
            $('.vaccine_name_b').show();
            $('.vaccine_name_vi_b').hide();
            $('.vaccine_short_name_b').show();
            $('.vaccine_short_name_vi_b').hide();
            $('.disease_name_b').show();
            $('.disease_name_vi_b').hide();
            $('.origin_b').show();
            $('.origin_vi_b').hide();
            $('.dose_note').show();
            $('.dose_note_vi').hide();
            $('.dose_name_b').show();
            $('.dose_name_vi_b').hide();
        }

    })

</script>
<script>
    $(document).ready(function() {
        $('input,select').attr('disabled',true)
    });
</script>