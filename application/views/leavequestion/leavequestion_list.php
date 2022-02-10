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
                <span>List Leave Question Detail</span>
            </li>
            <li class="pull-right">
                <a href="<?php echo base_url('create-leavequestion'); ?>" class="btn btngreen">Add Leave Question Detail</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <table id="table_leave" class="leave_datatable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th width="27%">Question</th>
                                        <th width="27%">Leave Type</th>
                                        <th>Question Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty(@$leave_question)){
                                        foreach($leave_question as $leaveVal){
                                            if(@$leaveVal['isSubquestion'] == '0'){
                                                if(@$leaveVal['isActive'] == '1'){
                                                    $status = '<span class="label label-sm label-success"> Active </span>';
                                                    $stBtn = '<a class="btn btngreen question_status" style="padding-right: 18px; padding-left: 17px;" data-status="0" id="'.@$leaveVal['leave_question_id'].'" title="Click here to InActive Leave Question Detail">InActive</a>';
                                                } else{
                                                    $status = '<span class="label label-sm label-warning"> InActive </span>';
                                                    $stBtn = '<a class="btn btngreen question_status" style="padding-right: 22px; padding-left: 25px;" data-status="1" id="'.@$leaveVal['leave_question_id'].'" title="Click here to Active Leave Question Detail">Active</a>';
                                                } ?>
                                                <tr>
                                                    <td>1</td>
                                                    <td><?php echo @$leaveVal['leave_question']; ?></td>
                                                    <td><?php echo @$leaveVal['leave_type_name']; ?></td>
                                                    <td><?php echo @$leaveVal['input_type']; ?></td>
                                                    <td><?php echo @$status; ?></td>
                                                    <td>
                                                        <?php echo $stBtn; ?>
                                                        <a href="<?php echo base_url('edit-leavequestion/'.@$leaveVal['leave_question_id']); ?>" class="btn btngreen icon_btn" title="Edit Leave Question Detail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                <?php foreach($leave_question as $leaveVal1){
                                                    if(@$leaveVal1['related_question'] == @$leaveVal['leave_question_id']){
                                                        if(@$leaveVal1['isActive'] == '1'){
                                                            $status = '<span class="label label-sm label-success"> Active </span>';
                                                            $stBtn = '<a class="btn btngreen question_status" style="padding-right: 18px; padding-left: 17px;" data-status="0" id="'.@$leaveVal1['leave_question_id'].'" title="Click here to InActive Leave Question Detail">InActive</a>';
                                                        } else{
                                                            $status = '<span class="label label-sm label-warning"> InActive </span>';
                                                            $stBtn = '<a class="btn btngreen question_status" style="padding-right: 22px; padding-left: 25px;" data-status="1" id="'.@$leaveVal1['leave_question_id'].'" title="Click here to Active Leave Question Detail">Active</a>';
                                                        } ?>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>&nbsp;&nbsp;<?php echo @$leaveVal1['leave_question']; ?></td>
                                                            <td><?php echo @$leaveVal1['leave_type_name']; ?></td>
                                                            <td><?php echo @$leaveVal1['input_type']; ?></td>
                                                            <td><?php echo @$status; ?></td>
                                                            <td>
                                                                <?php echo $stBtn; ?>
                                                                <a href="<?php echo base_url('edit-leavequestion/'.@$leaveVal1['leave_question_id']); ?>" class="btn btngreen icon_btn" title="Edit Leave Question Detail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            </td>
                                                        </tr>
                                            <?php } } ?>
                                    <?php } } } ?>
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
            