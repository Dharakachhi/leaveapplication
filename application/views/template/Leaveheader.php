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
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/footer-logo-hbg-favicon.png" />  -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
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
        <!-- datetime picker -->
        <!-- summernote -->
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!-- summernote -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url(); ?>assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url(); ?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/pages/css/front-style.css?v=1.5" rel="stylesheet" type="text/css" />
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
                        <a href="<?php echo base_url('leave-form'); ?>">
                            <img src="<?php echo base_url(); ?>uploads/logo.png" alt="logo" class="logo-default">
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu"></div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container">
                    <!-- BEGIN MEGA MENU -->
                    <div class="request_lable">
                        <?php if($page == 'leave-form') {?>
                        <p>Request for Leave of Absence</p>
                    <?php }else if($page == 'tarf'){ ?>
                        <p>Time Adjustment Request</p>
                  <?php  } ?>
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