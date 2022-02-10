<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url('time-adjustment-request'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Create Punch Type</span>
            </li>
            <li class="pull-right">
                <a href="<?php echo base_url('punch-type'); ?>" class="btn btngreen"><i class="fa fa-long-arrow-left backbtn" aria-hidden="true"></i>Back</a>
            </li>
        </ul>
        
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-2"></div>
                <div class="col-md-9 col-sm-9">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo base_url('insert-punchtype'); ?>" name="form_add_punchtype" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Punch Type Name<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="punch_type_name" autocomplete="off" id="punch_type_name" class="form-control field_border">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Order By</label>
                                        <div class="col-md-9">
                                            <input type="text" name="order_by" id="order_by" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="punchtype_status" class="icheck" data-radio="iradio_square-grey" value="1" checked=""> Active </label>
                                                <label>
                                                    <input type="radio" name="punchtype_status" class="icheck" data-radio="iradio_square-grey" value="0"> In Active </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="accountbtn" class="btn btngreen">Save</button>
                                            <a href="<?php echo base_url('punch-type'); ?>" class="btn default">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
<!-- END PAGE CONTENT BODY -->
<!-- END CONTENT BODY -- >
    