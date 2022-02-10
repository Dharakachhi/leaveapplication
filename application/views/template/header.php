<?php
$currentUrl =  $_SERVER['REQUEST_URI'];

$page = basename($currentUrl);
 ?>
<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Leave Application</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/footer-logo-hbg-favicon.png" />  -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- Datatable -->
         <link href="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
         <!-- Datatable -->
         <!-- Seachable Dropdown -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Seachable Dropdown -->
        <!-- datetime picker -->
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- datetime picker -->
        <!-- summernote -->
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!-- summernote -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url(); ?>assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url(); ?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/pages/css/front-style.css?v=1.7" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-boxed">
        <input type="hidden" name="hiddenURL" id="hiddenURL" value="<?php echo base_url(); ?>">
        <div class="se-pre-con" style="display: none;"></div>
        <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                            <?php if($this->session->userdata('userType') == '2'){
                                $base_url = base_url('time-adjustment-request');
                             }else{
                                 $base_url = base_url();
                              } ?>
                        <a href="<?= $base_url; ?>">
                            <img src="<?php echo base_url(); ?>uploads/logo.png" alt="logo" class="logo-default">
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <?php if($this->session->userdata('userEmail') != ''){ ?>
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?php echo base_url(); ?>uploads/noavatar.png">
                                    <span class="username username-hide-mobile"><?php if(@$this->session->userdata('userName')){
                                        echo @$this->session->userdata('userName');
                                    }else{ echo "My Profile"; } ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?php echo base_url('profile'); ?>">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="<?php echo base_url('change-password'); ?>">
                                            <i class="icon-key"></i> Change Password </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('logout'); ?>">
                                            <i class="fa fa-sign-out"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    <?php } ?>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container">
                    <!-- BEGIN MEGA MENU -->
                    <div class="hor-menu">
                       
                        <ul class="nav navbar-nav">
                            <?php if($this->session->userdata('userEmail') != ''){ 
                                 if($this->session->userdata('userType') == '1'){ 
                                    $header = "Payroll Portal";
                                        }else if($this->session->userdata('userType') == '2'){
                                    $header = "Supervisor Portal";
                                }else if($this->session->userdata('userType') == '0'){
                                    $header = "Admin Portal";  } else{
                                         $header = ""; 
                                    }
                                $checkHeader = explode(",", $this->session->userdata('checkHeader'));


                                if(($this->session->userdata('userType') == '1' && (@$checkHeader[0] == '1' || @$checkHeader[1] == '1')) || $this->session->userdata('userType') == '0'){ ?>
                                    <li class="menu-dropdown classic-menu-dropdown <?php if($page == 'leave-requests'){ echo 'active'; } ?>">
                                        <a href="<?php echo base_url('leave-requests'); ?>"> Leave Requests</a>
                                             <?php if($this->session->userdata('userType') == '0'){ ?>
                                            <ul class="dropdown-menu pull-left">
                                                <li>
                                                    <a href="<?php echo base_url('user-list'); ?>" class="nav-link <?php if($page == 'user-list'){ echo 'active'; } ?>"> User List</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('email-template'); ?>" class="nav-link <?php if($page == 'email-template'){ echo 'active'; } ?>"> Leave Email Template</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('leave-reason'); ?>" class="nav-link <?php if($page == 'user-list'){ echo 'active'; } ?>"> Leave Reason</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('leave-question'); ?>" class="nav-link <?php if($page == 'user-list'){ echo 'active'; } ?>"> Leave Question Details</a>
                                                </li>
                                            </ul>
                                            <?php  } ?>
                                    </li>
                               <?php }  ?>
                                

                               <?php if($this->session->userdata('userType') == '2' || $this->session->userdata('userType') == '0' || ($this->session->userdata('userType') == '1' && (@$checkHeader[0] == '0' || @$checkHeader[1] == '0'))){ ?>
                                    <li class="menu-dropdown classic-menu-dropdown <?php if($page == 'time-adjustment-request'){ echo 'active'; } ?>">
                                        <a href="<?php echo base_url('time-adjustment-request'); ?>"> Time Adjustment Request</a>

                                         <?php if($this->session->userdata('userType') == '0'){ ?>
                                            <ul class="dropdown-menu pull-left">
                                                <li>
                                                    <a href="<?php echo base_url('supervisor-list'); ?>" class="nav-link <?php if($page == 'supervisor-list'){ echo 'active'; } ?>" > Facility List</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('punch-status'); ?>"class="nav-link <?php if($page == 'punch-status'){ echo 'active'; } ?>"> Punch Status</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('punch-type'); ?>"class="nav-link <?php if($page == 'punch-type'){ echo 'active'; } ?>">Punch Type </a>
                                                </li>
                                                 <li>
                                                    <a href="<?php echo base_url('discipline'); ?>"class="nav-link <?php if($page == 'discipline'){ echo 'active'; } ?>"> Discipline</a>
                                                </li>
                                                 <li>
                                                    <a href="<?php echo base_url('punch-email-template'); ?>"class="nav-link <?php if($page == 'punch-email-template'){ echo 'active'; } ?>">Punch Email Template</a>
                                                </li>
                                                 <li>
                                                    <a href="<?php echo base_url('punch-email-setting'); ?>"class="nav-link <?php if($page == 'punch-email-setting'){ echo 'active'; } ?>">Punch Email Setting</a>
                                                </li>
                                            </ul>
                                    <?php } ?>
                                    
                              <?php  } ?>
                                    <li class="menu-dropdown classic-menu-dropdown text-center">
                                            <a style="pointer-events: none;text-decoration:none;margin-left: 380px; font-size: 22px; color: #A5C738;"> <?= $header ?></a>
                                    </li>
                              
                             <?php } ?>
                            
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                
            <div id="message" style="display: none;"></div>
            <div id="message_error" style="display: none;"></div>
        <?php if($this->session->flashdata('message')){ ?> 
            <div id="notification" style="display: none;">
                <script type="text/javascript">
                    $("#notification").fadeIn("slow").append("<?php echo $this->session->flashdata('message'); ?>");
                    setTimeout(function() {
                        $("#notification").fadeOut("slow");
                    }, 4000);
                </script>
            </div>
        <?php } else if($this->session->flashdata('error')){ ?>
            <div id="notification_error" style="display: none;">
                <script type="text/javascript">
                    $("#notification_error").fadeIn("slow").append("<?php echo $this->session->flashdata('error'); ?>");
                    setTimeout(function() {
                        $("#notification_error").fadeOut("slow");
                    }, 4000);
                </script>
            </div>
        <?php } else{} ?>