<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Leave Requests</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <style type="text/css">
            #table_leave_wrapper .row .col-md-6 { float:right;  }
            #table_leave_wrapper .row .col-md-6 .dataTables_length { float:right;  }
        </style>
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="" name="form_filter" method="post" class="horizontal-form" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="search_name" id="search_name" class="form-control" value="" placeholder="Search Names">
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="text-align: right;">
                                        <div class="form-group">
                                            <label class="control-label">From</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="from_date" id="from_date" class="form-control fieldDate" value="" placeholder="From Date" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="text-align: right;">
                                        <div class="form-group">
                                            <label class="control-label">To</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="to_date" id="to_date" class="form-control fieldDate" value="" placeholder="To Date" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <a href="<?php echo base_url('leave-requests'); ?>" id="leaveFormbtn" class="btn btngreen">Clear</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- BEGIN FORM-->
                                    <form action="" name="form_filter" method="post" class="horizontal-form" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="search_manager" id="search_manager" class="form-control select2">
                                                        <option value="">Search by Manager</option>
                                                        <option value="0">All Manager</option>
                                                        <option value="Maria Korey">Maria Korey</option>
                                                        <option value="Elida Sanchez">Elida Sanchez</option>
                                                        <option value="a-l">HR (A-L)</option>
                                                        <option value="m-z">HR (M-Z)</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="search_state" id="search_state" class="form-control select2">
                                                        <option value="">Search by State</option>
                                                        <option value="0">All State</option>
                                                        <?php if(!empty($state_list)):
                                                        foreach(@$state_list as $stateVal): ?>
                                                            <option value="<?php echo @$stateVal['id']; ?>"><?php echo @$stateVal['name']; ?></option>
                                                    <?php endforeach; endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="search_status" id="search_status" class="form-control select2">
                                                        <option value="">Search by Status</option>
                                                        <option value="0">All Status</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Denied">Denied</option>
                                                        <option value="Cancel Request">Cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="leave_date" id="leave_date" class="form-control fieldDate" value="" placeholder="Date Submitted" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                                <div class="col-md-9" id="filter_leave_list">
                                    <table id="table_leave" class="leave_search_datatable">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Last Day of Work</th>
                                                <th>Leave Reason</th>
                                                <th>Manager</th>
                                                <th>Facility</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
<!-- END CONTENT BODY -->
<!--Start Modal-->
<div class="modal fade" id="ajax" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        </div>
    </div>
</div> 
<!-- End modal -->