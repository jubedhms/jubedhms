        <aside class="right-sidebar scrollbar-enabled suppress-x">
            <div class="sidebar-chat" data-plugin="chat-sidebar">
                <div class="sidebar-chat-info">
                    <h6 class="fs-16">Chat List</h6>
                    <form class="mr-t-10">
                        <div class="form-group">
                            <input type="search" class="form-control form-control-rounded fs-13 heading-font-family pd-r-30 searchPatient" placeholder="Search for friends ..."> <i class="feather feather-search post-absolute pos-right vertical-center mr-3 text-muted"></i>
                        </div>
                    </form>
                </div>
                <div class="chat-list">
                    <div class="list-group row all_parient">
                        <?php $patient=$this->db->get_where('patient',array('is_deleted'=>0))->result();
                        //print_r($patient);die;
                        if(isset($patient)){ foreach($patient as $row){ ?>
                        <a href="javascript:void(0)" class="list-group-item patientChat" data-username="<?=$row->username;?>" data-patientid="<?=$row->ID; ?>" data-chat-user="<?=$row->first_name.' '.$row->middle_name.''.$row->last_name; ?>">
                            <figure class="thumb-xs user--online mr-3 mr-0-rtl ml-3-rtl">
                                <img src="<?=base_url()?>assets/demo/users/user2.jpg" class="rounded-circle" alt="">
                            </figure><span><span class="name"><?=$row->first_name.' '.$row->middle_name.''.$row->last_name; ?></span>  <span class="username">@<?=$row->username; ?></span> </span>
                        </a>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </aside>
		
        <div class="chat-panel" hidden>
            <div class="card">
                <div class="card-header d-flex justify-content-between"><a href="javascript:void(0);"><i class="feather feather-message-square text-success"></i></a>  <span class="user-name heading-font-family fw-400">John Doe</span> 
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="widget-chat-activity flex-1">
                        <div class="messages scrollbar-enabled suppress-x" id="messagesDiv">
                            
                            
                        </div>
                        <!-- /.messages -->
                    </div>
                    <!-- /.widget-chat-acitvity -->
                </div>
                <!-- /.card-body -->
                <form action="javascript:void(0)" class="card-footer" method="post">
                    <div class="d-flex justify-content-end"><i class="feather feather-plus-circle list-icon my-1 mr-3"></i>
                        <input type="hidden" value="" class="patient_id">
                        <!--<input type="hidden" value="" class="patient_name">-->
                        <input type="hidden" value="" class="patient_username">
                        <textarea class="border-0 flex-1 replymessage" rows="1" style="resize: none" placeholder="Type your message here"></textarea>
                        <button class="btn btn-sm btn-circle bg-transparent replyChat" type="button"><i class="feather feather-arrow-right list-icon fs-26 text-success"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.chat-panel -->
