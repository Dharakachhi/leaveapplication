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
                <span>Create User</span>
            </li>
            <li class="pull-right">
                <a href="<?php echo base_url('user-list'); ?>" class="btn btngreen"><i class="fa fa-long-arrow-left backbtn" aria-hidden="true"></i>Back</a>
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
                            <form action="<?php echo base_url('insert-user'); ?>" name="form_addaccount" method="post" class="horizontal-form" enctype="multipart/form-data">
                                <div class="form-body col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Type <span class="required">*</span>:</label>
                                            <select name="user_type" id="user_type" class="form-control select2">
                                                <option value="">Select Option</option>
                                                <option value="1">HR</option>
                                            </select>
                                            <label id="user_type-error" class="error" for="user_type" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="disciplineDiv" style="display: none;">
                                            <label class="control-label">Discipline <span class="required">*</span>:</label>
                                            <select name="discipline" id="discipline" class="form-control ">
                                                <option value="">Select Option</option>
                                                <?php if(!empty($hr_list)):
                                                    foreach(@$hr_list as $hrVal): ?>
                                                        <option value="<?php echo @$hrVal['id']; ?>"><?php echo @$hrVal['firstName']." ".@$hrVal['lastName']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <label id="discipline-error" class="error" for="discipline"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="hr_check_div" style="display: none;">
                                            <label class="control-label"></label>
                                            <div class="icheck-inline" style="margin-top: 12px;">
                                                <label>
                                                    <input type="checkbox" name="check_header[]"  id="check_header" class="icheck" data-radio="iradio_square-grey" value="1"> Leave Request  </label>
                                                <label>
                                                    <input type="checkbox" name="check_header[]"  id="check_header" class="icheck" data-radio="iradio_square-grey" value="0"> Time Adjustment Request </label>
                                            </div>
                                            <label id="check_header[]-error" class="error" for="check_header[]" style="display: none;"></label>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="form-body col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name <span class="required">*</span> :</label>
                                            <input type="text" name="firstName" maxlength="20" autocomplete="off" id="firstName" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name <span class="required">*</span>:</label>
                                            <input type="text" name="lastName" maxlength="20" autocomplete="off" id="lastName" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email <span class="required">*</span>:</label>
                                            <input type="email" name="user_email" autocomplete="off" id="user_email" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password <span class="required">*</span>:</label>
                                            <input type="password" name="user_password" id="user_password" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password <span class="required">*</span>:</label>
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone <span class="required">*</span>:</label>
                                            <input type="text" name="user_phone" id="user_phone" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Preferred Contact Method <span class="required">*</span>:</label>
                                            <select name="contact_method" id="contact_method" class="form-control select2">
                                                <option value="">Select Option</option>
                                                <option value="Phone">Phone</option>
                                                <option value="Message">Message</option>
                                                <option value="Email">Email</option>
                                            </select>
                                            <label id="contact_method-error" class="error" for="contact_method"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">State <span class="required">*</span>:</label>
                                            <select name="state" id="state" class="form-control select2">
                                                <option value="">Select Option</option>
                                                <?php if(!empty($state_list)):
                                                    foreach(@$state_list as $stateVal): ?>
                                                        <option value="<?php echo @$stateVal['id']; ?>"><?php echo @$stateVal['name']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <label id="state-error" class="error" for="state"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Facility <span class="required">*</span>:</label>
                                            <input type="text" name="facility" id="facility" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"></label>
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="user_status" class="icheck" data-radio="iradio_square-grey" value="1" checked=""> Active </label>
                                                <label>
                                                    <input type="radio" name="user_status" class="icheck" data-radio="iradio_square-grey" value="0"> In Active </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="accountbtn" class="btn btngreen frontbtn">Save</button>
                                            <a href="<?php echo base_url('user-list'); ?>" class="btn default">Cancel</a>
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