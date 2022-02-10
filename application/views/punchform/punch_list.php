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
                <span>Time Adjustment Request</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <style type="text/css">
        #table_leave_wrapper .row .col-md-6 {
            float: right;
        }

        #table_leave_wrapper .row .col-md-6 .dataTables_length {
            float: right;
        }
        </style>
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="" name="form_filter" method="post" class="horizontal-form"
                                enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="col-md-12">
                                        <div class="col-md-10"></div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1">
                                            <div class="form-group" style="text-align: end;">
                                                <span id="clear_filter" class="btn btngreen"
                                                    style="margin-left: 26px;">Clear</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="search_name" id="search_employee_name"
                                                class="form-control" value="<?= $this->session->userdata('EmpName'); ?>"
                                                placeholder="Search Names" style="width: 168px;">
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="f_date" id="from__punch"
                                                class="form-control fieldDate"
                                                value="<?= $this->session->userdata('FromDate'); ?>"
                                                placeholder="From Date Submitted">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="t_date" id="to__punch"
                                                class="form-control fieldDate"
                                                value="<?= $this->session->userdata('ToDate'); ?>"
                                                placeholder="To Date Submitted" style="margin-left: 16px;">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-1" id="refresh_button"><img src="./assets/pages/img/refresh.png" style="cursor: pointer;"></div> -->
                                    <div class="col-md-1"></div>
                                </div>
                            </form>
                            <br />
                            <!-- END FORM-->
                            <div class="row">
                                <div class="col-md-2">
                                    <!-- BEGIN FORM-->
                                    <div class="form-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="search_response_status" id="search_response_status"
                                                    class="form-control select2">
                                                    <option value="">Search by Status</option>
                                                    <option value="0"
                                                        <?php if($this->session->userdata('ResStatus') == '0'){echo 'selected';} ?>>
                                                        All Status</option>
                                                    <option value="New"
                                                        <?php if($this->session->userdata('ResStatus') == 'New'){echo 'selected';} ?>>
                                                        New</option>
                                                    <option value="Approved"
                                                        <?php if($this->session->userdata('ResStatus') == 'Approved'){echo 'selected';} ?>>
                                                        Approved</option>
                                                    <option value="Denied"
                                                        <?php if($this->session->userdata('ResStatus') == 'Denied'){echo 'selected';} ?>>
                                                        Denied</option>
                                                    <option value="Completed"
                                                        <?php if($this->session->userdata('ResStatus') == 'Completed'){echo 'selected';} ?>>
                                                        Completed</option>
                                                    <option value="Canceled"
                                                        <?php if($this->session->userdata('ResStatus') == 'Canceled'){echo 'selected';} ?>>
                                                        Canceled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if($this->userType == '1'){ ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="facility" id="facility_sup" class="form-control select2">
                                                    <option value="">Search by Facility</option>
                                                    <option value="0"
                                                        <?php if($this->session->userdata('FacSup') == '0'){echo 'selected';} ?>>
                                                        All Facility</option>
                                                    <option value="a-l"
                                                        <?php if($this->session->userdata('FacSup') == 'a-l'){echo 'selected';} ?>>
                                                        Facility(A-L)</option>
                                                    <option value="m-z"
                                                        <?php if($this->session->userdata('FacSup') == 'm-z'){echo 'selected';} ?>>
                                                        Facility(M-Z)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($this->userType != '2'){ ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="search_facility_name" id="search_facility_name"
                                                    class="form-control"
                                                    value="<?= $this->session->userdata('FacName'); ?>"
                                                    placeholder="Search Facility Name" style="width: 168px;">

                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <!-- END FORM-->
                                </div>
                                <div class="col-md-10" id="filter_punch_list">
                                    <table class="punch_search_datatable"
                                        style="word-wrap:break-word;table-layout: fixed; width: 1225px !important;">
                                        <thead>
                                            <tr>
                                                <th width="9%">Submitted Date</th>
                                                <th>Punch Date</th>
                                                <th width="9%">Employee Name</th>
                                                <th>Optima/<br />Casamba <br />login ID</th>
                                                <th>Punch Status</th>
                                                <th>Punch Type</th>
                                                <th>Punch Time</th>
                                                <th>Lunch Minutes</th>
                                                <th>Punch Reason</th>
                                                <th>Facility Name</th>
                                                <th>Request Status</th>

                                                <th>Supervisor name</th>
                                                <th>Supervisor email</th>
                                                <th>Regional Manager</th>
                                                <th>Regional Manager Email</th>
                                                <th>E-mail Id</th>
                                                <th>SSN</th>
                                                <th>Discipline</th>
                                                <th>reason</th>
                                                <th>Supervisor Status</th>
                                                <th>Payroll Status</th>
                                                <th>Comment</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty(@$punchResult)){ 
                                            foreach($punchResult as $punch){ ?>
                                            <tr>
                                                <td><?php echo date('m/d/Y', strtotime(@$punch['createDate'])); ?></td>
                                                <td><?php echo date('m/d/Y', strtotime(@$punch['date'])); ?></td>
                                                <td><?= @$punch['first_name']." ".@$punch['last_name']; ?></td>
                                                <td><?= @$punch['optima_login_id']; ?></td>
                                                <td>
                                                    <?php foreach ($punch_status as $key => $value) {
                                                            if(@$punch['punch_status'] == @$value['id']){
                                                               echo @$value['punch_status_name'];
                                                            }
                                                        } ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($punch_type as $key => $value) {
                                                            if(@$punch['punch_type'] == @$value['id']){
                                                               echo @$value['punch_type_name'];
                                                            }
                                                        } ?>
                                                </td>
                                                <td><?php if(@$punch['punch_time']) { $punch_time = date("h:i a",strtotime(@$punch['punch_time'])); echo $punch_time;
                                                }else{ $punch_time = "";} ?></td>
                                                <td><?= @$punch['lunch_minutes']; ?></td>
                                                <td><?= @$punch['reason']; ?></td>
                                                <td>
                                                    <?php foreach ($facilities_list as $key => $value) {
                                                            if(@$punch['facility'] == @$value['id']){
                                                               echo @$value['facility_name'];
                                                            }
                                                        } ?>
                                                </td>
                                                <td><?php if(@$punch['response_status_hr'] == 'Completed' ||  @$punch['response_status_hr'] == 'Canceled'){
                                                        echo $punch['response_status_hr'];
                                                    }else{
                                                        echo $punch['response_status_sup'];
                                                    }; ?></td>


                                                <td> <?php foreach ($facilities_list as $key => $value) {
                                                            if(@$punch['facility'] == @$value['id']){
                                                               echo @$value['rehab_director'];
                                                            }
                                                        } ?> </td>
                                                <td> <?php foreach ($facilities_list as $key => $value) {
                                                        if(@$punch['facility'] == @$value['id']){
                                                           echo @$value['supervisor_email'];
                                                        }
                                                    } ?> </td>
                                                <td><?php foreach ($facilities_list as $key => $value) {
                                                        if(@$punch['facility'] == @$value['id']){
                                                           echo @$value['regl_mgr'];
                                                        }
                                                    } ?> </td>
                                                <td><?php foreach ($facilities_list as $key => $value) {
                                                        if(@$punch['facility'] == @$value['id']){
                                                           echo @$value['regl_mgr_email'];
                                                        }
                                                    } ?> </td>
                                                <td><?= @$punch['email_id']; ?></td>
                                                <td><?= @$punch['ssn']; ?></td>
                                                <td>
                                                    <?php foreach ($discipline as $key => $value) {
                                                            if(@$punch['discipline'] == @$value['id']){
                                                               echo @$value['discipline_name'];
                                                            }
                                                        } ?>
                                                </td>
                                                <td><?= @$punch['reason']; ?></td>
                                                <td><?= @$punch['response_status_sup']; ?></td>
                                                <td><?= @$punch['response_status_hr']; ?></td>
                                                <td><?= @$punch['comment_status']; ?></td>
                                                <td style="width: 109px;">
                                                    <a class="punchForm" id="<?= @$punch['id']; ?>"
                                                        title="View Punch Request" data-target="#ajax"
                                                        data-toggle="modal"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    <a class="punchForms"
                                                        href="<?= base_url('edit-punch/'.@$punch['id']); ?>"
                                                        id="<?= @$punch['id']; ?>" title="Edit Punch Request"
                                                        style="margin-left: 10px;"><i class="fa fa-pencil"
                                                            aria-hidden="true"></i></a>
                                                    <?php if(@$this->userType == 0){ ?>
                                                    <a class="punchForms"
                                                        href="<?= base_url('delete-punch/'.@$punch['id']); ?>"
                                                        id="<?= @$punch['id']; ?>" title="Delete Punch Request"
                                                        style="margin-left: 10px;"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php  } } ?>
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
<div class="modal fade" id="ajax" role="dialog" id="grid_table" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- End modal -->
<script type="text/javascript">
$(function() {

    $(".fieldDate").datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('.punch_search_datatable').DataTable({
        "lengthMenu": [
            [10, 50, 75, 100, 150],
            [10, 50, 75, 100, 150]
        ],
        "paging": true,
        "columnDefs": [{
            "targets": [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21],
            "visible": false
        }],
        "order": [
            [9, "desc"]
        ],
        "searching": false,
        dom: 'Bfrtip',
        buttons: [{

            extend: 'excel',
            autoClose: 'true',
            text: '<img src="./assets/pages/img/excel_img.png" alt="Excel Button">',
            tag: 'span',
            className: "dt-buttons",
            init: function(api, node) {
                $(node).removeClass("dt-button buttons-excel buttons-html5");
            }
        }]
    });
});
</script>