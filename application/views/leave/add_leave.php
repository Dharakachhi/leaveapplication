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
                <span>Create Leave Reason</span>
            </li>
            <li class="pull-right">
                <a href="<?php echo base_url('leave-reason'); ?>" class="btn btngreen"><i class="fa fa-long-arrow-left backbtn" aria-hidden="true"></i>Back</a>
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
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo base_url('insert-leaveType'); ?>" name="form_addleaveType" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Type<span class="required">*</span>:</label>
                                        <div class="col-md-9">
                                            <input type="text" name="leave_name" id="leave_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Order By:</label>
                                        <div class="col-md-9">
                                            <input type="text" name="order_by" id="order_by" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <label class="col-md-3 control-label"></label>
                                         <div class="col-md-9">
                                              <label><input type="checkbox" name="email_checkbox" id="email_checkbox"  value="1" > </label>
                                        <label style="margin-left: 5px;">Override the default email, send Leave Requests to the email.</label> 
                                         </div>
                                    </div>
                                    <div id="hremail" style="display: none;">
                                        <div class="form-group">
                                             <label class="col-md-3 control-label"></label>
                                             <div class="col-md-9">
                                                <label><input type="checkbox" name="default_email_checkbox" id="default_email_checkbox"  value="1" ></label>
                                                <label style="margin-left: 5px;">Do you want to send default email also ?</label> 
                                             </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">A-L Email<span class="required">*</span>:</label>
                                            <div class="col-md-9">
                                                <input type="text" name="email_labelal" id="email_labelal" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">M-Z Email<span class="required">*</span>:</label>
                                            <div class="col-md-9">
                                                <input type="text" name="email_labelmz" id="email_labelmz" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="leave_status" class="icheck" data-radio="iradio_square-grey" value="1" checked=""> Active </label>
                                                <label>
                                                    <input type="radio" name="leave_status" class="icheck" data-radio="iradio_square-grey" value="0"> In Active </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="leaveTypebtn" class="btn btngreen">Save</button>
                                            <a href="<?php echo base_url('leave-reason'); ?>" class="btn default">Cancel</a>
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