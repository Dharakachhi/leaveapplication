<!-- BEGIN LOGIN -->
<div class="content">
    <a href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url(); ?>uploads/logo.png" alt="" />
    </a>
    <!-- BEGIN FORM-->
    <form action="<?= base_url('check-frontlogin'); ?>" name="form_login" method="post" class="form-horizontal"
        autocomplete="off">
        <h3 class="form-title center">Log in</h3>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-12 loginfont">Email:</label>
                <div class="col-md-1">
                    <i class="fa fa-envelope login_icon" aria-hidden="true"></i>
                </div>
                <div class="col-md-11">
                    <input type="email" name="user_email" autocomplete="off" id="user_email" class="form-control"
                        placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 loginfont">Password:</label>
                <div class="col-md-1">
                    <i class="fa fa-lock login_icon" aria-hidden="true"></i>
                </div>
                <div class="col-md-11">
                    <input type="password" name="user_password" autocomplete="off" id="user_password"
                        class="form-control" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <a href="<?php echo base_url('forgot-password'); ?>" class="pull-right loginfont">Forget Password
                        ?</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <button type="submit" id="frontloginbtn" class="btn btngreen frontbtn">Log in</button>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- <div class="form-group">
                <div class="col-md-12 center">
                    <span class="loginfont">or</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <span class="loginfont"> You don't have an account yet? <a href="<?php echo base_url('create-user'); ?>" id="signuplink"><strong>Sign Up</strong></a></span>
                </div>
            </div> -->
        </div>
    </form>
    <!-- END FORM-->
</div>