<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url('time-adjustment-request'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Create Supervisor</span>
            </li>
            <li class="pull-right">
                <a href="<?php echo base_url('supervisor-list'); ?>" class="btn btngreen"><i class="fa fa-long-arrow-left backbtn" aria-hidden="true"></i>Back</a>
            </li>
        </ul>
        
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-2"></div>
                <div class="col-md-9 col-sm-9">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="<?= base_url('insert-supervisor'); ?>" name="form_add_supervisor" method="post" class="horizontal-form" enctype="multipart/form-data" autocomplete="off">
                                <div class="form-body col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Facility Name <span class="required">*</span></label>
                                            <input type="text" name="facility_name" autocomplete="off" id="sup_name" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Supervisor</label>
                                            <input type="text" name="rehab_director" autocomplete="off" id="rehab_director" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Supervisor Email <span class="required">*</span></label>
                                            <input type="email" name="supervisor_email" autocomplete="off" id="sup_email" class="form-control field_border">
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Regional Manager</label>
                                            <input type="text" name="regl_mgr" autocomplete="off" id="regl_mgr" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Regional Manager Email</label>
                                            <input type="text" name="regl_mgr_email" autocomplete="off" id="regl_mgr_email" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password <span class="required">*</span></label>
                                            <input type="password" name="sup_password" id="sup_password" class="form-control field_border" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password <span class="required">*</span></label>
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control field_border" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: center;">
                                        <div class="form-group">
                                            <label class="control-label"></label>
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="sup_status" class="icheck" data-radio="iradio_square-grey" value="1" checked=""> Active </label>
                                                <label>
                                                    <input type="radio" name="sup_status" class="icheck" data-radio="iradio_square-grey" value="0"> In Active </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="accountbtn" class="btn btngreen frontbtn">Save</button>
                                            <a href="<?php echo base_url('supervisor-list'); ?>" class="btn default">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
<!-- END PAGE CONTENT BODY -->
<!-- END CONTENT BODY -->