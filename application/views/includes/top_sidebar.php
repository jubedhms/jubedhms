<!-- HEADER & TOP NAVIGATION -->
<nav class="navbar">
    <!-- Logo Area -->
    <?php $NoImage='assets/img/icon/not-available.jpg';?>
    <div class="navbar-header">
        <a href="<?=base_url('dashboard')?>" class="navbar-brand">
            <img class="logo-expand" alt="" src="<?=base_url('assets/img/logo.png')?>" style="max-height:75px;">
            <img class="logo-collapse" alt="" src="<?=base_url('assets/img/logo-collapse.png')?>" >
            <!-- <p>BonVue</p> -->
        </a>
    </div>
    <!-- /.navbar-header -->
    <!-- Left Menu & Sidebar Toggle -->
    <ul class="nav navbar-nav">
        <li class="sidebar-toggle dropdown"><a href="javascript:void(0)" class="ripple"><i class="feather feather-menu list-icon fs-20"></i></a>
        </li>
    </ul>
    <!-- /.navbar-left -->
    <!-- Search Form -->
   <!--
   <form class="navbar-search d-none d-sm-block" role="search"><i class="feather feather-search list-icon"></i>
        <input type="search" class="search-query" placeholder="Search anything..."> <a href="javascript:void(0);" class="remove-focus"><i class="feather feather-x"></i></a>
    </form>
    -->
    <!-- /.navbar-search -->
    <div class="spacer"></div>
    <!-- Right Menu -->
  
        <ul class="nav navbar-nav d-none d-lg-flex ml-2 ml-0-rtl ">
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-bell list-icon"></i><span class="totalmessage" style=" color: red; font-size: 13px; top: -8px; height: 77px; left: -2px; position: relative; font-weight: bold; ">0</span> </a>
				<div class="dropdown-menu dropdown-left dropdown-card animated flipInY">
					<div class="card">
						<!--<header class="card-header d-flex justify-content-between mb-0"><a href="javascript:void(0);"><i class="feather feather-bell color-primary" aria-hidden="true"></i></a>  <span class="heading-font-family flex-1 text-center fw-400">Notifications</span>  <a href="javascript:void(0);"><i class="feather feather-settings color-content"></i></a>-->
						<!--</header>-->
						<ul class="card-body list-unstyled dropdown-list-group">
<!--							<li><a href="#" class="media"><span class="d-flex"><i class="material-icons list-icon">check</i> </span><span class="media-body"><span class="heading-font-family media-heading">Invitation accepted</span> <span class="media-content">Your have been Invited ...</span></span></a>
							</li>-->
                                                    <li><a href="<?php echo base_url(); ?>chatn" class="media"><span class="totalmessage" style="color: red;">0</span><span class="media-body"><span class="heading-font-family media-heading">Total message</span> <span class="media-content">Click to see the users' queries.</span></span></a>
							</li>
<!--							<li><a href="#" class="media"><span class="d-flex"><i class="material-icons list-icon">event_available</i> </span><span class="media-body"><span class="-heading-font-family media-heading">To Do</span> <span class="media-content">Meeting with Nathan on Friday 8 AM ...</span></span></a>
							</li>-->
						</ul>
						
						<!-- /.dropdown-list-group -->
 
    <!--<footer class="card-footer text-center"><a href="javascript:void(0);" class="headings-font-family text-uppercase fs-13">See all activity</a>-->
    <!--</footer>-->
    </div>
    </div>
  
   
    </li>

    
<!--<li>
    <a href="javascript:void(0);" class="right-sidebar-toggle"><i class="fa fa-commenting-o" style="font-size: 25px;" aria-hidden="true"></i></a>
    <a href="javascript:void(0);" class="right-sidebar-toggle"><i class="feather feather-settings list-icon" ></i></a>
</li>-->
    </ul>
<!--<ul class="activelanguage lactive" lactv="1">English</ul>
<ul class="activelanguage" lactv="2">Vietnam</ul>
<div id="google_translate_element2"></div>-->

    <!-- /.navbar-right -->
    <!-- User Image with Dropdown -->
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle dropdown-toggle-user ripple" data-toggle="dropdown">
                <span class="avatar thumb-xs2">
                    <img src="<?=base_url((getSession('p_pic')!='')?getSession('p_pic'):$NoImage);?>" class="rounded-circle login-profile-pic" alt="" title="<?=$this->NAME;?>">
                    <i class="feather feather-chevron-down list-icon"></i>
                </span>
            </a>
            <div
                    class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
                <div class="card">
                    <header class="card-header d-flex mb-0">
                        <!--<a href="javascript:void(0);" class="col-md-4 text-center">
                            <i class="feather feather-user-plus align-middle"></i>
                        </a>
                        <a href="javascript:void(0);" class="col-md-4 text-center">
                            <i class="feather feather-settings align-middle"></i>
                        </a>-->
                        <a href="<?= base_url('signout');?>" class="col-md-12 text-center" title="">
                            <i class="feather feather-power align-middle"></i>
                        </a>
                    </header>
                    <ul class="list-unstyled card-body">
                        <?php 
							//if(checkModulePermission(8)){ 
								$profilePath="user/user_profile";
						?>
                            <li>
								<a href="<?=base_url($profilePath);?>">
									<span class="align-middle">Manage Profile</span>
								</a>
                            </li>
							<!--<li>
									<a href="<?=base_url('#');?>">
										<span class="align-middle">Change Password</span>
									</a>
							</li>-->
                        <?php //} ?>
						
							<!--<li>
									<a href="javascript:void(0)">
										<span class="align-middle">Check Inbox</span>
									</a>
							</li>-->
							<li><a href="<?= base_url('signout');?>"><span><span class="align-middle">Sign Out</span></span></a>
                        </li>
                    </ul>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.dropdown-card-profile -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-nav -->
</nav>
<!-- /.navbar -->

<!--  -->
<script type="text/javascript" src="<?= base_url('assets/js/chatbot.js');?>" type="text/javascript"></script> 
<script>
/*$(document).on('click','.activelanguage',function(){
    var lactv=$(this).attr('lactv');
    $('.activelanguage').removeClass('lactive');
    if(lactv==1){
        $(this).addClass('lactive');
        doGTranslate('en|en');
    }else{
         $(this).addClass('lactive');
         doGTranslate('en|vi');
    };
    
});*/
   setInterval(function(){
       $.post('<?php echo base_url(); ?>chatn/getMessageCount',{},function(data){
           if(data){
               var dt=JSON.parse(data);
               $('.totalmessage').text('');
               $('.totalmessage').text(dt);
           }else{
                $('.totalmessage').text('0');
        }
       });
   },5000)
</script>