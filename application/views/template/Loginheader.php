<?php
$currentUrl =  $_SERVER['REQUEST_URI'];
$page = basename($currentUrl); ?>
<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Leave</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/footer-logo-hbg-favicon.png" /> -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- Seachable Dropdown -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Seachable Dropdown -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url(); ?>assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/pages/css/login-style.css?v=1" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    </head>
    <!-- END HEAD -->

    <body class=" login">
        <input type="hidden" name="hiddenURL" id="hiddenURL" value="<?php echo base_url(); ?>">
        <div class="logo">
            <!-- <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>uploads/logo.png" alt="" /> </a> -->
        </div>
            <div class="se-pre-con" style="display: none;"></div>
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