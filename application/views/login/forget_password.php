<!-- BEGIN LOGIN -->
    <div class="content">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>uploads/logo.png" alt="" /> 
        </a>
        <!-- BEGIN FORM-->
        <form action="<?php echo base_url('forgot-mail'); ?>" name="form_forgotpass" method="post" class="form-horizontal">
            <h3 class="form-title center">Forget Password ?</h3>
            <p class="center"> Enter your e-mail address below to reset your password. </p>
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-12 loginfont">Email:</label>
                    <div class="col-md-1">
                        <i class="fa fa-envelope login_icon" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-11">
                        <input type="email" name="user_email" autocomplete="off" id="user_email" class="form-control field_border" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <button type="submit" id="forgotpassbtn" class="btn btngreen frontbtn">Submit</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>