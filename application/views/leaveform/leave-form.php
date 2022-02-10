<style type="text/css">
.tooltip-inner {
    max-width: 100% !important;
}

.fa-info-circle {
    margin-left: 15px;
    font-size: 16px;
}
</style>
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
                <span>Leave Request</span>
            </li>
        </ul>

        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-2"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo base_url('update-leaveform'); ?>" name="form_leaveForm"
                                method="post" class="horizontal-form" enctype="multipart/form-data">
                                <!--  <form action="" name="form_leaveForm" method="post" class="horizontal-form" enctype="multipart/form-data"> -->
                                <div class="form-body col-md-12">
                                    <div class="col-md-12">
                                        <?php
                                            $id = @$leave_detail['leave_form_id']; ?>
                                        <a href="<?php echo base_url('delete-leave/'.$id) ?>"
                                            onclick="return confirm('This request will be permanently deleted. Would like to continue with the delete?')"><span
                                                class="glyphicon glyphicon-trash"
                                                style="margin-left: 97%; margin-bottom: 15px; font-size: 18px; color: black;"></span></a>
                                    </div>
                                    <div class="col-md-9">
                                        <p style="font-weight: bold;">Are you requesting a leave for yourself or as a
                                            supervisor on behalf of an employee.</p>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="people" id="people" class="form-control select2">
                                            <option value="">Select Option</option>
                                            <option value="self"
                                                <?php if(@$leave_detail['people'] == 'self'){ echo "selected"; } ?>>Self
                                            </option>
                                            <option value="supervisor"
                                                <?php if(@$leave_detail['people'] == 'supervisor'){ echo "selected"; } ?>>
                                                Supervisor</option>
                                        </select>
                                        <label id="people-error" class="error" for="people"
                                            style="display: none;"></label>
                                    </div>
                                </div>
                                <div class="form-body col-md-12">
                                    <input type="hidden" name="leaveFormId" id="leaveFormId"
                                        value="<?php echo @$leave_detail['leave_form_id']; ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">First Name <span
                                                        class="required">*</span></label>
                                                <input type="text" name="first_name" id="first_name"
                                                    class="form-control"
                                                    value="<?php echo @$leave_detail['firstName']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last Name <span
                                                        class="required">*</span></label>
                                                <input type="text" name="last_name" id="last_name" class="form-control"
                                                    value="<?php echo @$leave_detail['lastName']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Contact Number <span
                                                        class="required">*</span></label>
                                                <input type="text" name="contact_number" id="contact_number"
                                                    class="form-control"
                                                    value="<?php echo @$leave_detail['contactNumber']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">email <span
                                                        class="required">*</span></label>
                                                <input type="text" name="email_id" id="email_id" class="form-control"
                                                    value="<?php echo @$leave_detail['user_email']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Discipline <span
                                                        class="required">*</span></label>
                                                <select name="discipline" id="discipline" class="form-control select2">
                                                    <option value="">Select Option</option>
                                                    <option value="PT"
                                                        <?php if(@$leave_detail['discipline'] == 'PT'){ echo "selected"; } ?>>
                                                        PT</option>
                                                    <option value="PTA"
                                                        <?php if(@$leave_detail['discipline'] == 'PTA'){ echo "selected"; } ?>>
                                                        PTA</option>
                                                    <option value="OT"
                                                        <?php if(@$leave_detail['discipline'] == 'OT'){ echo "selected"; } ?>>
                                                        OT</option>
                                                    <option value="COTA"
                                                        <?php if(@$leave_detail['discipline'] == 'COTA'){ echo "selected"; } ?>>
                                                        COTA</option>
                                                    <option value="SLP"
                                                        <?php if(@$leave_detail['discipline'] == 'SLP'){ echo "selected"; } ?>>
                                                        SLP</option>
                                                    <option value="Rehab Aide"
                                                        <?php if(@$leave_detail['discipline'] == 'Rehab Aide'){ echo "selected"; } ?>>
                                                        Rehab Aide</option>
                                                    <option value="Regional Manager"
                                                        <?php if(@$leave_detail['discipline'] == 'Regional Manager'){ echo "selected"; } ?>>
                                                        Regional Manager</option>
                                                    <option value="Corporate Staff"
                                                        <?php if(@$leave_detail['discipline'] == 'Corporate Staff'){ echo "selected"; } ?>>
                                                        Corporate Staff</option>
                                                </select>
                                                <label id="discipline-error" class="error" for="discipline"
                                                    style="display: none;"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">State of Employment <span
                                                        class="required">*</span></label>
                                                <select name="state" id="state" class="form-control select2">
                                                    <option value="">Select Option</option>
                                                    <?php if(!empty($state_list)):
                                                    foreach(@$state_list as $stateVal):
                                                    if(@$leave_detail['state'] == @$stateVal['id']){
                                                        $select = 'selected';
                                                    } else{
                                                        $select = '';
                                                    } ?>
                                                    <option value="<?php echo @$stateVal['id']; ?>"
                                                        <?php echo @$select; ?>>
                                                        <?php echo @$stateVal['name']; ?></option>
                                                    <?php endforeach; endif; ?>
                                                </select>
                                                <label id="state-error" class="error" for="state"
                                                    style="display: none;"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Preferred Contact Method <span
                                                        class="required">*</span></label>
                                                <select name="contact_method" id="contact_method"
                                                    class="form-control select2">
                                                    <option value="">Select Option</option>
                                                    <option value="Phone"
                                                        <?php if(@$leave_detail['contact_method'] == 'Phone'){ echo "selected"; } ?>>
                                                        Phone</option>
                                                    <option value="Email"
                                                        <?php if(@$leave_detail['contact_method'] == 'Email'){ echo "selected"; } ?>>
                                                        Email</option>
                                                </select>
                                                <label id="contact_method-error" class="error" for="contact_method"
                                                    style="display: none;"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Facility <span
                                                        class="required">*</span></label>
                                                <input type="text" name="facility" id="facility"
                                                    class="form-control field_border"
                                                    value="<?php echo @$leave_detail['facility']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Leave Reason <span
                                                        class="required">*</span></label>
                                                <input type="hidden" name="leaveId" id="leaveId"
                                                    class="form-control field_border"
                                                    value="<?php echo @$leave_detail['leave_reason']; ?>">
                                                <select name="leave_reason" id="leave_reason"
                                                    class="form-control select2" disabled="">
                                                    <option value="">Select Leave</option>
                                                    <?php if(!empty($leave_list)):
                                                    foreach($leave_list as $leaveVal):
                                                    if(@$leave_detail['leave_reason'] == @$leaveVal['leave_type_id']){
                                                        $select = 'selected';
                                                    } else{
                                                        $select = '';
                                                    } ?>
                                                    <option value="<?php echo @$leaveVal['leave_type_id']; ?>"
                                                        <?php echo @$select; ?>>
                                                        <?php echo @$leaveVal['leave_type_name']; ?>
                                                    </option>
                                                    <?php endforeach; endif; ?>
                                                </select>
                                                <label id="leave_reason-error" class="error" for="leave_reason"
                                                    style="display: none;"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" id="edit_leave_question" style="padding: 0;"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Expected Last Day of Work <span
                                                        class="required">*</span><i class="fa fa-info-circle"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="If dates are estimates, please explain why in the ‘Comment’ box below."></i></label>
                                                <input type="text" name="last_day_work" id="last_day_work"
                                                    class="form-control fieldDate"
                                                    value="<?php echo date('m/d/Y', strtotime(@$leave_detail['last_day_work'])); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php if(@$leave_detail['return_date'] != '0000-00-00'){
                                                $return_date = date('m/d/Y', strtotime(@$leave_detail['return_date']));
                                            } else{
                                                $return_date = '';
                                            } ?>
                                                <label class="control-label">Expected Return Date <span
                                                        class="required">*</span><i class="fa fa-info-circle"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="If dates are estimates, please explain why in the ‘Comment’ box below."></i></label>
                                                <input type="text" name="return_date" id="return_date"
                                                    class="form-control fieldDate" value="<?php echo @$return_date; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Are These Dates Flexible? <span
                                                        class="required">*</span></label>
                                                <select name="date_flexible" id="date_flexible"
                                                    class="form-control select2">
                                                    <option value="">Select Option</option>
                                                    <option value="yes"
                                                        <?php if(@$leave_detail['date_flexible'] == 'yes'){ echo "selected"; } ?>>
                                                        Yes</option>
                                                    <option value="no"
                                                        <?php if(@$leave_detail['date_flexible'] == 'no'){ echo "selected"; } ?>>
                                                        No</option>
                                                </select>
                                                <label id="date_flexible-error" class="error" for="date_flexible"
                                                    style="display: none;"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(@$leave_detail['people'] == 'employee'){
                                        $employee = 'style="display: block;"';
                                    } else {
                                        $employee = 'style="display: none;"';
                                    } ?>
                                    <div id="employee1" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Employee Signature <span
                                                            class="required">*</span></label>
                                                    <select name="employee_signature" id="employee_signature"
                                                        class="form-control select2">
                                                        <option value="">Select Option</option>
                                                        <option value="yes"
                                                            <?php if(@$leave_detail['employee_signature'] == 'yes'){ echo "selected"; } ?>>
                                                            Yes</option>
                                                        <option value="no"
                                                            <?php if(@$leave_detail['employee_signature'] == 'no'){ echo "selected"; } ?>>
                                                            No</option>
                                                    </select>
                                                    <label id="employee_signature-error" class="error"
                                                        for="employee_signature" style="display: none;"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Employee Signed Date <span
                                                            class="required">*</span></label>
                                                    <input type="text" name="signed_date" id="signed_date"
                                                        class="form-control"
                                                        value="<?php echo date('m/d/Y', strtotime(@$leave_detail['signed_date'])); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Supervisor Approval <span
                                                            class="required">*</span></label>
                                                    <select name="superviser_signature" id="superviser_signature"
                                                        class="form-control select2">
                                                        <option value="">Select Option</option>
                                                        <option value="yes"
                                                            <?php if(@$leave_detail['superviser_signature'] == 'yes'){ echo "selected"; } ?>>
                                                            Yes</option>
                                                        <option value="no"
                                                            <?php if(@$leave_detail['superviser_signature'] == 'no'){ echo "selected"; } ?>>
                                                            No</option>
                                                    </select>
                                                    <label id="superviser_signature-error" class="error"
                                                        for="superviser_signature" style="display: none;"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Date Supervisor Approved <span
                                                            class="required">*</span></label>
                                                    <input type="text" name="superviser_sign_date"
                                                        id="superviser_sign_date" class="form-control"
                                                        value="<?php echo date('m/d/Y', strtotime(@$leave_detail['superviser_sign_date'])); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(@$leave_detail['people'] == 'self'){
                                        $self = 'style="display: block;"';
                                    } else {
                                        $self = 'style="display: none;"';
                                    } ?>
                                    <div id="self" <?php echo @$self; ?>>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label style="margin-bottom:14px; ">Have you discussed your leave with
                                                    your
                                                    supervisor? </label>

                                            </div>
                                            <div class="col-md-5">
                                                <input type="checkbox" name="discussed_supervisor"
                                                    id="discussed_supervisor" value="1"
                                                    <?php if(@$leave_detail['discs_supervisor'] == '1'){ echo "checked"; } ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(@$leave_detail['people'] == 'supervisor'){ 
                                        $supervisor = 'style="display: block;"';
                                    } else {
                                        $supervisor = 'style="display: none;"';
                                    } ?>
                                    <div id="supervisor" <?php echo @$supervisor; ?>>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label>Please enter date when you were first notified? </label>

                                            </div>
                                            <div class="col-md-4">
                                                <?php if(@$leave_detail['sup_date'] != '0000-00-00'){
                                                $sup_date = date('m/d/Y', strtotime(@$leave_detail['sup_date']));
                                            } else{
                                                $sup_date = '';
                                            } ?>
                                                <input type="text" name="sup_date" id="sup_date"
                                                    class="form-control fieldDate" value="<?php echo @$sup_date; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" style="margin-top: 16px;">Please explain
                                                    your
                                                    Reason for Leave in more detail in the comment box below or any
                                                    additional information related to your request.</label>
                                                <textarea name="comment_status" id="comment_status"
                                                    class="form-control"><?php echo @$leave_detail['comment_status']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Submitted Date </label>
                                                <input type="text" name="Submitted_date" id="Submitted date"
                                                    class="form-control fieldDate"
                                                    value="<?php echo date('m/d/Y', strtotime(@$leave_detail['createDate'])); ?>"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" style="margin-top: 20px;">
                                                <label class="control-label"></label>
                                                <span><?php $date1=date_create(@$leave_detail['date_submitted']);
                                                    $date2=date_create(@$leave_detail['last_day_work']);
                                                    $diff=date_diff($date1,$date2);
                                                    // echo "Requested ".$diff->format("%R%a"). ' days before leave';
                                                    if(strtotime(@$leave_detail['date_submitted']) < strtotime(@$leave_detail['last_day_work'])) {
                                                        echo '<span> Requested '.$diff->format("%a"). ' days before leave</span>';
                                                    } else{
                                                        echo '<span style="color: red;"> Requested '.$diff->format("%a"). ' days after leave started</span>';
                                                    } ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Request Status</label>
                                                <select name="request_status" id="request_status"
                                                    class="form-control select2">
                                                    <option value="">Select Option</option>
                                                    <option value="Pending"
                                                        <?php if(@$leave_detail['leave_status'] == 'Pending'){ echo "selected"; } ?>>
                                                        Pending</option>
                                                    <option value="Approved"
                                                        <?php if(@$leave_detail['leave_status'] == 'Approved'){ echo "selected"; } ?>>
                                                        Approved</option>
                                                    <option value="Denied"
                                                        <?php if(@$leave_detail['leave_status'] == 'Denied'){ echo "selected"; } ?>>
                                                        Denied</option>
                                                    <option value="Cancel Request"
                                                        <?php if(@$leave_detail['leave_status'] == 'Cancel Request'){ echo "selected"; } ?>>
                                                        Cancel Request</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Attachments</label>
                                                <br>
                                                <?php if(@$leave_detail['attachment_file'] != ''){
                                                $files = explode(',', @$leave_detail['attachment_file']);
                                                    foreach($files as $fileName){ ?>
                                                <p class="leave_lable"><a target="_blank"
                                                        href="<?php echo base_url('uploads/attachment/'.@$fileName); ?>"><?php echo @$fileName; ?></a>
                                                </p>
                                                <?php } } else{ ?>
                                                <span><?php echo "There is nothing attached."; ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="leaveFormbtn" class="btn btngreen">Submit
                                                Request</button>
                                            <a href="<?php echo base_url('leave-requests'); ?>"
                                                class="btn default">Cancel</a>
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
<!-- END CONTENT BODY -->
<script type="text/javascript">
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>