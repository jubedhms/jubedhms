<!--Start header-->
<?= $header; ?>
<!--End header-->

<?php
$ID = (isset($details->ID)) ? $details->ID : "";
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
                                            <label for="description" class="">English</label>
											<textarea name="description" class="form-control description_en" id="description_en" data-toggle="wysiwyg---" rows="5"><?=getFieldVal('description',$details)?></textarea>
                                            <span class="error" style="display: none;">
                                                <i class="error-log fa fa-exclamation-triangle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row vi" style="display:none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description_vi" class="">Tiếng Việt</label>
											<textarea name="description_vi" class="form-control description_vi" id="description_vi" data-toggle="wysiwyg---" rows="5"><?=getFieldVal('description_vi',$details)?></textarea>
											<span class="error" style="display: none;">
											    <i class="error-log fa fa-exclamation-triangle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row btn-save-group">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="box-footer text-center">
                                                <a href="<?= $main_page; ?>" class="btn btn-danger btn-Cancel no-print">Cancel</a>
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
    </div>

</main>
<!-- /.main-wrappper -->	
<?= $footer; ?>

<script>
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
</script>

<!-- end -->

<script>
$('.MyForm input,textarea,select,checkbox,radio').attr('disabled', 'disabled');
</script>