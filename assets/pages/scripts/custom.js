$(function() {
    var hiddenurl = $('#hiddenURL').val();


    /**
     * start
     * refresh datatable
     */

    var pw_user_Id = $('#pw_user_Id').val();
    if (pw_user_Id != '') {
        var url_password = hiddenurl + "profile/check_password/" + pw_user_Id;
    } else {
        var url_password = hiddenurl + "profile/check_password";
    }
    var url_pass = hiddenurl + "profile/check_duplicate_email_edit/" + pw_user_Id;
    $("form[name='change_password_form']").validate({
        rules: {
            old_password: {
                required: true,
                remote: {
                    url: url_password,
                    type: "post",
                    data: {
                        old_password: function() {
                            return $("#old_password").val();
                        }
                    }
                }
            },
            new_password: {
                required: true,
                minlength: 6,
                remote: {
                    url: url_pass,
                    type: "post",
                    data: {
                        pw_user_email: function() {
                            return $("#pw_user_email").val();
                        }
                    }
                }
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: '#new_password'
            }
        },
        messages: {
            old_password: {
                required: "Please enter Old Password",
                remote: "The Old password is incorrect."
            },
            new_password: {
                required: "Please enter New Password",
                minlength: "Your password must be at least 6 characters long",
                remote: "Password already exists for this Email ID"
            },
            confirm_password: {
                required: "Please enter Confirm Password",
                minlength: "Your confirm password must be at least 6 characters long",
                equalTo: "Password Not mach!"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $("#changepasswordbtn").attr("disabled", true);
        }
    });

    /**
     * start
     * refresh datatable
     */

    $(document).delegate("#clear_filter", "click", function() {
        $.ajax({
            type: 'POST',
            url: hiddenurl + 'Punchform/refresh_datatable',
            success: function(response) {
                $('.se-pre-con').fadeOut();
                $('#filter_punch_list').html(response);
                $('#search_response_status').val('').trigger('change.select2');
                $('#search_employee_name').val("");
                $('#search_facility_name').val("");
                $('#facility_sup').val('').trigger('change.select2');
                // $('#facility').val("");
                $('#from__punch').val("");
                $('#to__punch').val("");
            }
        });

    });

    /**
     * End
     *refresh datatable
     */
    /**
     * start
     * On Submit update response-status in modal popup
     */
    $(document).delegate("#submit", "click", function() {
        var punchId = $('#punchId').val();
        var response_status = $('#response_status option:selected').val();

        var search_response_status = $('#search_response_status option:selected').val();
        var search_employee_name = $('#search_employee_name').val();
        var facility_name = $('#search_facility_name').val();
        var facility = $('#facility').val();
        var from__punch = $('#from__punch').val();
        var to__punch = $('#to__punch').val();

        $.ajax({
            type: 'POST',
            url: hiddenurl + 'Punchform/update_response_Status',
            data: { punchId: punchId, response_status: response_status, search_response_status: search_response_status, facility: facility, search_employee_name: search_employee_name, from__punch: from__punch, to__punch: to__punch, facility_name: facility_name },
            success: function(response) {
                if (response == 'error') {
                    $("#message_error").fadeIn("slow").html("Punch Request Failed");
                    setTimeout(function() {
                        $("#message_error").fadeOut("slow");
                    }, 2000);
                } else {

                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });

                    $('#filter_punch_list').html(response);
                    $("#message").fadeIn("slow").html("Punch Requested Submitted Successfully");
                    setTimeout(function() {
                        $("#message").fadeOut("slow");
                    }, 2000);

                }
            }
        });

    });
    /**
     * End
     * On Submit update response-status in modal popup
     */

    /**
     * Select Reason : Other -- start
     * Then Field Comment Status is Required
     */

    $('#reason').on('change', function() {
        var reason = $('#reason option:selected').text();
        if (reason == 'Other') {
            $("#comment_status").prop('required', true);
        } else {
            $("#comment_status").prop('required', false);
        }
    });
    /**
     * Select Reason : Other -- end
     */

    /* Datatable for punch table list*/

    /**
     * Simple Datatable
     */
    $('.punch_datatable').DataTable({
        "lengthMenu": [
            [10, 50, 75, 100, 150],
            [10, 50, 75, 100, 150]
        ],
        "paging": true,
        "order": [
            [0, "desc"]
        ],
        "columnDefs": [{
            "targets": [0],
            "visible": false
        }]
    });

    /*end datatable */

    /**
     * punch type on change
     * Punch Typw If IN or OUT punch time is show
     * Punch Type is if Lunch or any Lunch time is show
     */
    $('#punch_type').on('change', function() {
        var punch_type1 = $('#punch_type option:selected').text();
        if (punch_type1 == "IN" || punch_type1 == "OUT") {
            $("#punch_time").show();
            $("#lunch_minutes").hide();
        } else if (punch_type1 == "LUNCH") {
            $("#lunch_minutes").show();
            $("#punch_time").hide();
        } else if (punch_type1 == "Select Option") {
            $("#punch_time").hide();
            $("#lunch_minutes").hide();
        } else {
            $("#punch_time").hide();
            $("#lunch_minutes").show();
        }

    });
    /**
     * Punch Email Template Page js
     */

    /**
     * On change template name load Content
     */
    $('#punch_template_name').on('change', function() {
        var templateId = $(this).val();
        if (templateId != '') {
            $.ajax({
                type: 'POST',
                url: hiddenurl + 'PunchEmailtemplate/get_template_content',
                data: { templateId: templateId },
                success: function(response) {
                    var message = $.parseJSON(response);
                    $('#template_content').summernote('code', message.text);
                    $('#email_subject').val(message.subject);
                }
            });
        } else {
            $('#template_content').summernote("code", '');
            $('#email_subject').val('');
        }
    });
    /**
     * discipline
     * Change Active Status of discipline
     */
    $('.punch_type_active').on('click', function() {
        var status = $(this).data('status');
        var typeId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + '/punchtype/change_punch_type',
            data: { status: status, typeId: typeId },
            dataType: 'HTML',
            success: function(response) {
                if (response == 'update') {
                    $("#message").fadeIn("slow").html("Punch type status Update successfully");
                    setTimeout(function() {
                        $("#message").fadeOut("slow");
                        location.reload();
                    }, 2000);
                } else {
                    $("#message_error").fadeIn("slow").html("Punch type Status Update Failed");
                    setTimeout(function() {
                        $("#message_error").fadeOut("slow");
                        location.reload();
                    }, 2000);
                }
            }
        });
    });

    /*discipline start*/
    var type_id = $('#type_id').val();
    if (type_id != '') {
        var url_punchtype = hiddenurl + "punchtype/dublicate_type/" + type_id;
    } else {
        var url_punchtype = hiddenurl + "punchtype/dublicate_type";
    }
    $("form[name='form_add_punchtype']").validate({
        rules: {
            punch_type_name: {
                required: true,
                remote: {
                    url: url_punchtype,
                    type: "post",
                    data: {
                        punch_type_name: function() {
                            return $("#punch_type_name").val();
                        }
                    }
                }
            },
            order_by: {
                number: true
            },
            punchtype_status: "required"
        },
        messages: {
            punch_type_name: {
                required: "Please enter Punch Type",
                remote: "Discipline Name already exists!"
            },
            order_by: {
                number: "only Number allow"
            },
            punchtype_status: "This Field is required"
        },
        submitHandler: function(form) {
            form.submit();
            $("#accountbtn").attr("disabled", true);
        }
    });
    /*discipline end*/

    /**
     * discipline
     * Change Active Status of discipline
     */
    $('.discipline_active').on('click', function() {
        var status = $(this).data('status');
        var statusId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + '/discipline/change_discipline_status',
            data: { status: status, statusId: statusId },
            dataType: 'HTML',
            success: function(response) {
                if (response == 'update') {
                    $("#message").fadeIn("slow").html("Discipline status Update sucessfully");
                    setTimeout(function() {
                        $("#message").fadeOut("slow");
                        location.reload();
                    }, 2000);
                } else {
                    $("#message_error").fadeIn("slow").html("Discipline Status Update Failed");
                    setTimeout(function() {
                        $("#message_error").fadeOut("slow");
                        location.reload();
                    }, 2000);
                }
            }
        });
    });
    /*discipline start*/
    var discipline_id = $('#discipline_id').val();
    if (discipline_id != '') {
        var url_discipline = hiddenurl + "discipline/dublicate_discipline_status/" + discipline_id;
    } else {
        var url_discipline = hiddenurl + "discipline/dublicate_discipline_status";
    }
    $("form[name='form_add_discipline']").validate({
        rules: {
            discipline_name: {
                required: true,
                remote: {
                    url: url_discipline,
                    type: "post",
                    data: {
                        discipline_name: function() {
                            return $("#discipline_name").val();
                        }
                    }
                }
            },
            order_by: {
                number: true
            },
            discipline_status: "required"
        },
        messages: {
            discipline_name: {
                required: "Please enter Discipline Name",
                remote: "Discipline Name already exists!"
            },
            order_by: {
                number: "only Number allow"
            },
            discipline_status: "This Field is required"
        },
        submitHandler: function(form) {
            form.submit();
            $("#accountbtn").attr("disabled", true);
        }
    });
    /*discipline end*/
    /**
     * punch status
     * Change Active Status of Punch status
     */
    $('.punch_status_active').on('click', function() {
        var status = $(this).data('status');
        var statusId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + '/punchstatus/change_punch_status',
            data: { status: status, statusId: statusId },
            dataType: 'HTML',
            success: function(response) {
                if (response == 'update') {
                    $("#message").fadeIn("slow").html("Punch Status Updated Successfully.");
                    setTimeout(function() {
                        $("#message").fadeOut("slow");
                        location.reload();
                    }, 2000);
                } else {
                    $("#message_error").fadeIn("slow").html("Punch Status Update Failed");
                    setTimeout(function() {
                        $("#message_error").fadeOut("slow");
                        location.reload();
                    }, 2000);
                }
            }
        });
    });
    /*punch status start*/
    var status_id = $('#status_id').val();
    if (status_id != '') {
        var url_punchstatus = hiddenurl + "punchstatus/dublicate_status/" + status_id;
    } else {
        var url_punchstatus = hiddenurl + "punchstatus/dublicate_status";
    }
    $("form[name='form_add_punchstatus']").validate({
        rules: {
            punch_status_name: {
                required: true,
                remote: {
                    url: url_punchstatus,
                    type: "post",
                    data: {
                        punch_status_name: function() {
                            return $("#punch_status_name").val();
                        }
                    }
                }
            },
            order_by: {
                number: true
            },
            punch_status: "required"
        },
        messages: {
            punch_status_name: {
                required: "Please enter Punch Status",
                remote: "Punch Status already exists!"
            },
            order_by: {
                number: "only Number allow"
            },
            punch_status: "This Field is required"
        },
        submitHandler: function(form) {
            form.submit();
            $("#accountbtn").attr("disabled", true);
        }
    });
    /*punch status end*/

    /**
     * User Master js
     * Change Active Status of Leave Master
     */
    $(document).delegate(".sup_status", "click", function() {
        var status = $(this).data('status');
        var supId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + '/supervisor/change_sup_status',
            data: { status: status, supId: supId },
            dataType: 'HTML',
            success: function(response) {
                if (response == 'update') {
                    $("#message").fadeIn("slow").html("Supervisor Status Updated Successfully");
                    setTimeout(function() {
                        $("#message").fadeOut("slow");
                        location.reload();
                    }, 2000);
                } else {
                    $("#message_error").fadeIn("slow").html("Supervisor Status Update Failed");
                    setTimeout(function() {
                        $("#message_error").fadeOut("slow");
                        location.reload();
                    }, 2000);
                }
            }
        });
    });

    /**
     *  Create User
     */
    var url_email = hiddenurl + "supervisor/check_duplicate_email";
    $("form[name='form_add_supervisor']").validate({
        rules: {
            facility_name: "required",
            rehab_director: "required",
            supervisor_email: {
                required: true,
                remote: {
                    url: url_email,
                    type: "post",
                    data: {
                        supervisor_password: function() {
                            return $("#sup_password").val();
                        },

                    }
                }
            },
            sup_password: {
                required: true,
                minlength: 6,
                remote: {
                    url: url_email,
                    type: "post",
                    data: {
                        supervisor_email: function() {
                            return $("#sup_email").val();
                        },

                    }
                }

            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: '#sup_password'
            }
        },
        messages: {
            facility_name: "Please Enter Name",
            rehab_director: "Please Enter supervisor Name",
            supervisor_email: {
                required: "Please enter Email",
                remote: "Password already exists for this Email ID"
            },
            sup_password: {
                required: "Please enter Password",
                minlength: "Your password must be at least 6 characters long",
                remote: "Password already exists for this Email ID"
            },
            confirm_password: {
                required: "Please enter Confirm Password",
                minlength: "Your confirm password must be at least 6 characters long",
                equalTo: "Password Not mach!"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $("#accountbtn").attr("disabled", true);
        }
    });

    /**
     *  Create Supervior email
     */
    var supId = $('#sup_id').val();
    var url_email11 = hiddenurl + "supervisor/check_duplicate_email_edit/" + supId;
    $("form[name='form_edit_supervisor']").validate({
        rules: {
            facility_name: "required",
            rehab_director: "required",
            supervisor_email: {
                required: true,
                remote: {
                    url: url_email11,
                    type: "post",
                    data: {
                        supervisor_password: function() {
                            return $("#sup_password").val();
                        },

                    }
                }
            },
            password_sup: {
                // required: true,
                minlength: 6,
                remote: {
                    url: url_email11,
                    type: "post",
                    data: {
                        supervisor_email: function() {
                            return $("#sup_email").val();
                        },

                    }
                }

            }
        },
        messages: {
            facility_name: "Please Enter Name",
            rehab_director: "Please Enter supervisor Name",
            supervisor_email: {
                required: "Please enter Email",
                remote: "Password already exists for this Email ID"
            },
            password_sup: {
                /*required: "Please enter Password",*/
                minlength: "Your password must be at least 6 characters long",
                remote: "Password already exists for this Email ID"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $("#accountbtn").attr("disabled", true);
        }
    });

    /**
     * Search Punch Page
     * After Filter
     */
    $('#search_employee_name, #from__punch, #to__punch, #search_response_status,#facility_sup,#search_facility_name').on('change', function() {
        $('.se-pre-con').fadeIn();
        var search_employee_name = $('#search_employee_name').val();
        var fromDate = $('#from__punch').val();
        var toDate = $('#to__punch').val();
        var search_response_status = $('#search_response_status').val();
        var facility = $('#facility_sup').val();
        var facility_name = $('#search_facility_name').val();
        $.ajax({
            type: 'POST',
            url: hiddenurl + 'punchform/get_punch_list',
            data: { search_employee_name: search_employee_name, fromDate: fromDate, toDate: toDate, search_response_status: search_response_status, facility: facility, facility_name: facility_name },
            success: function(response) {
                $('.se-pre-con').fadeOut();
                $('#filter_punch_list').html(response);
                var leaveDetail = '<div class="col-md-12"><p class="leave_lable" style="text-align: center;">No data Found.</p></div>';
            }
        });
    });


    $(document).delegate('.punchForm', 'click', function() {
        $('.se-pre-con').fadeIn();
        var punchId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + 'punchform/get_punch_detail',
            data: { punchId: punchId },
            success: function(response) {
                $('.se-pre-con').fadeOut();

                $('.modal-content').html(response);

            }
        });
    });

    /**
     *  Punch Form
     */
    $("form[name='form_sup_profile']").validate({
        rules: {
            facility_name: "required",
            rehab_director: "required"
        },
        messages: {
            facility_name: 'Please Enter Facility name',
            rehab_director: 'Please Enter Supervisor Name'

        },
        submitHandler: function(form) {
            form.submit();
            $("#profilebtn").attr("disabled", true);
        }
    });

    // $.validator.addMethod("IsEmail_punch", function (email) {
    //   var regex12 = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([co]{2,2})+$/;

    //   if(!regex12.test(email)) {
    //     console.log('.co');
    //     console.log(regex12.test(email));
    //     var regex1 = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    //     if(!regex1.test(email)) {
    //       console.log(regex1.test(email));
    //       return true;
    //     }else{
    //       console.log(regex1.test(email));
    //       return false;
    //     }
    //   }else{
    //     console.log('gmail.com');
    //     var regex1 = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    //     if(!regex1.test(email)) {
    //       console.log(regex1.test(email));
    //       return true;
    //     }else{
    //       console.log(regex1.test(email));
    //       return false;
    //     }
    //   }
    // });
    $.validator.addMethod("IsEmail_punch", function(email) {
        var regex12 = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([co]{2,2})+$/;

        if (regex12.test(email)) {
            return false;
        } else {
            var regex13 = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (regex13.test(email)) {
                return true;
            } else {
                return false;
            }
        }
    });



    /**
     *  Punch Form
     */
    $("form[name='form_punchForm']").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: 15,
                lettersonly: true

            },
            last_name: {
                required: true,
                maxlength: 15
            },
            email_id: {
                required: true,
                IsEmail_punch: true
            },
            ssn: {
                required: true,
                minlength: 4,
                maxlength: 4,
                number: true
            },
            discipline: "required",
            facility: "required",
            date: "required",
            punch_status: "required",
            punch_type: "required",
            response_status: "required",
            reason: "required",
            punch_time: {
                required: true
            },
            lunch_minutes: {
                required: true,
                number: true,
                maxlength: 3
            },
            optima_login_id: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: 'Please Enter First Name',
                lettersonly: 'Letters Only please'
            },
            last_name: {
                required: 'Please Enter Last Name'
            },
            email_id: {
                required: 'Please Enter Email Id',
                IsEmail_punch: 'Please Enter Valid Email Id'
            },
            ssn: {
                required: 'Please Enter ssn',
                minlength: 'Enter only 4 Digits',
                maxlength: 'Enter only 4 Digits',
                mlength: 'Enter only 4 Digits',
                number: 'Only Digits Allow'
            },
            discipline: "Please Select Option",
            facility: "Please Select Option",
            date: "Please Select Date",
            punch_status: "Please Select Option",
            punch_type: "Please Select Option",
            response_status: "Please Select Option",
            reason: "Please Select Option",
            punch_time: {
                required: "Please Enter Punch Time"
            },
            lunch_minutes: {
                required: "Please Enter Lunch Time",
                number: "Please Enter Only Number",
                maxlength: 'Enter only 3 Digits',
            },
            optima_login_id: {
                required: "Please Enter Optima Login Id"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $("#punch_submit").attr("disabled", true);
        }
    });

    /**
     *  Create User
     */
    var userId = $('#user_id').val();
    if (userId != '') {
        var url_email = hiddenurl + "user/check_duplicate_email/" + userId;
    } else {
        var url_email = hiddenurl + "user/check_duplicate_email";
    }
    $("form[name='form_addaccount']").validate({
        rules: {
            'check_header[]': {
                required: true
            },
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
            user_type: "required",
            user_phone: "required",
            contact_method: "required",
            state: "required",
            facility: "required"
        },
        messages: {
            'check_header[]': {
                required: "You must check at least 1 box"
            },
            firstName: "Please Enter First Name",
            lastName: "Please Enter Last Name",
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
            user_type: "Please Select User Type",
            user_phone: "Please enter Phone Number",
            contact_method: "Please Select Preferred Contact Method",
            state: "Please Select State",
            facility: "Please enter Facility"
        },
        submitHandler: function(form) {
            form.submit();
            $("#accountbtn").attr("disabled", true);
        }
    });

    /**
     *  Profile Form
     */
    var userId = $('#userId').val();
    var profile_email = hiddenurl + "profile/check_duplicate_email/" + userId;
    $("form[name='form_profile']").validate({
        rules: {
            first_name: 'required',
            last_name: 'required',
            user_email: {
                required: true,
                remote: {
                    url: profile_email,
                    type: "post"
                }
            }
        },
        messages: {
            first_name: 'Please Enter First Name',
            last_name: 'Please Enter Last Name',
            user_email: {
                required: "Please enter Email",
                remote: "Email Already exists."
            }
        },
        submitHandler: function(form) {
            form.submit();
            $("#profilebtn").attr("disabled", true);
        }
    });

    /**
     *  Leave Master Form
     */
    var leave_id = $('#leave_id').val();
    if (leave_id != '') {
        var addLeave = hiddenurl + "leavemaster/check_duplicate/" + leave_id;
    } else {
        var addLeave = hiddenurl + "leavemaster/check_duplicate";
    }
    $("form[name='form_addleaveType']").validate({
        rules: {
            leave_name: {
                required: true,
                remote: {
                    url: addLeave,
                    type: "post"
                }
            },
            email_labelal: {
                requiredIfCheckedal: true,
                email: true
            },
            email_labelmz: {
                requiredIfCheckedmz: true,
                email: true
            }
        },
        messages: {
            leave_name: {
                required: "Please enter Leave Name",
                remote: "Leave Name Already exists."
            },
            order_by: {
                number: "Please Enter Number only"
            },
            email_labelal: {
                IsEmail: 'Please Enter Valid Email Id'
            },
            email_labelmz: {
                IsEmail: 'Please Enter Valid Email Id'
            }
        },
        submitHandler: function(form) {
            form.submit();
            $("#leaveTypebtn").attr("disabled", true);
        }
    });

    $.validator.addMethod("requiredIfCheckedal", function(val, ele, arg) {
        if ($("#email_checkbox").prop("checked") == true && $('#email_labelal').val() == '') { return false; }
        return true;
    }, "Please Enter Email");
    $.validator.addMethod("requiredIfCheckedmz", function(val, ele, arg) {
        if ($("#email_checkbox").prop("checked") == true && $('#email_labelmz').val() == '') { return false; }
        return true;
    }, "Please Enter Email");

    $('#email_checkbox').on('change', function() {
        if ($(this).prop('checked') == true) {
            $('#hremail').show();
        } else {
            $('#hremail').hide();
        }
    });

    /**
     *  Leave Question Form
     */
    var questionId = $('#question_id').val();
    if (questionId != '') {
        var leaveQuestion = hiddenurl + "leavequestion/check_duplicate_question/" + questionId;
    } else {
        var leaveQuestion = hiddenurl + "leavequestion/check_duplicate_question";
    }
    $("form[name='form_leavequestion']").validate({
        rules: {
            question_name: {
                required: true,
                remote: {
                    url: leaveQuestion,
                    type: "post",
                    data: { 'parent_leave_id': function() { return $('#parent_leave_id').val() } },
                    async: false
                }
            },
            parent_leave: {
                required: true,
                remote: {
                    url: leaveQuestion,
                    type: "post",
                    data: { 'question_name': function() { return $('#question_name').val() } },
                    async: false
                }
            },
            input_lable_order: {
                number: true
            }
        },
        messages: {
            question_name: {
                required: "Please enter Leave Question.",
                remote: "Leave Name Already exists."
            },
            parent_leave: "Please Select Option",
            input_lable_order: {
                number: "Please Enter Number only"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $("#leaveQuestionbtn").attr("disabled", true);
        }
    });

    /**
     *  Leave Form
     */
    $("form[name='form_leaveForm']").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: 15,
                lettersonly: true

            },
            last_name: {
                required: true,
                maxlength: 15
            },
            contact_number: {
                required: true,
                minlength: 10,
                maxlength: 15
            },
            email_id: {
                required: true,
                IsEmail: true
            },
            state: 'required',
            contact_method: 'required',
            facility: 'required',
            leave_reason: 'required',
            last_day_work: 'required',
            return_date: 'required',
            // return_date: {
            //   requiredIfChecked: true
            // },
            date_flexible: 'required',
            discipline: 'required',
            // employee_signature: 'required',
            // signed_date: 'required',
            // superviser_signature: 'required',
            // superviser_sign_date: 'required',
            people: 'required',
            sup_date: 'required',
            discussed_supervisor: 'required',
            comment_status: 'required'
        },
        messages: {
            first_name: {
                required: 'Please Enter First Name',
                lettersonly: 'Letters Only please'

            },
            last_name: {
                required: 'Please Enter Last Name'
            },
            contact_number: {
                required: 'Please Enter Contact Number',
                minlength: 'Your Contact number must be at least 10 digits long',
                maxlength: 'Your Contact number not more than 15 digits'
            },
            email_id: {
                required: 'Please Enter Email Id',
                IsEmail: 'Please Enter Valid Email Id'
            },
            state: 'Please Select State',
            contact_method: 'Please Select Contact Method',
            facility: 'Please Enter Facility',
            leave_reason: 'Please Select Leave Reason',
            last_day_work: 'Please Choose Last Day of Work',
            date_flexible: 'Please Select Option',
            discipline: 'Please Select Option',
            return_date: 'Please Select Return Date',
            // employee_signature: 'Please Select Option',
            // signed_date: 'Please Select Employee Signed Date',
            // superviser_signature: 'Please Select Option',
            // superviser_sign_date: 'Please Select Date Supervisor Approved',
            discussed_supervisor: 'please check if you discussed your leave with your supervisor',
            people: 'Please Select Option',
            sup_date: 'Please choose date when you were first notified',
            comment_status: 'Please Enter Comment for Leave'
        },
        submitHandler: function(form) {
            form.submit();
            $("#leaveFormbtn").attr("disabled", true);
        }
    });

    $.validator.addMethod("IsEmail", function(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    });

    // $.validator.addMethod("requiredIfChecked", function (val, ele, arg) {
    //     if ($("#tbd").prop("checked") == true && $('#return_date').val() == '') { return true; }
    //     if ($("#tbd").prop("checked") == false && $('#return_date').val() != '') { return true; }
    //     return false;
    // }, "Please Enter Expected Return Date Or Check TBD");

    /**
     *  Email Template
     */
    $("form[name='form_addtemplate']").validate({
        rules: {
            template_name: 'required'
        },
        messages: {
            template_name: 'Please Select Email Template'
        },
        submitHandler: function(form) {
            form.submit();
            $("#templatebtn").attr("disabled", true);
        }
    });

    /**
     * Simple Datatable
     */
    $('.common_datatable').DataTable({
        "lengthMenu": [
            [10, 50, 75, 100, 150],
            [10, 50, 75, 100, 150]
        ],
        "paging": true
            //   "columnDefs": [
            //     {
            //         "targets": [ 0 ],
            //         "visible": false
            //     }
            // ]
    });

    /**
     * Simple Datatable
     */
    $('.leave_datatable').DataTable({
        "lengthMenu": [
            [10, 50, 75, 100, 150],
            [10, 50, 75, 100, 150]
        ],
        "paging": true,
        // "order": [[ 0, "desc"]],
        "columnDefs": [{
            "targets": [0],
            "visible": false
        }]
    });

    $('.leave_search_datatable').DataTable({
        "lengthMenu": [
            [10, 50, 75, 100, 150],
            [10, 50, 75, 100, 150]
        ],
        "paging": true,
        "searching": false
    });

    $('.select2').select2();

    $(".fieldDate").datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $(".fieldDate1").datepicker({
        autoclose: true,
        endDate: 'today',
        todayHighlight: true
    });

    var date = new Date();
    date.setDate(date.getDate());

    $('.fieldStartDate').datepicker({
        startDate: date
    });

    /**
     * User Master js
     * Change Active Status of Leave Master
     */
    $('.user_status').on('click', function() {
        var status = $(this).data('status');
        var userId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + '/user/change_user_status',
            data: { status: status, userId: userId },
            dataType: 'HTML',
            success: function(response) {
                if (response == 'update') {
                    $("#message").fadeIn("slow").html("User Status Updated Successfully");
                    setTimeout(function() {
                        $("#message").fadeOut("slow");
                        location.reload();
                    }, 2000);
                } else {
                    $("#message_error").fadeIn("slow").html("User Status Update Failed");
                    setTimeout(function() {
                        $("#message_error").fadeOut("slow");
                        location.reload();
                    }, 2000);
                }
            }
        });
    });

    /**
     * Leave Type Master js
     * Change Active Status of Leave Master
     */
    $('.leave_status').on('click', function() {
        var status = $(this).data('status');
        var leaveId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + '/leavemaster/change_leave_status',
            data: { status: status, leaveId: leaveId },
            dataType: 'HTML',
            success: function(response) {
                if (response == 'update') {
                    $("#message").fadeIn("slow").html("Leave Status Updated Successfully");
                    setTimeout(function() {
                        $("#message").fadeOut("slow");
                        location.reload();
                    }, 2000);
                } else {
                    $("#message_error").fadeIn("slow").html("Leave Status Update Failed");
                    setTimeout(function() {
                        $("#message_error").fadeOut("slow");
                        location.reload();
                    }, 2000);
                }
            }
        });
    });

    /**
     * Leave Type Master js end
     */

    /**
     * Change Active Status of Leave Question
     */
    // $('.question_status').on('click', function(){
    $(document).delegate('.question_status', 'click', function() {
        var status = $(this).data('status');
        var leaveId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + '/leavequestion/change_leave_status',
            data: { status: status, leaveId: leaveId },
            dataType: 'HTML',
            success: function(response) {
                if (response == 'update') {
                    $("#message").fadeIn("slow").html("Leave Question Status Updated Successfully");
                    setTimeout(function() {
                        $("#message").fadeOut("slow");
                        location.reload();
                    }, 2000);
                } else {
                    $("#message_error").fadeIn("slow").html("Leave Question Status Update Failed");
                    setTimeout(function() {
                        $("#message_error").fadeOut("slow");
                        location.reload();
                    }, 2000);
                }
            }
        });
    });

    /**
     * Leave Question Master js
     * On change Input type enable or disable div
     */
    $('.inputType').on('change', function() {
        var Type = $(this).val();
        if (Type == 'Checkbox' || Type == 'Dropdown') {
            $('#input_lable_div').css('display', 'block');
        } else {
            $('#input_lable_div').css('display', 'none');
        }
    });

    /**
     * Add Input field Lable in table
     */
    $('#addInputLable').on('click', function() {
        var lable = $('#input_lable').val();
        var order = $('#input_lable_order').val();

        $('#input_lable-error').html('');
        $('#input_lable_order-error').html('');
        if (lable != '' && order != '') {
            var rowCount = $('#tbl_input_lable tr').length;
            if (rowCount == 1) {
                $('#tbl_input_lable').show();
            }

            var noData = $('#tbl_input_lable tbody tr td').text();
            if (noData == 'No data available in table') {
                $('#tbl_input_lable tbody').html('');
            }

            var tableRow = '<tr>';
            tableRow += '<td><input type="hidden" name="lable_name[]" value="' + lable + '">' + lable + '</td>';
            tableRow += '<td><input type="hidden" name="lable_order[]" value="' + order + '">' + order + '</td>';
            tableRow += '<td><a class="removeInputLable">Remove</a></td></tr>';

            $('#tbl_input_lable').append(tableRow);
            $('#input_lable').val('');
            $('#input_lable_order').val('');

        } else if (lable == '') {
            $('#input_lable-error').html('Please enter Lable.');
        } else if (order == '') {
            $('#input_lable_order-error').html('Please enter Lable Order.');
        }

    });

    /**
     * Remove data From table
     */
    $(document).delegate('.removeInputLable', 'click', function() {
        $(this).closest('tr').remove();
        var rowCount = $('#tbl_input_lable tr').length;
        var tableRow = '<tr><td colspan="3" style="text-align: center;">No data available in table</td></tr>';
        if (rowCount == 1) {
            $('#tbl_input_lable').append(tableRow);
        }

    });

    /**
     * on check Sub Question Parent leave dropdown enable
     */
    $('#is_subquestion').on('change', function() {
        if ($(this).prop("checked") == true) {
            $('#related_question').attr("disabled", false);
            $('#related_question').attr("required", true);
        } else {
            $('#related_question').attr("disabled", true);
            $('#related_question').attr("required", false);
        }
    });

    $(document).delegate('#related_question', 'change', function() {
        // $('#related_question').on('change', function(){
        $('.se-pre-con').fadeIn();
        var leaveId = $(this).val();
        var Type = $(this).children(":selected").attr("id");
        if (leaveId != '' && (Type == 'Checkbox' || Type == 'Dropdown')) {
            $.ajax({
                type: 'POST',
                url: hiddenurl + 'leavequestion/get_question_sub_option',
                data: { leaveId: leaveId },
                success: function(response) {
                    $('.se-pre-con').fadeOut();
                    $('#question_option').show();
                    $('#question_option').html(response);
                    $('#related_question_option').attr("required", true);
                    $('#related_question_option').select2();
                }
            });
        } else {
            $('.se-pre-con').fadeOut();
            $('#question_option').hide();
            $('#question_option').html('');
        }
    });

    /**
     * on change Parent Leave event
     */
    $('#parent_leave').on('change', function() {
        $('.se-pre-con').fadeIn();
        var leaveID = $(this).val();
        var questionId = $(this).data('id');
        var question_name = $('#question_name').val();
        if ($('#is_subquestion').prop("checked") == true) {
            var isSubquestion = '1';
            var status = '';
        } else {
            var isSubquestion = '0';
            var status = 'disabled';
        }
        if (leaveID != '') {
            $.ajax({
                type: 'POST',
                url: hiddenurl + 'leavequestion/get_leave_question',
                data: { leaveID: leaveID, isSubquestion: isSubquestion, questionId: questionId },
                success: function(response) {
                    $('.se-pre-con').fadeOut();
                    $('#relatedQuestion').html(response);
                    $('#related_question').select2();
                    $('#parent_leave_id').val(leaveID);
                }
            });
        } else {
            $('.se-pre-con').fadeOut();
            var optionList = '<select name="related_question" id="related_question" class="form-control select2"' + status + '><option id="0" value="">Select Related Question</option></select><label id="related_question-error" class="error" for="related_question"></label>';
            $('#relatedQuestion').html(optionList);
            $('#related_question').select2();
            $('#parent_leave_id').val('0');
        }
    });

    /**
     * Leave Question Master js end
     */

    /**
     * Leave Form js
     * Leave Reason Dropdown on change get data
     */
    $('#leave_reason').on('change', function() {
        var leaveID = $(this).val();
        if (leaveID != '') {
            $.ajax({
                type: 'POST',
                url: hiddenurl + 'leaveformfront/get_leave_question',
                data: { leaveID: leaveID },
                success: function(response) {
                    $('#leave_question_list').html(response);
                }
            });
        } else {
            $('#leave_question_list').html('');
        }
    });

    /**
     * Check Box on Check event
     */
    $(document).delegate('.checkboxEvent', 'click', function() {
        var questionId = $(this).val();
        var typeId = $(this).data('id');
        if (questionId != '0') {
            $.ajax({
                type: 'POST',
                url: hiddenurl + 'leaveformfront/get_leave_sub_question',
                data: { questionId: questionId, typeId: typeId },
                success: function(response) {
                    $('#checkboxDiv').html(response);
                    $('#checkboxDiv').show();
                }
            });
        } else {
            $('#checkboxDiv').html('');
            $('#checkboxDiv').hide();
        }
    });

    /**
     * DropDown on Change event
     */
    $(document).delegate('.dropdownEvent', 'change', function() {
        var questionId = $(this).val();
        var typeId = $(this).data('id');
        if (questionId != '') {
            $.ajax({
                type: 'POST',
                url: hiddenurl + 'leaveformfront/get_leave_sub_question',
                data: { questionId: questionId, typeId: typeId },
                success: function(response) {
                    $('#dropdownDiv').html(response);
                    $('#dropdownDiv').show();
                }
            });
        } else {
            $('#dropdownDiv').html('');
            $('#dropdownDiv').hide();
        }
    });

    /**
     * Text Change event
     */
    $(document).delegate('.textEvent', 'change', function() {
        var question = $(this).val();
        var questionId = '0';
        var typeId = $(this).data('id');
        var divText = $('#textDiv').text();
        if (question != '' && typeId != '') {
            if (divText == '') {
                $.ajax({
                    type: 'POST',
                    url: hiddenurl + 'leaveformfront/get_leave_sub_question',
                    data: { questionId: questionId, typeId: typeId },
                    success: function(response) {
                        $('#textDiv').html(response);
                        $('#textDiv').show();
                    }
                });
            }
        } else {
            $('#textDiv').html('');
            $('#textDiv').hide();
        }
    });

    /**
     * Date Select event
     */
    $(document).delegate('.dateEvent', 'change', function() {
        // $("body").on("focusout",".dateEvent", function(){
        var question = $(this).val();
        var questionId = '0';
        var typeId = $(this).data('id');
        var loop = $(this).data('loop');
        var divText = $('#dateDiv').text();

        if (question != '' && typeId != '') {
            if (divText == '') {
                $.ajax({
                    type: 'POST',
                    url: hiddenurl + 'leaveformfront/get_leave_sub_question',
                    data: { questionId: questionId, typeId: typeId },
                    success: function(response) {
                        $('#dateDiv').html(response);
                        $('#dateDiv').show();
                    }
                });
            }
        } else {
            $('#dateDiv').html('');
            $('#dateDiv').hide();
        }
    });

    /**
     * Leave Form js end
     */
    $('#user_type').on('change', function() {
        var userType = $(this).val();
        if (userType == '2') {
            $('#disciplineDiv').show();
            $('#discipline').attr("required", true);
            $('#discipline').select2();
        } else {
            $('#disciplineDiv').hide();
            $('#discipline').attr("required", false);
        }
        if (userType == '1') {
            $('#hr_check_div').show();
            $('#check_header').attr("required", true);
            // $('#discipline').select2();
        } else {
            $('#hr_check_div').hide();
            $('#check_header').attr("required", false);
        }
    });

    /**
     * Search Leave Page
     * After Filter
     */
    $('#search_name, #from_date, #to_date, #leave_date, #search_state, #search_status, #search_manager').on('change', function() {
        $('.se-pre-con').fadeIn();
        var searchName = $('#search_name').val();
        var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();
        var leaveDate = $('#leave_date').val();
        var searchState = $('#search_state').val();
        var searchStatus = $('#search_status').val();
        var searchManager = $('#search_manager').val();
        // alert(searchName+" d "+fromDate+" d "+toDate+" d "+leaveDate+" d "+searchState+" d "+searchStatus+" d "+searchManager);
        $.ajax({
            type: 'POST',
            url: hiddenurl + 'leaveform/get_leave_list',
            data: { searchName: searchName, fromDate: fromDate, toDate: toDate, leaveDate: leaveDate, searchState: searchState, searchStatus: searchStatus, searchManager: searchManager },
            success: function(response) {
                $('.se-pre-con').fadeOut();
                $('#filter_leave_list').html(response);
                var leaveDetail = '<div class="col-md-12"><p class="leave_lable" style="text-align: center;">No data Found.</p></div>';
                $('#leave_detail').html(leaveDetail);
            }
        });
    });

    var pathname = window.location.pathname;
    var position = pathname.search("edit-leave");
    if (position != '-1') {
        $('.se-pre-con').fadeIn();
        var questionId = $('#leaveFormId').val();
        $.ajax({
            type: 'POST',
            url: hiddenurl + 'leaveform/get_subquestion_detail',
            data: { questionId: questionId },
            success: function(response) {
                $('.se-pre-con').fadeOut();
                $('#edit_leave_question').html(response);
            }
        });
    }

    $(document).delegate('.leaveForm', 'click', function() {
        $('.se-pre-con').fadeIn();
        var leaveId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: hiddenurl + 'leaveform/get_leave_detail',
            data: { leaveId: leaveId },
            success: function(response) {
                $('.se-pre-con').fadeOut();

                $('.modal-content').html(response);
                var questionId = $('#leaveFormId').val();
                $.ajax({
                    type: 'POST',
                    url: hiddenurl + 'leaveform/get_subquestion_detail_view',
                    data: { questionId: questionId },
                    success: function(data) {
                        $('#edit_leave_question_view').html(data);
                    }
                });
            }
        });
    });

    /**
     * Search Leave Page end
     */

    /**
     * Email Template Page js
     */

    /**
     * On change template name load Content
     */
    $('#template_name').on('change', function() {
        var templateId = $(this).val();
        if (templateId != '') {
            $.ajax({
                type: 'POST',
                url: hiddenurl + 'emailtemplate/get_template_content',
                data: { templateId: templateId },
                success: function(response) {
                    $('#template_content').summernote("code", response);
                }
            });
        } else {
            $('#template_content').summernote("code", '');
        }
    });

    $('.summernote').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],

        callbacks: {
            onImageUpload: function(image) {
                var sizeKB = image[0]['size'] / 1000;
                var tmp_pr = 0;
                if (sizeKB > 1914) {
                    tmp_pr = 1;
                    alert("pls, select less then 700px image.");
                }

                if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
                    tmp_pr = 1;
                    alert("pls, select png or jpg image.");
                }

                if (tmp_pr == 0) {
                    var file = image[0];
                    var reader = new FileReader();
                    reader.onloadend = function() {
                        //spinner.show();
                        uploadImage(image[0]);
                    }
                    reader.readAsDataURL(file);
                }
            }
        }
    });

    $('#people').change(function() {

        // if(this.value == 'employee'){
        //     $('#employee').show();
        //     $('#self').hide();
        //     $('#supervisor').hide();
        // }
        if (this.value == 'self') {
            // $('#employee').hide();
            $('#supervisor').hide();
            $('#self').show();
        }
        if (this.value == 'supervisor') {
            // $('#employee').hide();
            $('#self').hide();
            $('#supervisor').show();
        }
    });


    /**
     * Email Template Page js end
     */

    /**
     * Add Input field Lable in table
     */
    $('#attachment_file').on('change', function() {
        var name = document.getElementById("attachment_file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        // if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        // {
        //  alert("Invalid Image File");
        // }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("attachment_file").files[0]);
        var f = document.getElementById("attachment_file").files[0];
        var fsize = f.size || f.fileSize;
        if (fsize > 2000000) {
            alert("Image File Size is very big");
        } else {
            form_data.append("attachment_file", document.getElementById('attachment_file').files[0]);
            $.ajax({
                url: hiddenurl + 'leaveformfront/upload_file',
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    // console.log(response);
                    $('#attachment_file').val('');
                    var message = $.parseJSON(response);
                    $.each(message, function(index, value) {
                        if (index == 'message') {
                            key1 = value;
                        } else if (index == 'name') {
                            key2 = value;
                        }
                    });
                    var rowCount = $('#tbl_file_lable tr').length;
                    if (rowCount == 1) {
                        $('#tbl_file_lable').show();
                    }

                    var noData = $('#tbl_file_lable tbody tr td').text();
                    if (noData == 'No data available in table') {
                        $('#tbl_file_lable tbody').html('');
                    }

                    if (key1 == 'success') {
                        var status = 'Success';
                    } else {
                        var status = 'Error';
                    }

                    var tableRow = '<tr>';
                    tableRow += '<td><input type="hidden" class="file_name" name="file_name[]" value="' + key2 + '">' + key2 + '</td>';
                    tableRow += '<td><input type="hidden" class="file_status" name="file_status[]" value="' + status + '">' + status + '</td>';
                    tableRow += '<td><a class="removeFileLable">Remove</a></td></tr>';

                    $('#tbl_file_lable').append(tableRow);
                }
            });
        }
    });
    /**
     * Remove data From table
     */
    $(document).delegate('.removeFileLable', 'click', function() {
        var fileName = $(this).closest('tr').find('.file_name').val();
        var fileStatus = $(this).closest('tr').find('.file_status').val();
        $(this).closest('tr').remove();
        var rowCount = $('#tbl_input_lable tr').length;
        var tableRow = '<tr><td colspan="3" style="text-align: center;">No data available in table</td></tr>';
        if (rowCount == 1) {
            $('#tbl_input_lable').append(tableRow);
        }

        if (fileStatus == 'Success') {
            $.ajax({
                type: 'POST',
                url: hiddenurl + 'leaveformfront/delete_upload_file',
                data: { fileName: fileName },
                success: function(response) {
                    // console.log(response);
                }
            });
        }
    });

});


function uploadImage(image) {
    var hiddenurl = $('#hiddenURL').val();
    var data = new FormData();
    data.append("image", image);

    $.ajax({
        url: hiddenurl + 'pages/upload_image',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
            var link = hiddenurl + 'uploads/content/' + url;

            url = url.trim();
            if (url == "not allow") {
                alert("allow maximum 700X700 image size");
                // spinner.hide();
                return false;
            } else {
                var image = $('<img>').attr('src', link);
                $('#summernote').summernote("insertNode", image[0]);
            }
            //spinner.hide();
        },
        error: function(data) {
            console.log(data);
            //spinner.hide();
        }
    });
}