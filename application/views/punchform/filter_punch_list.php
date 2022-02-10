<style type="text/css">
#table_leave_wrapper .row .col-md-6 {
    float: right;
}

#table_leave_wrapper .row .col-md-6 .dataTables_length {
    float: right;
}

a.dt-button:last-child,
button.dt-button:last-child,
div.dt-button:last-child {
    margin-top: 63px;
    margin-left: -276px;
}
</style>
<table class="filter_punch_table" style="word-wrap:break-word;table-layout: fixed; width: 1225px !important;">
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
            <td><?php echo date('m-d-Y', strtotime(@$punch['createDate'])); ?></td>
            <td><?php echo date('m-d-Y', strtotime(@$punch['date'])); ?></td>
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
            <td>
                <a class="punchForm" id="<?= @$punch['id']; ?>" title="View Punch Request" data-target="#ajax"
                    data-toggle="modal"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a class="punchForms" href="<?= base_url('edit-punch/'.@$punch['id']); ?>" id="<?= @$punch['id']; ?>"
                    title="Edit Punch Request" style="margin-left: 10px;"><i class="fa fa-pencil"
                        aria-hidden="true"></i></a>
                <?php if(@$this->userType == 0){ ?>
                <a class="punchForms" href="<?= base_url('delete-punch/'.@$punch['id']); ?>" id="<?= @$punch['id']; ?>"
                    title="Delete Punch Request" style="margin-left: 10px;"><i class="fa fa-trash"
                        aria-hidden="true"></i></a>
                <?php } ?>
            </td>
        </tr>
        <?php  } } ?>


    </tbody>
</table>

<script type="text/javascript">
$(function() {

    $('.filter_punch_table').DataTable({
        "lengthMenu": [
            [10, 50, 75, 100, 150],
            [10, 50, 75, 100, 150]
        ],
        "paging": true,
        "order": [
            [9, "desc"]
        ],
        "columnDefs": [{
            "targets": [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21],
            "visible": false
        }],
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