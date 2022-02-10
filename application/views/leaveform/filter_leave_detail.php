<style type="text/css">
    .tooltip-inner {
        max-width: 100% !important;    
    }
    .fa-info-circle{
     margin-left: 15px;
     font-size: 16px;
    }
</style>
<!-- BEGIN FORM-->
<form action="<?php echo base_url('update-leaveform'); ?>" name="form_leaveForm" method="post" class="horizontal-form" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Leave Request</h4>
    </div>
    <div class="modal-body"> 
        <div class="form-body row">
            <input type="hidden" name="leaveFormId" id="leaveFormId" value="<?php echo @$leaveDetail['leave_form_id']; ?>">
            <div class="col-md-12">
                <div class="col-md-9">
                    <p style="font-weight: bold;">Are you requesting a leave for yourself or as a supervisor on behalf of an employee.</p>
                </div>
                <div class="col-md-3">
                    <select name="people" id="people" class="form-control select2" disabled="">
                        <option value="">Select Option</option>
                        <option value="self" <?php if(@$leaveDetail['people'] == 'self'){ echo "selected"; } ?>>Self</option>
                        <option value="supervisor" <?php if(@$leaveDetail['people'] == 'supervisor'){ echo "selected"; } ?>>Supervisor</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">First Name <span class="required">*</span></label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo @$leaveDetail['firstName']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Last Name <span class="required">*</span></label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo @$leaveDetail['lastName']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Contact Number <span class="required">*</span></label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control" value="<?php echo @$leaveDetail['contactNumber']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">email <span class="required">*</span></label>
                    <input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo @$leaveDetail['user_email']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Discipline <span class="required">*</span></label>
                    <select name="discipline" id="discipline" class="form-control select2" disabled="">
                        <option value="">Select Option</option>
                        <option value="PT" <?php if(@$leaveDetail['discipline'] == 'PT'){ echo "selected"; } ?>>PT</option>
                        <option value="PTA" <?php if(@$leaveDetail['discipline'] == 'PTA'){ echo "selected"; } ?>>PTA</option>
                        <option value="OT" <?php if(@$leaveDetail['discipline'] == 'OT'){ echo "selected"; } ?>>OT</option>
                        <option value="COTA" <?php if(@$leaveDetail['discipline'] == 'COTA'){ echo "selected"; } ?>>COTA</option>
                        <option value="SLP" <?php if(@$leaveDetail['discipline'] == 'SLP'){ echo "selected"; } ?>>SLP</option>
                        <option value="Rehab Aide" <?php if(@$leaveDetail['discipline'] == 'Rehab Aide'){ echo "selected"; } ?>>Rehab Aide</option>
                        <option value="Regional Manager" <?php if(@$leaveDetail['discipline'] == 'Regional Manager'){ echo "selected"; } ?>>Regional Manager</option>
                        <option value="Corporate Staff" <?php if(@$leaveDetail['discipline'] == 'Corporate Staff'){ echo "selected"; } ?>>Corporate Staff</option>
                    </select>
                    <label id="discipline-error" class="error" for="discipline" style="display: none;"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">State of Employment <span class="required">*</span></label>
                    <select name="state" id="state" class="form-control select2" disabled="">
                        <option value="">Select Option</option>
                        <?php if(!empty($state_list)):
                            foreach(@$state_list as $stateVal):
                            if(@$leaveDetail['state'] == @$stateVal['id']){
                                $select = 'selected';
                            } else{
                                $select = '';
                            } ?>
                                <option value="<?php echo @$stateVal['id']; ?>" <?php echo @$select; ?>><?php echo @$stateVal['name']; ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                    <label id="state-error" class="error" for="state" style="display: none;"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Preferred Contact Method <span class="required">*</span></label>
                    <select name="contact_method" id="contact_method" class="form-control select2" disabled="">
                        <option value="">Select Option</option>
                        <option value="Phone" <?php if(@$leaveDetail['contact_method'] == 'Phone'){ echo "selected"; } ?>>Phone</option>
                        <option value="Email" <?php if(@$leaveDetail['contact_method'] == 'Email'){ echo "selected"; } ?>>Email</option>
                    </select>
                    <label id="contact_method-error" class="error" for="contact_method" style="display: none;"></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Facility <span class="required">*</span></label>
                    <input type="text" name="facility" id="facility" class="form-control field_border" value="<?php echo @$leaveDetail['facility']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Leave Reason <span class="required">*</span></label>
                    <input type="hidden" name="leaveId" id="leaveId" class="form-control field_border" value="<?php echo @$leaveDetail['leave_reason']; ?>" readonly>
                    <select name="leave_reason" id="leave_reason" class="form-control select2" disabled="">
                        <option value="">Select Leave</option>
                        <?php if(!empty($leave_list)):
                            foreach($leave_list as $leaveVal):
                            if(@$leaveDetail['leave_reason'] == @$leaveVal['leave_type_id']){
                                $select = 'selected';
                            } else{
                                $select = '';
                            } ?>
                                <option value="<?php echo @$leaveVal['leave_type_id']; ?>" <?php echo @$select; ?>><?php echo @$leaveVal['leave_type_name']; ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                    <label id="leave_reason-error" class="error" for="leave_reason" style="display: none;"></label>
                </div>
            </div>
            <div class="col-md-12" id="edit_leave_question_view" style="padding: 0;"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Expected Last Day of Work <span class="required">*</span><i class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" title="If dates are estimates, please explain why in the ‘Comment’ box below." ></i></label>
                    <input type="text" name="last_day_work" id="last_day_work" class="form-control" value="<?php echo date('m/d/Y', strtotime(@$leaveDetail['last_day_work'])); ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php if(@$leaveDetail['return_date'] != '0000-00-00'){
                        $return_date = date('m/d/Y', strtotime(@$leaveDetail['return_date']));
                    } else{
                        $return_date = '';
                    } ?>
                    <label class="control-label">Expected Return Date <span class="required">*</span><i class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" title="If dates are estimates, please explain why in the ‘Comment’ box below." ></i></label>
                    <input type="text" name="return_date" id="return_date" class="form-control" value="<?php echo @$return_date; ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Are This Dates Flexible? <span class="required">*</span></label>
                    <select name="date_flexible" id="date_flexible" class="form-control select2" disabled="">
                        <option value="">Select Option</option>
                        <option value="yes" <?php if(@$leaveDetail['date_flexible'] == 'yes'){ echo "selected"; } ?>>Yes</option>
                        <option value="no" <?php if(@$leaveDetail['date_flexible'] == 'no'){ echo "selected"; } ?>>No</option>
                    </select>
                    <label id="date_flexible-error" class="error" for="date_flexible" style="display: none;"></label>
                </div>
            </div>
            <?php // if(@$leaveDetail['people'] == 'employee'){
            //     $employee = 'style="display: block;"';
            // } else {
            //     $employee = 'style="display: none;"';
            // } ?>
            <div id="employee1" style="display: none;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Employee Signature</label>
                        <select name="employee_signature" id="employee_signature" class="form-control select2" disabled="">
                            <option value="">Select Option</option>
                            <option value="yes" <?php if(@$leaveDetail['employee_signature'] == 'yes'){ echo "selected"; } ?>>Yes</option>
                            <option value="no" <?php if(@$leaveDetail['employee_signature'] == 'no'){ echo "selected"; } ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Employee Signed Date</label>
                        <input type="text" name="signed_date" id="signed_date" class="form-control" value="<?php echo date('m/d/Y', strtotime(@$leaveDetail['signed_date'])); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Supervisor Approval</label>
                        <select name="superviser_signature" id="superviser_signature" class="form-control select2" disabled="">
                            <option value="">Select Option</option>
                            <option value="yes" <?php if(@$leaveDetail['superviser_signature'] == 'yes'){ echo "selected"; } ?>>Yes</option>
                            <option value="no" <?php if(@$leaveDetail['superviser_signature'] == 'no'){ echo "selected"; } ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Date Supervisor Approved</label>
                        <input type="text" name="superviser_sign_date" id="superviser_sign_date" class="form-control" value="<?php echo date('m/d/Y', strtotime(@$leaveDetail['superviser_sign_date'])); ?>" readonly>
                    </div>
                </div>
            </div>
            <?php if(@$leaveDetail['people'] == 'self'){
                $self = 'style="display: block;"';
            } else {
                $self = 'style="display: none;"';
            } ?>
            <div id="self" <?php echo @$self; ?>>
                <div class="col-md-7">
                    <label style="margin-bottom:14px; ">Have you discussed your leave with your supervisor? </label>
                   
                </div>
                <div class="col-md-5">
                     <input type="checkbox" name="discussed_supervisor" id="discussed_supervisor"  value="1" <?php if(@$leaveDetail['discs_supervisor'] == '1'){ echo "checked"; } ?> disabled> 
                </div>
            </div>
            <?php if(@$leaveDetail['people'] == 'supervisor'){ 
                $supervisor = 'style="display: block;"';
            } else {
                $supervisor = 'style="display: none;"';
            } ?>
            <div id="supervisor" <?php echo @$supervisor; ?>>
                <div class="col-md-8">
                    <label>Please enter date when you were first notified? </label>
                </div>
                <div class="col-md-4">
                      <input type="text" name="sup_date" id="sup_date" class="form-control fieldDate" value="<?php echo date('m/d/Y', strtotime(@$leaveDetail['sup_date'])); ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" style="margin-top: 16px;">Please explain your Reason for Leave in more detail in the comment box below or any additional information related to your request.</label>
                    <textarea name="comment_status" id="comment_status" class="form-control" disabled=""><?php echo @$leaveDetail['comment_status']; ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Submitted Date </label>
                <input type="text" name="Submitted_date" id="Submitted date" class="form-control fieldDate" value="<?php echo date('m/d/Y', strtotime(@$leaveDetail['createDate'])); ?>" disabled>
            </div>
        </div>
            <div class="col-md-4">
                <div class="form-group" style="margin-top: 20px;">
                    <label class="control-label"></label>
                    <span><?php $date1=date_create(@$leaveDetail['date_submitted']);
                            $date2=date_create(@$leaveDetail['last_day_work']);
                            $diff=date_diff($date1,$date2);
                            if(strtotime(@$leaveDetail['date_submitted']) < strtotime(@$leaveDetail['last_day_work'])) {
                                echo '<span> Requested '.$diff->format("%a"). ' days before leave</span>';
                            } else{
                                echo '<span style="color: red;"> Requested '.$diff->format("%a"). ' days after leave started</span>';
                            }
                            // echo "Requested ".$diff->format("%R%a"). ' days before leave';
                             ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Request Status</label>
                    <select name="request_status" id="request_status" class="form-control select2" disabled="">
                        <option value="">Select Option</option>
                        <option value="Pending" <?php if(@$leaveDetail['leave_status'] == 'Pending'){ echo "selected"; } ?>>Pending</option>
                        <option value="Approved" <?php if(@$leaveDetail['leave_status'] == 'Approved'){ echo "selected"; } ?>>Approved</option>
                        <option value="Denied" <?php if(@$leaveDetail['leave_status'] == 'Denied'){ echo "selected"; } ?>>Denied</option>
                        <option value="Cancel Request" <?php if(@$leaveDetail['leave_status'] == 'Cancel Request'){ echo "selected"; } ?>>Cancel Request</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Attachments</label>
                    <br>
                    <?php if(@$leaveDetail['attachment_file'] != ''){
                        $files = explode(',', @$leaveDetail['attachment_file']);
                            foreach($files as $fileName){ ?>
                                <p class="leave_lable"><a target="_blank" href="<?php echo base_url('uploads/attachment/'.@$fileName); ?>"><?php echo @$fileName; ?></a></p>
                    <?php } } else{ ?>
                        <span><?php echo "There is nothing attached."; ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
       <!--  <button type="submit" id="leaveFormbtn" class="btn btngreen">Submit Request</button> -->
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
    </div>
</form>
<!-- END FORM-->
    <script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>