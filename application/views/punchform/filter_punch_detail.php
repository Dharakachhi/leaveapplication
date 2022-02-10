 <!-- BEGIN FORM--> 
<!-- <form action="<?php echo base_url('update-punchform'); ?>" name="form_leaveForm" method="post" class="horizontal-form" enctype="multipart/form-data"> -->
<!-- <form  name="form_leaveForm" class="horizontal-form" enctype="multipart/form-data"> -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">View Punch Request</h4>
</div>
<div class="modal-body">
    <div class="form-body row">
        <input type="hidden" name="hiddenURL" id="hiddenURL" value="<?php echo base_url(); ?>">
        <input type="hidden" name="punchId" id="punchId" value="<?= @$punch_detail['id']; ?>">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">First Name <span class="required">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $punch_detail['first_name']; ?>" autocomplete="off" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Last Name <span class="required">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $punch_detail['last_name']; ?>" autocomplete="off" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Email <span class="required">*</span></label>
                <input type="text" name="email_id" id="email_id" class="form-control" value="<?= $punch_detail['email_id']; ?>" autocomplete="off" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">SSN <span class="required">*</span></label>
                <input type="text" name="ssn" class="form-control" value="<?= $punch_detail['ssn']; ?>" autocomplete="off" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Discipline <span class="required">*</span></label>
                 
                <input type="hidden" name="discipline" value="<?= @$punch_detail['discipline']; ?>">
            
                
                <select name="discipline_old" id="discipline" class="form-control select2" disabled="">
                    <option value="">Select Option</option>
                     <?php if(!empty($discipline)):
                    foreach(@$discipline as $value): ?>
                        <option value="<?php echo @$value['id']; ?>"  <?php if(@$punch_detail['discipline'] == @$value['id']){ echo "selected";} ?>><?php echo @$value['discipline_name']; ?></option>
                <?php endforeach; endif; ?>
                </select>
                <label id="discipline-error" class="error" for="discipline" style="display: none;"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Facility Name <span class="required">*</span></label>
                 <input type="hidden" name="facility" value="<?= @$punch_detail['facility']; ?>">
                <select name="facility_old" class="form-control select2" disabled="">
                    <option value="">Select Option</option>
                   <?php if(!empty($facilities_list)):
                    foreach(@$facilities_list as $sup_list):
                    print_r($sup_list); ?>
                        <option value="<?php echo @$sup_list['id']; ?>"  <?php if(@$punch_detail['facility'] == @$sup_list['id']){ echo "selected";} ?>><?php echo @$sup_list['facility_name']; ?></option>
                <?php endforeach; endif; ?>
                </select>
                <label id="facility-error" class="error" for="facility" style="display: none;"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Punch Date <span class="required">*</span></label>
                <input type="text" name="date" class="form-control fieldDate" value="<?= date('m/d/Y',strtotime($punch_detail['date'])); ?>" autocomplete="off" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Punch Status<span class="required">*</span></label>
                <input type="hidden" name="punch_status" value="<?= @$punch_detail['punch_status']; ?>">
                <select name="punch_status_old" class="form-control select2" disabled="">
                    <option value="">Select Option</option>
                  <?php if(!empty($punch_status)):
                    foreach(@$punch_status as $pun_status): ?>
                        <option value="<?php echo @$pun_status['id']; ?>"  <?php if(@$punch_detail['punch_status'] == @$pun_status['id']){ echo "selected";} ?>><?php echo @$pun_status['punch_status_name']; ?></option>
                <?php endforeach; endif; ?>
                </select>
                <label id="punch_status-error" class="error" for="punch_status" style="display: none;"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Punch Type<span class="required">*</span></label>
                <input type="hidden" name="punch_type" value="<?= @$punch_detail['punch_type']; ?>">
                <select name="punch_type_old" id="punch_type" class="form-control select2" disabled="">
                    <option value="">Select Option</option>
                   <?php if(!empty($punch_type)):
                   print_r($punch_type);
                    foreach(@$punch_type as $pun_type): ?>
                        <option value="<?php echo @$pun_type['id']; ?>" <?php if(@$punch_detail['punch_type'] == @$pun_type['id']){ echo "selected";} ?>><?php echo @$pun_type['punch_type_name']; ?></option>
                <?php endforeach; endif; ?>
                </select>
                <label id="punch_type-error" class="error" for="punch_type" style="display: none;"></label>
            </div>
        </div> 
        <?php 
            if(@$punch_type_time['punch_type_name'] == 'IN' || @$punch_type_time['punch_type_name'] == 'OUT'){ 
                $style1 = 'style="display:block"'; 
            }else { 
                $style1 = 'style="display:none"';
            } 
            if(@$punch_type_time['punch_type_name'] != 'IN' && @$punch_type_time['punch_type_name'] != 'OUT' &&  @$punch_type_time['punch_type_name'] != '' ){ 
                $style = 'style="display:block"'; 
            }else { 
                 $style = 'style="display:none"';
            } 
        ?>
        <div class="col-md-6" id="punch_time" <?= @$style1; ?>>
            <div class="form-group">
                <label class="control-label">Punch Time <span class="required">*</span></label>
                <input type="text" autocomplete="off" name="punch_time timepicker-no-seconds"  class="form-control" value="<?= @$punch_detail['punch_time']; ?>" readonly>
            </div>
        </div>
        <div class="col-md-6"  id="lunch_minutes" <?= @$style; ?>>
            <div class="form-group">
                <label class="control-label">Lunch Minutes <span class="required">*</span></label>
                <input type="text" name="lunch_minutes" class="form-control" value="<?= @$punch_detail['lunch_minutes']; ?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Reason<span class="required">*</span></label>
                <input type="hidden" name="reason" value="<?= @$punch_detail['reason']; ?>">
                <select name="reason_old" class="form-control select2" disabled="">
                    <option value="">Select Option</option>
                    <option value="Forgot" <?php if (@$punch_detail['reason'] == 'Forgot') { echo "selected";} ?>>Forgot</option>
                    <option value="Wifi Down" <?php if (@$punch_detail['reason'] == 'Wifi Down') { echo "selected";} ?>>Wifi Down</option>
                    <option value="Computer Unavailable" <?php if (@$punch_detail['reason'] == 'Computer Unavailable') { echo "selected";} ?>>Computer Unavailable</option>
                    <option value="Other" <?php if (@$punch_detail['reason'] == 'Other') { echo "selected";} ?>>Other</option>
                </select>
                <label id="reason-error" class="error" for="reason" style="display: none;"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Optima/Casamba login ID<span class="required">*</span></label>
                <input type="text" name="optima_login_id" id="optima_login_id" class="form-control" value="<?= $punch_detail['optima_login_id']; ?>" autocomplete="off" readonly>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label" style="margin-top: 16px;">Comments</label>
                <textarea name="comment_status" id="comment_status" class="form-control" autocomplete="off" readonly><?= @$punch_detail['comment_status']; ?></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Submitted Date </label>
                    <input type="text" name="Submitted_date_old" id="Submitted date" class="form-control fieldDate" value="<?php echo date('m/d/Y', strtotime(@$punch_detail['createDate'])); ?>" autocomplete="off" readonly>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Request Status</label>
                   <select name="response_status" id="response_status" class="form-control select2" <?php if($this->userType == '2' && (@$punch_detail['response_status_hr'] == 'Completed' || @$punch_detail['response_status_hr'] == 'Canceled')){ echo "disabled"; } ?>>
                            <option value="">Select Option</option>
                            <?php if($this->userType == '2' || $this->userType == '0'){ ?> 
                                <option value="New" <?php if(@$punch_detail['response_status_sup'] == 'New'){ echo "selected"; } ?>>New</option>
                            <?php } ?>
                                <option value="Approved" <?php if(@$punch_detail['response_status_sup'] == 'Approved'){ echo "selected"; } ?>>Approved</option>
                            <?php if($this->userType == '2' || $this->userType == '0'){ ?> 
                                
                                <option value="Denied" <?php if(@$punch_detail['response_status_sup'] == 'Denied'){ echo "selected"; } ?>>Denied</option> 
                            <?php } ?>
                                <?php if(($this->userType == '1' || $this->userType == '0' ) || ($this->userType == '2' && (@$punch_detail['response_status_hr'] == 'Completed' || @$punch_detail['response_status_hr'] == 'Canceled'))){ ?>
                                <option value="Completed"  <?php if(@$punch_detail['response_status_hr'] == 'Completed'){ echo "selected"; } ?>>Completed</option>
                                <option value="Canceled"  <?php if(@$punch_detail['response_status_hr'] == 'Canceled'){ echo "selected"; } ?>>Canceled</option>

                               <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button class="btn btngreen" id="submit">Submit</button>
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
</div>
<!-- </form> -->
<!-- END FORM -->