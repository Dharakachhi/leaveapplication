<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- BEGIN PAGE BREADCRUMBS -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="page_main_title">Update Profile</span>
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
                            <form action="<?php echo base_url('update-profile'); ?>" name="form_profile" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <input type="hidden" name="userId" id="userId" class="form-control" value="<?php echo @$user_detail['id']; ?>">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">First Name<span class="required">*</span> :</label>
                                        <div class="col-md-9">
                                            <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo @$user_detail['firstName']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Last Name<span class="required">*</span> :</label>
                                        <div class="col-md-9">
                                            <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo @$user_detail['lastName']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email<span class="required">*</span> :</label>
                                        <div class="col-md-9">
                                            <input type="text" name="user_email" id="user_email" class="form-control" value="<?php echo @$user_detail['email']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="user_type" class="icheck" data-radio="iradio_square-grey" value="1" disabled="" <?php if(@$user_detail['user_type'] == '1'){ echo 'checked'; } ?>> HR </label>
                                                <label>
                                                    <input type="radio" name="user_type" class="icheck" data-radio="iradio_square-grey" value="2" disabled="" <?php if(@$user_detail['user_type'] == '2'){ echo 'checked'; } ?>> User </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="profilebtn" class="btn btngreen">Save</button>
                                            <a href="<?php echo base_url('profile'); ?>" class="btn default">Cancel</a>
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