<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- BEGIN PAGE BREADCRUMBS -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php if(($this->checkHeader == '0' && ($this->userType == '2' || $this->userType == '1')) || $this->userType == '2'){ echo base_url('time-adjustment-request'); } else{
                                echo base_url();
                            }  ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="page_main_title">Change Password</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMBS -->
                </div>
        </div>
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-11 col-sm-11">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?= base_url('update-password'); ?>" name="change_password_form" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <input type="hidden" name="pw_user_Id" id="pw_user_Id" class="form-control" value="<?php echo @$user_detail['id']; ?>">
                                    <input type="hidden" name="pw_user_email" id="pw_user_email" class="form-control" value="<?php echo @$user_detail['supervisor_email']; ?>">
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Old Password <span class="required">*</span></label>
                                        <div class="col-md-4">
                                            <input type="password" name="old_password" id="old_password" class="form-control">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">New Password <span class="required">*</span></label>
                                        <div class="col-md-4">
                                            <input type="password" name="new_password" id="new_password" class="form-control">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">Confirm Password <span class="required">*</span></label>
                                        <div class="col-md-4">
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="changepasswordbtn" class="btn btngreen">Save</button>
                                            <a href="<?php echo base_url('change-password'); ?>" class="btn default">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
                <div class="col-md-3 col-sm-3"></div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
<!-- END PAGE CONTENT BODY -->
<!-- END CONTENT BODY -->