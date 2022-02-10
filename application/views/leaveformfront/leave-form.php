<style type="text/css">
    .tooltip-inner {
        max-width: 100% !important;    
    }
    .fa-info-circle{
     margin-left: 15px;
     font-size: 16px;
    }
</style>
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-2"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo base_url('insert-leaveform'); ?>" name="form_leaveForm" method="post" class="horizontal-form" autocomplete="off" id="form_leaveForm" enctype="multipart/form-data">
                                <!-- <form action="" name="form_leaveForm" method="post" class="horizontal-form" enctype="multipart/form-data"> -->
                                <div class="form-body col-md-12">
                                    <div class="col-md-9">
                                        <p style="font-weight: bold;">Are you requesting a leave for yourself or as a supervisor on behalf of an employee.</p>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="people" id="people" class="form-control select2">
                                            <option value="">Select Option</option>
                                            <option value="self">Self</option>
                                            <option value="supervisor">Supervisor</option>
                                        </select>
                                        <label id="people-error" class="error" for="people" style="display: none;"></label>
                                    </div>
                                    
                                </div>
                                <div class="form-body col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name <span class="required">*</span></label>
                                            <input type="text" name="first_name" id="first_name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name <span class="required">*</span></label>
                                            <input type="text" name="last_name" id="last_name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Contact Number <span class="required">*</span></label>
                                            <input type="text" name="contact_number" id="contact_number" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">email <span class="required">*</span></label>
                                            <input type="text" name="email_id" id="email_id" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Discipline <span class="required">*</span></label>
                                            <select name="discipline" id="discipline" class="form-control select2">
                                                <option value="">Select Option</option>
                                                <option value="PT">PT</option>
                                                <option value="PTA">PTA</option>
                                                <option value="OT">OT</option>
                                                <option value="COTA">COTA</option>
                                                <option value="SLP">SLP</option>
                                                <option value="Rehab Aide">Rehab Aide</option>
                                                <option value="Regional Manager">Regional Manager</option>
                                                <option value="Corporate Staff">Corporate Staff</option>
                                            </select>
                                            <label id="discipline-error" class="error" for="discipline" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">State of Employment <span class="required">*</span></label>
                                            <select name="state" id="state" class="form-control select2">
                                                <option value="">Select Option</option>
                                                <?php if(!empty($state_list)):
                                                    foreach(@$state_list as $stateVal): ?>
                                                        <option value="<?php echo @$stateVal['id']; ?>"><?php echo @$stateVal['name']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <label id="state-error" class="error" for="state" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Preferred Contact Method <span class="required">*</span></label>
                                            <select name="contact_method" id="contact_method" class="form-control select2">
                                                <option value="">Select Option</option>
                                                <option value="Phone">Phone</option>
                                                <option value="Email">Email</option>
                                            </select>
                                            <label id="contact_method-error" class="error" for="contact_method" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Facility <span class="required">*</span></label>
                                            <input type="text" name="facility" id="facility" class="form-control field_border" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Leave Reason <span class="required">*</span></label>
                                            <select name="leave_reason" id="leave_reason" class="form-control select2">
                                                <option value="">Select Leave</option>
                                                <?php if(!empty($leave_list)):
                                                    foreach($leave_list as $leaveVal): ?>
                                                        <option value="<?php echo @$leaveVal['leave_type_id']; ?>"><?php echo @$leaveVal['leave_type_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <label id="leave_reason-error" class="error" for="leave_reason" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="leave_question_list" style="padding: 0;">
                                        
                                    </div>
                                   <!--  <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Leave Details</label>
                                            <input type="text" name="leave_detail" id="leave_detail" class="form-control">
                                        </div>
                                    </div> -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Expected Last Day of Work <span class="required">*</span><i class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" title="If dates are estimates, please explain why in the ‘Comment’ box below." ></i></label>
                                            <input type="text" name="last_day_work" id="last_day_work" class="form-control fieldDate">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Expected Return Date <span class="required">*</span><i class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" title="If dates are estimates, please explain why in the ‘Comment’ box below." ></i></label>
                                            <input type="text" name="return_date" id="return_date" class="form-control fieldDate">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Are These Dates Flexible? <span class="required">*</span></label>
                                            <select name="date_flexible" id="date_flexible" class="form-control select2">
                                                <option value="">Select Option</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <label id="date_flexible-error" class="error" for="date_flexible" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div id="employee1" style="display: none;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Employee Signature <span class="required">*</span></label>
                                                <select name="employee_signature" id="employee_signature" class="form-control select2">
                                                    <option value="">Select Option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                <label id="employee_signature-error" class="error" for="employee_signature" style="display: none;"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Employee Signed Date <span class="required">*</span></label>
                                                <input type="text" name="signed_date" id="signed_date" class="form-control fieldDate">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Supervisor Approval <span class="required">*</span></label>
                                                <select name="superviser_signature" id="superviser_signature" class="form-control select2">
                                                    <option value="">Select Option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                <label id="superviser_signature-error" class="error" for="superviser_signature" style="display: none;"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Date Supervisor Approved <span class="required">*</span></label>
                                                <input type="text" name="superviser_sign_date" id="superviser_sign_date" class="form-control fieldDate">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="self" style="display: none;">
                                        <div class="col-md-7">
                                            <label style="margin-bottom:14px; ">Have you discussed your leave with your supervisor? </label>
                                           
                                        </div>
                                        <div class="col-md-5">
                                             <input type="checkbox" name="discussed_supervisor" id="discussed_supervisor"  value="1" > 
                                        </div>
                                    </div>
                                    <div id="supervisor" style="display: none;">
                                        <div class="col-md-8">
                                            <label>Please enter date when you were first notified? </label>
                                           
                                        </div>
                                        <div class="col-md-4">
                                              <input type="text" name="sup_date" id="sup_date" class="form-control fieldDate">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" style="margin-top: 16px;">Please explain your Reason for Leave in more detail in the comment box below or any additional information related to your request.</label>
                                            <textarea name="comment_status" id="comment_status" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="control-label">Attachments</label>
                                            <input type="file" name="attachment_file" id="attachment_file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9" id="uploaded_image">
                                        <table id="tbl_file_lable" style="display: none;">
                                            <thead>
                                                <tr>
                                                    <th width="30%">File Name</th>
                                                    <th width="25%">Status</th>
                                                    <th width="15%"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="leaveFormbtn" class="btn btngreen">Submit Request</button>
                                            <a href="<?php echo base_url('leave-form'); ?>" class="btn default">Cancel</a>
                                        </div>
                                        <div class="col-md-4"></div>
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
<!-- END CONTENT BODY--> 
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>