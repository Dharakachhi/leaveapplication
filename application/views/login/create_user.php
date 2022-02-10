<!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN FORM-->
        <form action="<?php echo base_url('insert-user'); ?>" name="form_addaccount" method="post" class="form-horizontal">
            <h3 class="form-title center">Sign Up</h3>
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-12 loginfont">First Name <span class="required">*</span>:</label>
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <input type="text" name="firstName" maxlength="20" autocomplete="off" id="firstName" class="form-control field_border">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 loginfont">Last Name <span class="required">*</span>:</label>
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <input type="text" name="lastName" maxlength="20" autocomplete="off" id="lastName" class="form-control field_border">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 loginfont">Email <span class="required">*</span>:</label>
                    <div class="col-md-1">
                        <i class="fa fa-envelope login_icon" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-11">
                        <input type="email" name="user_email" autocomplete="off" id="user_email" class="form-control field_border">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 loginfont">Password <span class="required">*</span>:</label>
                    <div class="col-md-1">
                        <i class="fa fa-lock login_icon" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-11">
                        <input type="password" name="user_password" id="user_password" class="form-control field_border">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 loginfont">Confirm Password <span class="required">*</span>:</label>
                    <div class="col-md-1">
                        <i class="fa fa-lock login_icon" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-11">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control field_border">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 loginfont">Type <span class="required">*</span>:</label>
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="icheck-inline">
                            <label>
                                <input type="radio" name="user_type" class="icheck" data-radio="iradio_square-grey" value="1"> HR </label>
                            <label>
                                <input type="radio" name="user_type" class="icheck" data-radio="iradio_square-grey" value="2"> User </label>
                            <br><label id="user_type-error" class="error" for="user_type"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group"></div>
                <div class="form-group"></div>
                <div class="form-group">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <button type="submit" id="accountbtn" class="btn green frontbtn">Sign Up</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>

<script type="text/javascript">
    $(function(){
        $('.select2').select2();
    });
</script>