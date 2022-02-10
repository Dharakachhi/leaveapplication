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
                <span>List Leave Reason</span>
            </li>
            <li class="pull-right">
                <a href="<?php echo base_url('create-leaveType'); ?>" class="btn btngreen">Add Leave Reason</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <table id="table_leave" class="common_datatable">
                                <thead>
                                    <tr>
                                        <th width="50%">Leave Reason</th>
                                        <th>Order By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty(@$leave_type)){
                                        foreach($leave_type as $leaveVal){
                                        if(@$leaveVal['isActive'] == '1'){
                                            $status = '<span class="label label-sm label-success"> Active </span>';
                                            $stBtn = '<a class="btn btngreen leave_status" style="padding-right: 18px; padding-left: 17px;"
                                            data-status="0" id="'.@$leaveVal['leave_type_id'].'" title="Click here to InActive Leave Reason">InActive</a>';
                                        } else{
                                            $status = '<span class="label label-sm label-warning"> InActive </span>';
                                            $stBtn = '<a class="btn btngreen leave_status" style="padding-right: 22px; padding-left: 25px;" data-status="1" id="'.@$leaveVal['leave_type_id'].'" title="Click here to Active Leave Reason">Active</a>';
                                        } ?>
                                            <tr>
                                                <td><?php echo @$leaveVal['leave_type_name']; ?></td>
                                                <td><?php echo @$leaveVal['order_by']; ?></td>
                                                <td><?php echo @$status; ?></td>
                                                <td>
                                                    <?php echo $stBtn; ?>
                                                    <a href="<?php echo base_url('edit-leaveType/'.@$leaveVal['leave_type_id']); ?>" class="btn btngreen icon_btn" title="Edit Leave Reason"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
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
            