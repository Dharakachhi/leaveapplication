
<!--BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url('time-adjustment-request'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Punch Request</span>
            </li>
        </ul>
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-2"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo base_url('update-punchform'); ?>" name="form_punchForm" method="post" class="horizontal-form" autocomplete="off" id="" enctype="multipart/form-data">
                                <div class="form-body col-md-12">
                                    <input type="hidden" name="punchId" value="<?= @$punch_detail['id']; ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">First Name <span class="required">*</span></label>
                                                <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $punch_detail['first_name']; ?>" autocomplete="off">
                                                <label id="first_name-error" class="error" for="first_name"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last Name <span class="required">*</span></label>
                                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $punch_detail['last_name']; ?>" autocomplete="off">
                                                <label id="last_name-error" class="error" for="last_name"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Email <span class="required">*</span></label>
                                                <input type="text" name="email_id" id="email_id" class="form-control" value="<?= $punch_detail['email_id']; ?>" autocomplete="off">
                                                <label id="email_id-error" class="error" for="email_id"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last four digits of SSN <span class="required">*</span></label>
                                                <input type="text" name="ssn" class="form-control" value="<?= $punch_detail['ssn']; ?>" autocomplete="off">
                                                <label id="ssn-error" class="error" for="ssn"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Discipline <span class="required">*</span></label>
                                                <select name="discipline" id="discipline" class="form-control select2">
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
                                                <select name="facility" class="form-control select2">
                                                    <option value="">Select Option</option>
                                                   <?php if(!empty($facilities_list)):
                                                    foreach(@$facilities_list as $sup): ?>
                                                        <option value="<?php echo @$sup['id']; ?>"  <?php if(@$punch_detail['facility'] == @$sup['id']){ echo "selected";} ?>><?php echo @$sup['facility_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                                </select>
                                                <label id="facility-error" class="error" for="facility" style="display: none;"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Punch Date <span class="required">*</span></label>
                                                <input type="text" name="date" class="form-control fieldDate1" value="<?= date('m/d/Y',strtotime($punch_detail['date'])); ?>" autocomplete="off">
                                                 <label id="date-error" class="error" for="date"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Punch Status<span class="required">*</span></label>
                                                <select name="punch_status" class="form-control select2">
                                                    <option value="">Select Option</option>
                                                     <?php if(!empty($punch_status)):
                                                    foreach(@$punch_status as $pun_status): ?>
                                                        <option value="<?php echo @$pun_status['id']; ?>"  <?php if(@$punch_detail['punch_status'] == @$pun_status['id']){ echo "selected";} ?>><?php echo @$pun_status['punch_status_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                                </select>
                                                <label id="punch_status-error" class="error" for="punch_status" style="display: none;"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Reason<span class="required">*</span></label>
                                                <select name="reason" class="form-control select2" id="reason">
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
                                                <input type="text" name="optima_login_id" id="optima_login_id" class="form-control" value="<?= $punch_detail['optima_login_id']; ?>" autocomplete="off">
                                                <label id="optima_login_id-error" class="error" for="optima_login_id"></label>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row"> 
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Punch Type<span class="required">*</span></label>
                                                <select name="punch_type" id="punch_type" class="form-control select2">
                                                    <option value="">Select Option</option>
                                                   <?php if(!empty($punch_type)):
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
                                                <input type="text" name="punch_time"  class="form-control timepicker-no-seconds" value="<?= @$punch_detail['punch_time']; ?>" autocomplete="off">
                                                <label id="punch_time-error" class="error" for="punch_time"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6"  id="lunch_minutes" <?= @$style; ?>>
                                            <div class="form-group">
                                                <label class="control-label">Lunch Minutes <span class="required">*</span></label>
                                                <input type="text" name="lunch_minutes" class="form-control" value="<?= @$punch_detail['lunch_minutes']; ?>" autocomplete="off">
                                                <label id="lunch_minutes-error" class="error" for="lunch_minutes"></label>
                                            </div>
                                        </div>
                                    </div>       
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" style="margin-top: 16px;">Comments</label>
                                                <textarea name="comment_status" id="comment_status" class="form-control"><?= @$punch_detail['comment_status']; ?></textarea>
                                                <label id="comment_status-error" class="error" for="comment_status"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Submitted Date </label>
                                                <input type="text" name="Submitted_date" id="Submitted date" class="form-control fieldDate" value="<?php echo date('m/d/Y', strtotime(@$punch_detail['createDate'])); ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Request Status</label>
                                                <select name="response_status" class="form-control select2" <?php if($this->userType == '2' && (@$punch_detail['response_status_hr'] == 'Completed' || @$punch_detail['response_status_hr'] == 'Canceled')){
                                                    echo "disabled";
                                                } ?>>
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
                                <br>
                                
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="punch_submit" class="btn btngreen">Submit Request</button>
                                            <a href="<?= base_url('time-adjustment-request'); ?>" class="btn default">Cancel</a>
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




