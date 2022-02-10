<style type="text/css">
            #table_leave_wrapper .row .col-md-6 { float:right;  }
            #table_leave_wrapper .row .col-md-6 .dataTables_length { float:right;  }
        </style>
<table id="table_leave" class="filter_leave_table">
    <thead>
        <tr>
            <th width="20%">Employee Name</th>
            <th width="20%">Last Day of Work</th>
            <th width="38%">Leave Reason</th>
            <th>Manager</th>
            <th>Facility</th>
            <th>Status</th>
            <th>Submitted Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty(@$leaveResult)):
            foreach($leaveResult as $leave): ?>
                <tr>
                    <td><?php echo @$leave['firstName']." ".@$leave['lastName']; ?></td>
                    <td><?php echo date('m-d-Y', strtotime(@$leave['last_day_work'])); ?></td>
                    <td><?php echo @$leave['leave_type_name']; ?></td>
                    <td><?php echo @$leave['manager']; ?></td>
                    <td><?php echo @$leave['facility']; ?></td>
                    <td><?php echo @$leave['leave_status']; ?></td>
                    <td><?php echo date('m/d/Y', strtotime(@$leave['createDate'])); ?></td>
                    <td style="text-align: center;">
                        <a class="leaveForm" id="<?php echo @$leave['leave_form_id']; ?>" title="View Leave Request" data-target="#ajax" data-toggle="modal"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a class="leaveForms" href="<?php echo base_url('edit-leave/'.@$leave['leave_form_id']); ?>" target="_blank" id="<?php echo @$leave['leave_form_id']; ?>" title="Edit Leave Request" style="margin-left: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                </tr>
        <?php endforeach; endif;?>
    </tbody>
</table>

<script type="text/javascript">
    $(function(){
        $('.filter_leave_table').DataTable({
            "lengthMenu": [[10,50, 75, 100, 150], [10,50, 75, 100, 150]],
            "paging": true,
            "searching": false
        });
    });
</script>