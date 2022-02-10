<!-- BEGIN LOGIN -->
    <div class="content">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>uploads/logo.png" alt="" /> 
        </a>
        <!-- BEGIN FORM-->
        <form action="<?php echo base_url('reset-change-password'); ?>" name="form_resetpass" method="post" class="form-horizontal">
            <h3 class="form-title center">Reset Password</h3>
            <div class="form-body">
                <input type="hidden" name="user_id" id="user_id" value="<?php echo @$user_id; ?>">
                <div class="form-group">
                    <label class="col-md-12 loginfont">Password:</label>
                    <div class="col-md-1">
                        <i class="fa fa-lock login_icon" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-11">
                        <input type="password" name="user_password" id="user_password" class="form-control field_border">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 loginfont">Confirm Password:</label>
                    <div class="col-md-1">
                        <i class="fa fa-lock login_icon" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-11">
                        <input type="password" name="user_confirm_password" id="user_confirm_password" class="form-control field_border">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <button type="submit" id="resetpassbtn" class="btn btngreen frontbtn">Submit</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>