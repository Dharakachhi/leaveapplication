<!--BEGIN PAGE CONTENT BODY -->
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
                            <form action="<?php echo base_url('insert-punchform'); ?>" name="form_punchForm" method="post" class="horizontal-form" autocomplete="off" enctype="multipart/form-data">
                                <div class="form-body col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">First Name <span class="required">*</span></label>
                                                <input type="text" autocomplete="off" name="first_name" id="first_name" class="form-control" >
                                                <label id="first_name-error" class="error" for="first_name"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last Name <span class="required">*</span></label>
                                                <input type="text" name="last_name" id="last_name" class="form-control" autocomplete="off">
                                                <label id="last_name-error" class="error" for="last_name"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Email <span class="required">*</span></label>
                                                <input type="text" name="email_id" id="email_id" class="form-control" autocomplete="off">
                                                <label id="email_id-error" class="error" for="email_id"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last four digits of SSN <span class="required">*</span></label>
                                                <input type="text" name="ssn" class="form-control" autocomplete="off">
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
                                                    foreach(@$discipline as $val):  ?>
                                                        <option value="<?php echo @$val['id']; ?>"><?php echo @$val['discipline_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                                </select>
                                                <label id="discipline-error" class="error" for="discipline" ></label>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Facility Name <span class="required">*</span></label>
                                                <select name="facility" class="form-control select2">
                                                    <option value="">Select Option</option>
                                                   <?php if(!empty($facilities_list)):
                                                    foreach(@$facilities_list as $sup):  ?>
                                                        <option value="<?php echo @$sup['id']; ?>"><?php echo @$sup['facility_name']; ?></option>
                                                <?php  endforeach; endif; ?>
                                                </select>
                                                <label id="facility-error" class="error" for="facility" ></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Punch Date <span class="required">*</span></label>
                                                <input type="text" name="date" class="form-control fieldDate1" autocomplete="off">
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
                                                        <option value="<?php echo @$pun_status['id']; ?>"><?php echo @$pun_status['punch_status_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                                </select>
                                                <label id="punch_status-error" class="error" for="punch_status" ></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Reason<span class="required">*</span></label>
                                                <select name="reason" class="form-control select2" id="reason">
                                                    <option value="">Select Option</option>
                                                    <option value="Forgot">Forgot</option>
                                                    <option value="Wifi Down">Wifi Down</option>
                                                    <option value="Computer Unavailable">Computer Unavailable</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label id="reason-error" class="error" for="reason" ></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Optima/Casamba login ID<span class="required">*</span></label>
                                                <input type="text" name="optima_login_id" id="optima_login_id" class="form-control" autocomplete="off">
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
                                                        <option value="<?php echo @$pun_type['id']; ?>"><?php echo @$pun_type['punch_type_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                                </select>
                                                <label id="punch_type-error" class="error" for="punch_type"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="display: none;" id="punch_time">
                                            <div class="form-group">
                                                <label class="control-label">Punch Time <span class="required">*</span></label>
                                                <input type="text" name="punch_time" class="form-control timepicker-no-seconds" autocomplete="off">
                                                <label id="punch_time-error" class="error" for="punch_time"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="display: none;" id="lunch_minutes">
                                            <div class="form-group">
                                                <label class="control-label">Lunch Minutes <span class="required">*</span></label>
                                                <input type="text" name="lunch_minutes" class="form-control" autocomplete="off">
                                                <label id="lunch_minutes-error" class="error" for="lunch_minutes"></label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" style="margin-top: 16px;">Comments</label>
                                                <textarea name="comment_status" id="comment_status" class="form-control" autocomplete="off"></textarea>
                                                <label id="comment_status-error" class="error" for="comment_status"></label>
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
                                            <a href="" class="btn default">Cancel</a>
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




