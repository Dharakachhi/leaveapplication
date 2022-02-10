<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- BEGIN PAGE BREADCRUMBS -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo base_url('time-adjustment-request'); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="page_main_title">Update Email Setting</span>
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
                            <form action="<?php echo base_url('insert-punchemailsetting'); ?>" name="form_profile" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <input type="hidden" name="email_id" id="email_id" class="form-control" value="<?php echo @$email_info['id']; ?>">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">SMTP Host Name<span class="required">*</span> </label>
                                        <div class="col-md-4">
                                            <input type="text" name="host" id="host" class="form-control" value="<?php echo @$email_info['host']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">SMTP Port<span class="required">*</span> </label>
                                        <div class="col-md-4">
                                            <input type="text" name="port" id="port" class="form-control" value="<?php echo @$email_info['port']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">SMTP User Name<span class="required">*</span> </label>
                                        <div class="col-md-4">
                                            <input type="text" name="username" id="username" class="form-control" value="<?php echo @$email_info['username']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">SMTP Password <span class="required">*</span> </label>
                                        <div class="col-md-4">
                                            <input type="password" name="password" id="password" class="form-control" value="<?php echo @$email_info['password']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">From Email <span class="required">*</span> </label>
                                        <div class="col-md-4">
                                            <input type="text" name="from_email" id="from_email" class="form-control" value="<?php echo @$email_info['from_email']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email Title <span class="required">*</span> </label>
                                        <div class="col-md-4">
                                            <input type="text" name="email_title" id="email_title" class="form-control" value="<?php echo @$email_info['email_title']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="" class="btn btngreen">Save</button>
                                            <a href="<?php echo base_url('time-adjustment-request'); ?>" class="btn default">Cancel</a>
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