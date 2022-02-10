<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['check-frontlogin'] = 'login/check_frontlogin';
$route['forgot-password'] = 'login/forgot_password';
$route['forgot-mail'] = 'login/forgot_mail';
$route['reset-password/(:any)'] = 'login/reset_password/$1';
// $route['change-password'] = 'login/change_password';
$route['reset-change-password'] = 'login/change_password';
$route['logout'] = 'login/front_logout';

$route['leave-request'] = 'login/leave_request';
$route['leave-request-apply'] = 'login/leave_request_apply';

$route['profile'] = 'profile/profile_form';
$route['update-profile'] = 'profile/update_profile';

$route['dashboard'] = 'home/home_page';

$route['leave-reason'] = 'leavemaster/leave_list';
$route['create-leaveType'] = 'leavemaster/create_leaveType';
$route['insert-leaveType'] = 'leavemaster/insert_leaveType';
$route['edit-leaveType/(:num)'] = 'leavemaster/edit_leaveType/$1';
$route['update-leaveType'] = 'leavemaster/update_leaveType';

$route['leave-question'] = 'leavequestion/leave_question_list';
$route['create-leavequestion'] = 'leavequestion/create_leavequestion';
$route['insert-leavequestion'] = 'leavequestion/insert_leavequestion';
$route['edit-leavequestion/(:num)'] = 'leavequestion/edit_leavequestion/$1';
$route['update-leavequestion'] = 'leavequestion/update_leavequestion';

$route['user-list'] = 'user/user_list';
$route['create-user'] = 'user/create_user';
$route['insert-user'] = 'user/insert_user';
$route['edit-user/(:num)'] = 'user/edit_user/$1';
$route['update-user'] = 'user/update_user';

$route['leave-form'] = 'leaveformfront/leave_form';
$route['insert-leaveform'] = 'leaveformfront/insert_leaveform';
$route['leave-message'] = 'leaveformfront/leave_message';

$route['leave-requests'] = 'leaveform/leave_list';
$route['edit-leave/(:num)'] = 'leaveform/edit_leave/$1';
$route['update-leaveform'] = 'leaveform/update_leaveform';

$route['email-template'] = 'emailtemplate/email_template';
$route['create-emailtemplate'] = 'emailtemplate/create_emailtemplate';
$route['insert-emailtemplate'] = 'emailtemplate/insert_emailtemplate';
$route['edit-emailtemplate/(:num)'] = 'emailtemplate/edit_emailtemplate/$1';
$route['update-emailtemplate'] = 'emailtemplate/update_emailtemplate';
$route['delete-leave/(:any)'] = 'leaveform/delete_leaveform_id/$1';

/* Punch-Time start */

$route['tarf'] = 'punchformfront/punch_form';
$route['insert-punchform'] = 'punchformfront/insert_punchform';
$route['punch-message'] = 'punchformfront/punch_message';

$route['time-adjustment-request'] = 'punchform/punch_list';
$route['edit-punch/(:num)'] = 'punchform/edit_punch/$1';
$route['delete-punch/(:num)'] = 'punchform/delete_punch/$1';
$route['update-punchform'] = 'punchform/update_punchform';
$route['update-sup-profile'] = 'profile/update_sup_profile';

/* Punch-Time End */

/* Supervisor start */

$route['supervisor-list'] = 'supervisor/supervisor_list';
$route['create-supervisor'] = 'supervisor/create_supervisor';
$route['insert-supervisor'] = 'supervisor/insert_supervisor';
$route['edit-supervisor/(:num)'] = 'supervisor/edit_supervisor/$1';
$route['update-supervisor'] = 'supervisor/update_supervisor';
$route['delete-supervisor/(:num)'] = 'supervisor/delete_supervisor/$1';

/* Supervisor end */

/*Punch Status start*/

$route['punch-status'] = 'punchstatus/punchstatus_list';
$route['create-punchstatus'] = 'punchstatus/create_punch_status';
$route['insert-punchstatus'] = 'punchstatus/insert_punchstatus';
$route['edit-punchstatus/(:num)'] = 'punchstatus/edit_punchstatus/$1';
$route['update-punchstatus'] = 'punchstatus/update_punchstatus';
$route['delete-punchstatus/(:num)'] = 'punchstatus/delete_punchstatus/$1';

/*Punch Status end*/

/*Disciline start*/

$route['discipline'] = 'discipline/discipline_list';
$route['create-discipline'] = 'discipline/create_discipline';
$route['insert-discipline'] = 'discipline/insert_discipline';
$route['edit-discipline/(:num)'] = 'discipline/edit_discipline/$1';
$route['update-discipline'] = 'discipline/update_discipline';
$route['delete-discipline/(:num)'] = 'discipline/delete_discipline/$1';

/*Disciline end*/

/*Punch type start*/

$route['punch-type'] = 'punchtype/punchtype_list';
$route['create-punchtype'] = 'punchtype/create_punch_type';
$route['insert-punchtype'] = 'punchtype/insert_punchtype';
$route['edit-punchtype/(:num)'] = 'punchtype/edit_punchtype/$1';
$route['update-punchtype'] = 'punchtype/update_punchtype';
$route['delete-punchtype/(:num)'] = 'punchtype/delete_punchtype/$1';

/*Punch type end*/


/* punch-email-template start */

$route['punch-email-template'] = 'PunchEmailtemplate/punchemail_template';
$route['insert-punchemailtemplate'] = 'PunchEmailtemplate/insert_punchemailtemplate';

/* punch-email-template end*/

/* Punch email setting start */

$route['punch-email-setting'] = 'PunchEmailsetting/punchemail_setting';
$route['insert-punchemailsetting'] = 'PunchEmailsetting/insert_punchemailsetting';

/* Punch email setting end */

/* Change password start */

$route['change-password'] = 'Profile/change_password';
$route['update-password'] = 'Profile/update_password';

/* Change password end */



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;