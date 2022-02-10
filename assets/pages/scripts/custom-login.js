$(function() {
var hiddenurl = $('#hiddenURL').val();  
    
    /**
     *  Login Form
     */
    $("form[name='form_login']").validate({
        rules: {
            user_email: "required",
            user_password: "required"

        },
        messages: {
            user_email: "Please enter Email or Phone",
            user_password: "Please enter Password"
        },
        submitHandler: function(form) {
          form.submit();
          $("#frontloginbtn").attr("disabled", true);
        }
    });

    /**
     *  Create User
     */
     var url_email = hiddenurl+'login/check_duplicate_email';
    $("form[name='form_addaccount']").validate({
        rules: {
            firstName: "required",
            lastName: "required",
            user_email: {
                required: true,
                remote: {
                    url: url_email,
                    type: "post"
                }
            },
            user_password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: '#user_password'
            },
            user_type: "required"
        },
        messages: {
            firstName: "Please Enter First Name",
            lastName: "Please Enter First Name",
            user_email: {
                required: "Please enter Email",
                remote: "Email already exists!"
            },
            user_password: {
                required: "Please enter Password",
                minlength: "Your password must be at least 6 characters long"
            },
            confirm_password: {
                required: "Please enter Confirm Password",
                minlength: "Your confirm password must be at least 6 characters long",
                equalTo: "Password Not mach!"
            },
            user_type: "Please Check any one of this option"
        },
        submitHandler: function(form) {
          form.submit();
          $("#accountbtn").attr("disabled", true);
        }
    });

    /**
     *  Front Forgot password
     */
    $("form[name='form_forgotpass']").validate({
        rules: {
            user_email: "required"
        },
        messages: {
            user_email: "Please enter Email"
        },
        submitHandler: function(form) {
          form.submit();
          $("#forgotpassbtn").attr("disabled", true);
        }
    });

    /**
     *  Front Forgot password
     */
    $("form[name='form_resetpass']").validate({
        rules: {
            user_password: {
                required: true,
                minlength: 6
            },
            user_confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#user_password"
            }
        },
        messages: {
            user_password: {
                required: "Please enter Password",
                minlength: "Your password must be at least 6 characters long"
            },
            user_confirm_password: {
                required: "Please enter Confirm Password",
                minlength: "Your password must be at least 6 characters long",
                equalTo: "Password not match"
            }
        },
        submitHandler: function(form) {
          form.submit();
          $("#resetpassbtn").attr("disabled", true);
        }
    });

    /**
     * Number write only
     */
    $('.Number').keypress(function (evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 32 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    });

});