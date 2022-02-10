<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Email Template</span>
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
                            <form action="<?php echo base_url('insert-emailtemplate'); ?>" name="form_addtemplate" method="post" class="horizontal-form" enctype="multipart/form-data">
                                <div class="form-body col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Template Name <span class="required">*</span> :</label>
                                            <select name="template_name" id="template_name" class="form-control select2">
                                                <option value="">Select Template</option>
                                                <option value="1">Email Template For Request</option>
                                                <option value="2">Email Template For Approved</option>
                                                <option value="3">Email Template For Rejected</option>
                                                <option value="4">Email Template For Cancelled</option>
                                            </select>
                                            <label id="template_name-error" class="error" for="template_name" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Email Parameters :</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border: 1px solid #bab8b8; margin-left: 15px;">
                                        <div class="form-group">
                                            <p class="leave_lable">{Employee Name}</p>
                                            <p class="leave_lable">{Employee Email}</p>
                                            <p class="leave_lable">{Employee Contact}</p>
                                            <p class="leave_lable">{Employee Facility}</p>
                                            <p class="leave_lable">{Leave Reason}</p>
                                            <p class="leave_lable">{Dates of the Leave Request}</p>
                                            <p class="leave_lable">{Comment}</p>
                                            <p class="leave_lable">{Leave Status}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Content :</label>
                                            <textarea name="template_content" class="form-control summernote" id="template_content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="templatebtn" class="btn btngreen frontbtn">Save</button>
                                            <a href="<?php echo base_url('email-template'); ?>" class="btn default">Cancel</a>
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
<!-- END CONTENT BODY