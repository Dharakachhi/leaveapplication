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
                            <form action="<?= base_url('update-sup-profile'); ?>" name="form_sup_profile" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <input type="hidden" name="supId" id="supId" class="form-control" value="<?= @$sup_detail['id']; ?>">
                                    <input type="hidden" name="userType" id="userType" class="form-control" value="<?= @$sup_detail['userType']; ?>">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Facility Name<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="sup_name" id="sup_name" class="form-control" value="<?= @$sup_detail['facility_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Supervisor<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="rehab_director" id="rehab_director" class="form-control" value="<?= @$sup_detail['rehab_director']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Supervisor Email <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="sup_email" id="sup_email" class="form-control" value="<?= @$sup_detail['supervisor_email']; ?>" readonly>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">Regional Manager</label>
                                        <div class="col-md-9">
                                            <input type="text" name="regl_mgr" id="regl_mgr" class="form-control" value="<?= @$sup_detail['regl_mgr']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Regional Manager Email</label>
                                        <div class="col-md-9">
                                            <input type="text" name="regl_mgr_email" id="regl_mgr_email" class="form-control" value="<?= @$sup_detail['regl_mgr_email']; ?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="profilebtn" class="btn btngreen">Save</button>
                                            <a href="<?= base_url('profile'); ?>" class="btn default">Cancel</a>
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